"""Read-only same-origin WordPress crawl. Run: python3 tests/seo-audit.py --base URL."""
import argparse, json, re, urllib.request, urllib.error, urllib.parse
from html.parser import HTMLParser
from xml.etree import ElementTree as ET
from concurrent.futures import ThreadPoolExecutor
from datetime import datetime, timezone
from pathlib import Path

class Page(HTMLParser):
    def __init__(self):
        super().__init__(); self.meta={}; self.canon=[]; self.title=''; self.h1=0; self.links=[]; self.images=[]; self.scripts=[]; self.frames=[]; self.json=[]; self.mode=''; self.buffer=''
    def handle_starttag(self, tag, attrs):
        a=dict(attrs)
        if tag=='meta': self.meta.setdefault(a.get('name',a.get('property','')),[]).append(a.get('content',''))
        if tag=='link' and a.get('rel')=='canonical': self.canon.append(a.get('href',''))
        if tag=='h1': self.h1+=1
        if tag=='a': self.links.append(a)
        if tag=='img': self.images.append(a)
        if tag=='iframe': self.frames.append(a)
        if tag=='script':
            self.scripts.append(a.get('src',''))
            if a.get('type')=='application/ld+json': self.mode='json'; self.buffer=''
        if tag=='title': self.mode='title'; self.buffer=''
    def handle_data(self, data):
        if self.mode: self.buffer+=data
    def handle_endtag(self, tag):
        if tag=='title' and self.mode=='title': self.title=self.buffer; self.mode=''
        if tag=='script' and self.mode=='json': self.json.append(self.buffer); self.mode=''

parser=argparse.ArgumentParser(); parser.add_argument('--base',required=True); parser.add_argument('--output',default='/tmp/sc-seo-audit.json'); args=parser.parse_args()
base=args.base.rstrip('/')+'/'
origin=urllib.parse.urlsplit(base).netloc

def fetch(url):
    if urllib.parse.urlsplit(url).netloc!=origin: raise ValueError('Cross-origin URL excluded: '+url)
    try:
        with urllib.request.urlopen(url,timeout=30) as r: return r.status,dict(r.headers),r.read().decode('utf-8'),r.url
    except urllib.error.HTTPError as e: return e.code,dict(e.headers),e.read().decode('utf-8'),url

def inspect(url):
    status,headers,body,final=fetch(url); p=Page();p.feed(body);errors=[]; warnings=[]
    if status!=200:errors.append('HTTP '+str(status))
    if len(p.meta.get('description',[]))!=1 or not p.meta.get('description',[''])[0]:errors.append('Missing/duplicate description')
    if len(p.canon)!=1:errors.append('Missing/duplicate canonical')
    elif p.canon[0]!=url:errors.append('Unexpected canonical '+p.canon[0])
    if p.h1!=1:errors.append('H1 count '+str(p.h1))
    if not p.title:errors.append('Missing title')
    if 'noindex' in ','.join(p.meta.get('robots',[])):warnings.append('Noindex')
    for key in ['og:title','og:description','og:image','twitter:card']:
        if not p.meta.get(key):errors.append('Missing '+key)
    graphs=[]
    for raw in p.json:
        try: graphs.extend(json.loads(raw).get('@graph',[]))
        except (ValueError,AttributeError):errors.append('Invalid JSON-LD')
    if not graphs:errors.append('No schema graph')
    ids=[n.get('@id') for n in graphs if n.get('@id')]
    if len(ids)!=len(set(ids)):errors.append('Duplicate graph IDs')
    if any('alt' not in i for i in p.images):warnings.append('Images missing alt attribute')
    outbound=[a for a in p.links if urllib.parse.urlsplit(a.get('href','')).scheme in ['http','https'] and urllib.parse.urlsplit(a['href']).netloc!=origin]
    if any(a.get('target')!='_blank' or 'noopener' not in a.get('rel','').split() for a in outbound):errors.append('Outbound link target/rel mismatch')
    return {'url':url,'status':status,'title':p.title,'description':p.meta.get('description',[''])[0],'canonical':p.canon,'h1':p.h1,'schema_types':[n['@type'] for n in graphs],'errors':errors,'warnings':warnings},p,graphs

sitemaps=[]; urls={base}; queue=[base+'wp-sitemap.xml']
while queue:
    url=queue.pop(0);status,headers,body,final=fetch(url); root=ET.fromstring(body)
    sitemaps.append({'url':url,'status':status})
    locs=[n.text for n in root.findall('.//{*}loc')]
    if root.tag.endswith('sitemapindex'):queue.extend(locs)
    else:urls.update(locs)
    if len(urls)>200:raise RuntimeError('Audit limited to 200 URLs')
with ThreadPoolExecutor(max_workers=3) as pool: results=list(pool.map(inspect,sorted(urls)))
checks=[]
def check(label, ok): checks.append({'check':label,'passed':bool(ok)})
by_url={r[0]['url']:r for r in results}
for slug,checkout in [('momentum-labs','https://www.successcircles.net/mlabs'),('momentum-team','https://www.successcircles.net/yesmomentumteam'),('momentum-buddy','https://www.successcircles.net/yesmomentum')]:
    row,p,graph=by_url[base+slug+'/']; found=[a for a in p.links if a.get('href')==checkout]
    check(slug+' checkout buttons', len(found)>=3 and all(a.get('target')=='_blank' for a in found))
    check(slug+' service entity',any(n.get('@type')=='Service' for n in graph))
p=by_url[base][1]
check('Hero Vimeo iframe deferred',any('vimeo.com' in f.get('data-src','') and not f.get('src') for f in p.frames))
check('No eager Vimeo SDK',not any('player.vimeo.com/api/player.js' in s for s in p.scripts))
for endpoint in ['robots.txt','llms.txt','llms-full.txt']:
    status,h,body,final=fetch(base+endpoint);check(endpoint+' HTTP 200',status==200)
    if endpoint=='robots.txt':
        check('Robots admin policy retained','Disallow: /wp-admin/' in body)
        check('No blanket AI allow overrides','Allow: /\n' not in body)
    else:
        check(endpoint+' noindex header', 'noindex' in h.get('X-Robots-Tag',h.get('x-robots-tag','')))
        check(endpoint+' Momentum OS coverage','Momentum OS' in body)
for suffix in ['?s=accountability','?sc-contact=sent','weekly-wins/?wins=2','seo-audit-nonexistent-404/']:
    status,h,body,final=fetch(base+suffix);p=Page();p.feed(body)
    check(suffix+' noindex', 'noindex' in ','.join(p.meta.get('robots',[])))
    if '404' in suffix:check('True HTTP 404',status==404)
report={'checked_at':datetime.now(timezone.utc).isoformat(),'base':base,'sitemaps':sitemaps,'pages':[r[0] for r in results],'checks':checks}
report['error_count']=sum(len(r[0]['errors']) for r in results)+sum(not c['passed'] for c in checks)
Path(args.output).write_text(json.dumps(report,indent=2)+'\n')
print(json.dumps({'pages':len(results),'sitemaps':len(sitemaps),'checks':len(checks),'errors':report['error_count'],'failed_pages':[(r[0]['url'],r[0]['errors']) for r in results if r[0]['errors']],'failed_checks':[c for c in checks if not c['passed']]},indent=2))
raise SystemExit(bool(report['error_count']))
