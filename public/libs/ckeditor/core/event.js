CKEDITOR.event||(CKEDITOR.event=function(){},CKEDITOR.event.implementOn=function(e){var t=CKEDITOR.event.prototype;for(var n in t)null==e[n]&&(e[n]=t[n])},CKEDITOR.event.prototype=function(){function e(e){var r=t(this);return r[e]||(r[e]=new n(e))}var t=function(e){var t=e.getPrivate&&e.getPrivate()||e._||(e._={});return t.events||(t.events={})},n=function(e){this.name=e,this.listeners=[]};return n.prototype={getListenerIndex:function(e){for(var t=0,n=this.listeners;t<n.length;t++)if(n[t].fn==e)return t;return-1}},{define:function(t,n){var r=e.call(this,t);CKEDITOR.tools.extend(r,n,!0)},on:function(t,n,r,i,s){function o(e,s,o,v){var u={name:t,sender:this,editor:e,data:s,listenerData:i,stop:o,cancel:v,removeListener:a};return!1!==n.call(r,u)&&u.data}function a(){f.removeListener(t,n)}var v=e.call(this,t);if(v.getListenerIndex(n)<0){var u=v.listeners;r||(r=this),isNaN(s)&&(s=10);var f=this;o.fn=n,o.priority=s;for(var l=u.length-1;l>=0;l--)if(u[l].priority<=s)return u.splice(l+1,0,o),{removeListener:a};u.unshift(o)}return{removeListener:a}},once:function(){var e=Array.prototype.slice.call(arguments),t=e[1];return e[1]=function(e){return e.removeListener(),t.apply(this,arguments)},this.on.apply(this,e)},capture:function(){CKEDITOR.event.useCapture=1;var e=this.on.apply(this,arguments);return CKEDITOR.event.useCapture=0,e},fire:function(){var e=0,n=function(){e=1},r=0,i=function(){r=1};return function(s,o,a){var v=t(this)[s],u=e,f=r;if(e=r=0,v){var l=v.listeners;if(l.length){l=l.slice(0);for(var c,h=0;h<l.length;h++){if(v.errorProof)try{c=l[h].call(this,a,o,n,i)}catch(e){}else c=l[h].call(this,a,o,n,i);if(!1===c?r=1:void 0!==c&&(o=c),e||r)break}}}var p=!r&&(void 0===o||o);return e=u,r=f,p}}(),fireOnce:function(e,n,r){var i=this.fire(e,n,r);return delete t(this)[e],i},removeListener:function(e,n){var r=t(this)[e];if(r){var i=r.getListenerIndex(n);i>=0&&r.listeners.splice(i,1)}},removeAllListeners:function(){var e=t(this);for(var n in e)delete e[n]},hasListeners:function(e){var n=t(this)[e];return n&&n.listeners.length>0}}}());