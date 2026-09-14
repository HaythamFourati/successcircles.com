<?php
/** Regression tests for metadata, canonical identity, prices, crawl policy and links. */
if ( PHP_SAPI !== 'cli' ) { exit; }
define( 'ABSPATH', dirname( __DIR__, 4 ) . '/' );
define( 'SUCCESSCIRCLES_DIR', dirname( __DIR__ ) );
define( 'SUCCESSCIRCLES_URI', 'https://example.test/theme' );
class WP_Post { public $post_name; public $post_status='publish'; public $post_password=''; public function __construct($slug) { $this->post_name=$slug; } }
class WP_Error {}
class WP_Query { public $posts=array(); public function __construct($args){$GLOBALS['episode_query']=$args;} }
function get_posts($args){$GLOBALS['full_query']=$args;return array();}
function __($s,$d=''){return $s;}
function add_action(...$a){}
function add_filter(...$a){}
function apply_filters($tag,$value){return $value;}
function get_theme_mod($key,$default=''){return $GLOBALS['mods'][$key]??$default;}
function wp_strip_all_tags($s,$breaks=false){return strip_tags($s);}
function wp_specialchars_decode($s,$flags=ENT_QUOTES){return html_entity_decode($s,$flags,'UTF-8');}
function wp_parse_url($s,$component=-1){return parse_url($s,$component);}
function sanitize_key($s){return preg_replace('/[^a-z0-9_\-]/','',strtolower($s));}
function home_url($p='/'){return 'https://example.test'.$p;}
function is_front_page(){return ($GLOBALS['view']??'')==='home';}
function is_page($slug=''){return ($GLOBALS['view']??'')==='page' && (!$slug||$slug===$GLOBALS['slug']);}
function is_home(){return ($GLOBALS['view']??'')==='blog';}
function is_singular($type=''){return in_array($GLOBALS['view']??'',array('page','post'),true)&&(!$type||$type===($GLOBALS['view']==='post'?'post':'page'));}
function is_404(){return ($GLOBALS['view']??'')==='404';}
function is_search(){return ($GLOBALS['view']??'')==='search';}
function is_category(){return ($GLOBALS['view']??'')==='category';}
function is_tag(){return false;}
function is_tax(){return false;}
function is_post_type_archive(){return false;}
function post_password_required(){return $GLOBALS['protected']??false;}
function get_queried_object(){return new WP_Post($GLOBALS['slug']??'');}
function get_page_by_path($slug){return $GLOBALS['pages'][$slug]??null;}
function get_the_excerpt(){return $GLOBALS['excerpt']??'';}
function get_bloginfo($key,$mode=''){return $key==='name'?'Success Circles':'en-US';}
function get_permalink($id=null){return home_url('/'.($GLOBALS['slug']??'post').'/');}
function get_term_link($term){return new WP_Error;}
function is_wp_error($v){return $v instanceof WP_Error;}
function get_query_var($k){return $GLOBALS['query'][$k]??'';}
function get_option($k){return $GLOBALS['options'][$k]??'';}
function get_search_query(){return 'focus';}
function wp_unslash($s){return stripslashes($s);}
function absint($s){return abs((int)$s);}
function trailingslashit($s){return rtrim($s,'/').'/';}
function user_trailingslashit($s,$type=''){return trailingslashit($s);}
function get_pagenum_link($p,$escape=true){return $GLOBALS['pagination'];}
function add_query_arg($key,$value,$url){$parts=parse_url($url);parse_str($parts['query']??'',$q);$q[$key]=$value;return preg_replace('/\?.*/','',$url).'?'.http_build_query($q);}
function remove_query_arg($keys,$url){$parts=parse_url($url);parse_str($parts['query']??'',$q);foreach($keys as $k){unset($q[$k]);}return preg_replace('/\?.*/','',$url).($q?'?'.http_build_query($q):'');}
function wp_get_attachment_image_src($id,$size){return $GLOBALS['logo']??false;}
foreach(array('setup','seo','schema','content','template-tags','customizer','links','llms') as $file){require SUCCESSCIRCLES_DIR.'/inc/'.$file.'.php';}
$count=0;
function check($actual,$expected,$label){global $count;$count++;if($actual!==$expected){throw new RuntimeException($label.': '.var_export($actual,true));}}
foreach(successcircles_seo_pages() as $key=>$page){check(strlen(successcircles_seo_page_value($key,'description'))>40,true,'Description '.$key);}
$GLOBALS['view']='page';$GLOBALS['slug']='momentum-os';
check(successcircles_seo_description(),successcircles_seo_page_value('momentum-os','description'),'OS fallback');
$GLOBALS['mods']['sc_seo_momentum-os_description']='Custom summary';
check(successcircles_seo_description(),'Custom summary','Description override');
$GLOBALS['protected']=true;check(successcircles_seo_description(),'','Protected description omitted');$GLOBALS['protected']=false;
$GLOBALS['mods']=array('sc_seo_momentum-os_title'=>'Custom title');
check(successcircles_seo_title_parts(array('title'=>'Old'))['title'],'Custom title','Title override');
$GLOBALS['mods']=array(); $_GET=array('wins'=>'2');
check(successcircles_canonical_url(),home_url('/momentum-os/'),'Ignore wins outside Buzz');
$GLOBALS['slug']='weekly-wins';check(successcircles_canonical_url(),home_url('/weekly-wins/?wins=2'),'Buzz canonical identity');
$_GET=array();$GLOBALS['view']='category';check(successcircles_canonical_url(),'','Term error does not cause fatal');
$GLOBALS['view']='search';$GLOBALS['query']=array('paged'=>2);$GLOBALS['pagination']=home_url('/?s=focus&paged=2&utm_source=test');
check(successcircles_canonical_url(),home_url('/?s=focus&paged=2'),'Plain search pagination preserved');
$GLOBALS['view']='page';$GLOBALS['slug']='article';$GLOBALS['query']=array('page'=>2);$GLOBALS['options']['permalink_structure']='/%postname%/';
check(successcircles_canonical_url(),home_url('/article/2/'),'Multipage singular canonical');
$GLOBALS['query']=array();$GLOBALS['protected']=true;check(successcircles_robots(array())['noindex'],true,'Protected noindex');$GLOBALS['protected']=false;
foreach(array('$1,997'=>'1997','$97'=>'97','97.50'=>'97.50','From $97'=>'','3 x $797'=>'','Contact us'=>'','€97'=>'') as $input=>$expected){check(successcircles_schema_price($input),$expected,'Price '.$input);}
$GLOBALS['view']='home';$services=successcircles_schema_services();check(count($services),3,'Homepage services');
foreach($services as $service){check(isset($service['review']),false,'No misattributed reviews');check(isset($service['hasOfferCatalog']),false,'No feature-as-offer markup');}
$GLOBALS['view']='page';$GLOBALS['slug']='momentum-buddy';$services=successcircles_schema_services();
check(count($services),1,'Only current service');check(array_column($services[0]['offers'],'price'),array('582','972','1940'),'Buddy actual plan totals');
$GLOBALS['slug']='momentum-labs';$GLOBALS['mods']=array('sc_labs_price'=>'$123','sc_buddy_price'=>'$456');
check(successcircles_schema_services()[0]['offers'][0]['price'],'123','Labs reads Labs setting');
$GLOBALS['mods']=array('sc_phone'=>'Tel +1 (747) 2CIRCLE / +1 (747) 224-7253');
check(successcircles_schema_organization()['telephone'],'+17472247253','Vanity phone handling');
$GLOBALS['logo']=array('https://example.test/logo.png',500,200);
check(successcircles_schema_organization()['logo']['width'],500,'Custom logo schema');
$robots="User-agent: *\nDisallow: /wp-admin/\n";
check(successcircles_robots_txt($robots,'0'),$robots,'Private crawl policy unchanged');
check(str_contains(successcircles_robots_txt($robots,'1'),'Allow: /'),false,'No broad crawler override');
$page=new WP_Post('faq');$page->post_password='secret';$GLOBALS['pages']['faq']=$page;
check(successcircles_llms_public_page('faq'),false,'Protected pages excluded from AI index');
$GLOBALS['mods']=array();
check(successcircles_page_link('momentum_buddy_application'),'https://www.momentumbuddy.com/#_fw4dxl5ri','Buddy checkout');
check(successcircles_content('labs_page.cta_url'),'https://www.successcircles.net/yesMomentumLabs','Labs checkout');
check(successcircles_content('team_page.cta_url'),'https://www.successcircles.net/signupmomentumteam','Team checkout');
$GLOBALS['mods']['sc_buddy_signup_url']='https://checkout.example.test/new';
check(successcircles_page_link('momentum_buddy_application'),'https://checkout.example.test/new','Buddy shared control');
class Manager {public $settings=array();public $controls=array();function add_panel(...$a){} function add_section(...$a){} function add_setting($id,$args){$this->settings[$id]=$args;}function add_control($id,$args){$this->controls[$id]=$args;}}
$m=new Manager;successcircles_customize_seo($m);check(count($m->controls),24,'12 page SEO sections / 24 controls');
foreach ( array_keys( successcircles_seo_pages() ) as $slug ) { $GLOBALS['pages'][$slug] = new WP_Post($slug); }
$index = successcircles_llms_index();
$full = successcircles_llms_full();
check(str_contains($index,'Momentum OS'),true,'AI index includes OS');
check(str_contains($full,'What is a huddle?'),true,'AI copy includes visible huddle explanation');
check(str_contains($full,'Momentum OS'),true,'AI copy includes weekly system');
check($GLOBALS['episode_query']['has_password'],false,'Episode discovery excludes passwords');
check($GLOBALS['full_query']['has_password'],false,'Full text excludes passwords');
check($GLOBALS['full_query']['post_status'],'publish','Full text only public posts');
echo "$count SEO regression assertions passed.\n";
