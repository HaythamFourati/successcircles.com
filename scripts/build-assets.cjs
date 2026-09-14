/** npm run build — deterministic encoding/minification; originals stay editable. */
const fs = require('node:fs');
const path = require('node:path');
const esbuild = require('esbuild');
const sharp = require('sharp');
const postcss = require('postcss');
(async () => {
  for (const folder of ['assets/css','assets/js']) {
    for (const file of fs.readdirSync(folder)) {
      if (!/\.(css|js)$/.test(file) || file.includes('.min.')) continue;
      const source=path.join(folder,file), out=source.replace(/\.(css|js)$/,'.min.$1');
      const result=await esbuild.transform(fs.readFileSync(source,'utf8'), {loader:file.endsWith('.css')?'css':'js',minify:true,target:['es2020'],legalComments:'none'});
      fs.writeFileSync(out,result.code);
    }
  }
  // Only omit selectors explicitly scoped to other page templates.
  const root=postcss.parse(fs.readFileSync('assets/css/main.css','utf8'));
  const otherPages=/\.sc-(?:about|voices|joseph|buddy|labs|team|contactpage|faqpage|journal|article)(?:__|--|[\s.:#>+~\[]|$)/;
  root.walkRules(rule=>{if(rule.selectors.every(selector=>otherPages.test(selector)))rule.remove();});
  root.walkAtRules(rule=>{if(rule.nodes && !rule.nodes.length)rule.remove();});
  const homepage=await esbuild.transform(root.toString(),{loader:'css',minify:true,legalComments:'none'});
  fs.writeFileSync('assets/css/main-home.min.css',homepage.code);
  fs.mkdirSync('assets/img/optimized',{recursive:true});
  for(const [name,widths] of Object.entries({'story-poster.png':[480,800,1200],'hero-huddle.jpg':[480,800,1170],'team/members-live.jpg':[480,800,1200],'successcircles-logo.png':[195,390]})) {
    const stem=name.replace(/\.[^.]+$/,'').replaceAll('/','-');
    for(const width of widths) await sharp('assets/img/'+name).resize({width,withoutEnlargement:true}).webp({quality:82,effort:6}).toFile(`assets/img/optimized/${stem}-${width}.webp`);
  }
  console.log('Minified CSS/JS and responsive WebP derivatives built.');
})();
