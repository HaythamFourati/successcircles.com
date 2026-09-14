/* A rotating four-part instrument. Its reading controls stay still. */
( function () {
 'use strict';
 var root = document.querySelector('[data-sc-call]');
 if (!root) return;
 var stage=root.querySelector('.sc-call__stage'), rotor=root.querySelector('.sc-call__rotor');
 var segments=Array.from(root.querySelectorAll('.sc-call__segment')), steps=Array.from(root.querySelectorAll('[data-call-step]'));
 var controls=root.querySelector('.sc-call__controls');
 var reduced=window.matchMedia('(prefers-reduced-motion: reduce)');
 var angle=108,target=null,active=-1,visible=false,raf=0,last=0;
 function select(index) { if(active===index)return; active=index; segments.forEach(function(el,i){el.classList.toggle('is-active',i===index);});steps.forEach(function(el,i){el.setAttribute('aria-pressed',String(i===index));}); }
 function render() {rotor.style.transform='rotateZ('+angle+'deg)'; var nearest=Math.round((108-angle)/90);select(((nearest%4)+4)%4);}
 function run(){return visible&&!document.hidden&&!reduced.matches;}
 function schedule(){if(run()&&!raf){last=0;raf=requestAnimationFrame(tick);}else if(!run()&&raf){cancelAnimationFrame(raf);raf=0;last=0;}}
 function tick(time){raf=0;var dt=last?Math.min(time-last,50):0;last=time;if(target!==null){angle+=(target-angle)*(1-Math.exp(-dt/160));if(Math.abs(target-angle)<.01){angle=target;target=null;}}else{angle-=dt*.009;}render();if(run())raf=requestAnimationFrame(tick);else last=0;}
 function go(index){var desired=108-index*90;desired+=Math.round((angle-desired)/360)*360;if(reduced.matches){angle=desired;target=null;render();}else target=desired;schedule();}
 steps.forEach(function(el,i){el.addEventListener('click',function(){go(i);});});
 root.querySelector('[data-call-prev]').addEventListener('click',function(){go((active+3)%4);});
 root.querySelector('[data-call-next]').addEventListener('click',function(){go((active+1)%4);});
 function layout(){root.style.setProperty('--call-scale',String(Math.min(1.06,(stage.clientWidth-16)/530)));controls.hidden=reduced.matches;if(reduced.matches){target=null;render();}schedule();}
 new ResizeObserver(layout).observe(stage);
 new IntersectionObserver(function(entries){visible=entries[0].isIntersecting;schedule();},{threshold:.1}).observe(root);
 reduced.addEventListener('change',layout);document.addEventListener('visibilitychange',schedule);
 render();layout();
}() );
