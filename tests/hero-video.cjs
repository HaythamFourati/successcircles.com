// Exercise the real controller with a minimal DOM/SDK adapter, without network.
const assert = require('node:assert/strict');
const vm = require('node:vm');
const fs = require('node:fs');
const source = fs.readFileSync('assets/js/hero-video.js', 'utf8');
async function scenario(failSDK) {
  const handlers = {}, events = {}, scripts = [];
  const button = { disabled: false, attrs: {}, setAttribute(k,v){this.attrs[k]=v;}, removeAttribute(k){delete this.attrs[k];}, addEventListener(k,fn){handlers[k]=fn;} };
  const iframe = {dataset:{src:'https://player.vimeo.com/video/1223972706?autoplay=0'}};
  const fallback = {hidden:true};
  const classes = new Set();
  const frame = {querySelector(s){return s==='button'?button:s==='iframe'?iframe:fallback;},classList:{add(s){classes.add(s);},toggle(s,b){b?classes.add(s):classes.delete(s);}}};
  let play=0,pause=0;
  const window = {};
  const document = {querySelector(){return frame;}, createElement(){return {remove(){}};}, head:{appendChild(s){scripts.push(s);queueMicrotask(()=>{
    if(failSDK){s.onerror();return;}
    window.Vimeo={Player:class {on(k,fn){events[k]=fn;}ready(){return Promise.resolve();}play(){play++;events.play();return Promise.resolve();}pause(){pause++;events.pause();return Promise.resolve();}}};s.onload();
  });}}};
  vm.runInNewContext(source,{window,document,Promise,Error,setTimeout(){return 1;},clearTimeout(){}});
  assert.equal(scripts.length,0);assert.equal(iframe.src,undefined);
  handlers.click(); await new Promise(setImmediate);
  assert.equal(scripts.length,1);assert.match(iframe.src,/player.vimeo.com/);assert.equal(button.disabled,false);
  if(failSDK){assert.equal(fallback.hidden,false);assert.equal(play,0);}
  else {assert.equal(play,1);assert.equal(classes.has('has-played'),true);handlers.click();await new Promise(setImmediate);assert.equal(pause,1);assert.equal(scripts.length,1);}
}
(async()=>{await scenario(false);await scenario(true);console.log('Deferred loading, play/pause, no duplicate SDK, and failure fallback passed.');})();
