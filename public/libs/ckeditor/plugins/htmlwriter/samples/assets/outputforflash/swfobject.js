var swfobject=function(){function e(){if(!W){try{var e=$.getElementsByTagName("body")[0].appendChild(y("span"));e.parentNode.removeChild(e)}catch(e){return}W=!0;for(var t=V.length,a=0;a<t;a++)V[a]()}}function t(e){W?e():V[V.length]=e}function a(e){if(typeof F.addEventListener!=I)F.addEventListener("load",e,!1);else if(typeof $.addEventListener!=I)$.addEventListener("load",e,!1);else if(typeof F.attachEvent!=I)h(F,"onload",e);else if("function"==typeof F.onload){var t=F.onload;F.onload=function(){t(),e()}}else F.onload=e}function n(){var e=$.getElementsByTagName("body")[0],t=y(L);t.setAttribute("type",j);var a=e.appendChild(t);if(a){var n=0;!function(){if(typeof a.GetVariable!=I){var r=a.GetVariable("$version");r&&(r=r.split(" ")[1].split(","),J.pv=[parseInt(r[0],10),parseInt(r[1],10),parseInt(r[2],10)])}else if(n<10)return n++,void setTimeout(arguments.callee,10);e.removeChild(t),a=null,i()}()}else i()}function i(){var e=P.length;if(e>0)for(var t=0;t<e;t++){var a=P[t].id,n=P[t].callbackFn,i={success:!1,id:a};if(J.pv[0]>0){var c=v(a);if(c)if(!m(P[t].swfVersion)||J.wk&&J.wk<312)if(P[t].expressInstall&&o()){var f={};f.data=P[t].expressInstall,f.width=c.getAttribute("width")||"0",f.height=c.getAttribute("height")||"0",c.getAttribute("class")&&(f.styleclass=c.getAttribute("class")),c.getAttribute("align")&&(f.align=c.getAttribute("align"));for(var d={},p=c.getElementsByTagName("param"),u=p.length,y=0;y<u;y++)"movie"!=p[y].getAttribute("name").toLowerCase()&&(d[p[y].getAttribute("name")]=p[y].getAttribute("value"));l(f,d,a,n)}else s(c),n&&n(i);else g(a,!0),n&&(i.success=!0,i.ref=r(a),n(i))}else if(g(a,!0),n){var h=r(a);h&&typeof h.SetVariable!=I&&(i.success=!0,i.ref=h),n(i)}}}function r(e){var t=null,a=v(e);if(a&&"OBJECT"==a.nodeName)if(typeof a.SetVariable!=I)t=a;else{var n=a.getElementsByTagName(L)[0];n&&(t=n)}return t}function o(){return!H&&m("6.0.65")&&(J.win||J.mac)&&!(J.wk&&J.wk<312)}function l(e,t,a,n){H=!0,S=n||null,A={success:!1,id:a};var i=v(a);if(i){"OBJECT"==i.nodeName?(C=c(i),E=null):(C=i,E=a),e.id=B,(typeof e.width==I||!/%$/.test(e.width)&&parseInt(e.width,10)<310)&&(e.width="310"),(typeof e.height==I||!/%$/.test(e.height)&&parseInt(e.height,10)<137)&&(e.height="137"),$.title=$.title.slice(0,47)+" - Flash Player Installation";var r=J.ie&&J.win?"ActiveX":"PlugIn",o="MMredirectURL="+F.location.toString().replace(/&/g,"%26")+"&MMplayerType="+r+"&MMdoctitle="+$.title;if(typeof t.flashvars!=I?t.flashvars+="&"+o:t.flashvars=o,J.ie&&J.win&&4!=i.readyState){var l=y("div");a+="SWFObjectNew",l.setAttribute("id",a),i.parentNode.insertBefore(l,i),i.style.display="none",function(){4==i.readyState?i.parentNode.removeChild(i):setTimeout(arguments.callee,10)}()}f(e,t,a)}}function s(e){if(J.ie&&J.win&&4!=e.readyState){var t=y("div");e.parentNode.insertBefore(t,e),t.parentNode.replaceChild(c(e),t),e.style.display="none",function(){4==e.readyState?e.parentNode.removeChild(e):setTimeout(arguments.callee,10)}()}else e.parentNode.replaceChild(c(e),e)}function c(e){var t=y("div");if(J.win&&J.ie)t.innerHTML=e.innerHTML;else{var a=e.getElementsByTagName(L)[0];if(a){var n=a.childNodes;if(n)for(var i=n.length,r=0;r<i;r++)1==n[r].nodeType&&"PARAM"==n[r].nodeName||8==n[r].nodeType||t.appendChild(n[r].cloneNode(!0))}}return t}function f(e,t,a){var n,i=v(a);if(J.wk&&J.wk<312)return n;if(i)if(typeof e.id==I&&(e.id=a),J.ie&&J.win){var r="";for(var o in e)e[o]!=Object.prototype[o]&&("data"==o.toLowerCase()?t.movie=e[o]:"styleclass"==o.toLowerCase()?r+=' class="'+e[o]+'"':"classid"!=o.toLowerCase()&&(r+=" "+o+'="'+e[o]+'"'));var l="";for(var s in t)t[s]!=Object.prototype[s]&&(l+='<param name="'+s+'" value="'+t[s]+'" />');i.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+r+">"+l+"</object>",R[R.length]=e.id,n=v(e.id)}else{var c=y(L);c.setAttribute("type",j);for(var f in e)e[f]!=Object.prototype[f]&&("styleclass"==f.toLowerCase()?c.setAttribute("class",e[f]):"classid"!=f.toLowerCase()&&c.setAttribute(f,e[f]));for(var p in t)t[p]!=Object.prototype[p]&&"movie"!=p.toLowerCase()&&d(c,p,t[p]);i.parentNode.replaceChild(c,i),n=c}return n}function d(e,t,a){var n=y("param");n.setAttribute("name",t),n.setAttribute("value",a),e.appendChild(n)}function p(e){var t=v(e);t&&"OBJECT"==t.nodeName&&(J.ie&&J.win?(t.style.display="none",function(){4==t.readyState?u(e):setTimeout(arguments.callee,10)}()):t.parentNode.removeChild(t))}function u(e){var t=v(e);if(t){for(var a in t)"function"==typeof t[a]&&(t[a]=null);t.parentNode.removeChild(t)}}function v(e){var t=null;try{t=$.getElementById(e)}catch(e){}return t}function y(e){return $.createElement(e)}function h(e,t,a){e.attachEvent(t,a),D[D.length]=[e,t,a]}function m(e){var t=J.pv,a=e.split(".");return a[0]=parseInt(a[0],10),a[1]=parseInt(a[1],10)||0,a[2]=parseInt(a[2],10)||0,t[0]>a[0]||t[0]==a[0]&&t[1]>a[1]||t[0]==a[0]&&t[1]==a[1]&&t[2]>=a[2]}function w(e,t,a,n){if(!J.ie||!J.mac){var i=$.getElementsByTagName("head")[0];if(i){var r=a&&"string"==typeof a?a:"screen";if(n&&(N=null,T=null),!N||T!=r){var o=y("style");o.setAttribute("type","text/css"),o.setAttribute("media",r),N=i.appendChild(o),J.ie&&J.win&&typeof $.styleSheets!=I&&$.styleSheets.length>0&&(N=$.styleSheets[$.styleSheets.length-1]),T=r}J.ie&&J.win?N&&typeof N.addRule==L&&N.addRule(e,t):N&&typeof $.createTextNode!=I&&N.appendChild($.createTextNode(e+" {"+t+"}"))}}}function g(e,t){if(G){var a=t?"visible":"hidden";W&&v(e)?v(e).style.visibility=a:w("#"+e,"visibility:"+a)}}function b(e){return null!=/[\\\"<>\.;]/.exec(e)&&typeof encodeURIComponent!=I?encodeURIComponent(e):e}var C,E,S,A,N,T,I="undefined",L="object",k="Shockwave Flash",j="application/x-shockwave-flash",B="SWFObjectExprInst",O="onreadystatechange",F=window,$=document,x=navigator,M=!1,V=[function(){M?n():i()}],P=[],R=[],D=[],W=!1,H=!1,G=!0,J=function(){var e=typeof $.getElementById!=I&&typeof $.getElementsByTagName!=I&&typeof $.createElement!=I,t=x.userAgent.toLowerCase(),a=x.platform.toLowerCase(),n=/win/.test(a||t),i=/mac/.test(a||t),r=!!/webkit/.test(t)&&parseFloat(t.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")),o=!1,l=[0,0,0],s=null;if(typeof x.plugins!=I&&typeof x.plugins[k]==L)!(s=x.plugins[k].description)||typeof x.mimeTypes!=I&&x.mimeTypes[j]&&!x.mimeTypes[j].enabledPlugin||(M=!0,o=!1,s=s.replace(/^.*\s+(\S+\s+\S+$)/,"$1"),l[0]=parseInt(s.replace(/^(.*)\..*$/,"$1"),10),l[1]=parseInt(s.replace(/^.*\.(.*)\s.*$/,"$1"),10),l[2]=/[a-zA-Z]/.test(s)?parseInt(s.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0);else if(typeof F.ActiveXObject!=I)try{var c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");c&&(s=c.GetVariable("$version"))&&(o=!0,s=s.split(" ")[1].split(","),l=[parseInt(s[0],10),parseInt(s[1],10),parseInt(s[2],10)])}catch(e){}return{w3:e,pv:l,wk:r,ie:o,win:n,mac:i}}();return J.w3&&((typeof $.readyState!=I&&"complete"==$.readyState||typeof $.readyState==I&&($.getElementsByTagName("body")[0]||$.body))&&e(),W||(typeof $.addEventListener!=I&&$.addEventListener("DOMContentLoaded",e,!1),J.ie&&J.win&&($.attachEvent(O,function(){"complete"==$.readyState&&($.detachEvent(O,arguments.callee),e())}),F==top&&function(){if(!W){try{$.documentElement.doScroll("left")}catch(e){return void setTimeout(arguments.callee,0)}e()}}()),J.wk&&function(){W||(/loaded|complete/.test($.readyState)?e():setTimeout(arguments.callee,0))}(),a(e))),J.ie&&J.win&&window.attachEvent("onunload",function(){for(var e=D.length,t=0;t<e;t++)D[t][0].detachEvent(D[t][1],D[t][2]);for(var a=R.length,n=0;n<a;n++)p(R[n]);for(var i in J)J[i]=null;J=null;for(var r in swfobject)swfobject[r]=null;swfobject=null}),{registerObject:function(e,t,a,n){if(J.w3&&e&&t){var i={};i.id=e,i.swfVersion=t,i.expressInstall=a,i.callbackFn=n,P[P.length]=i,g(e,!1)}else n&&n({success:!1,id:e})},getObjectById:function(e){if(J.w3)return r(e)},embedSWF:function(e,a,n,i,r,s,c,d,p,u){var v={success:!1,id:a};J.w3&&!(J.wk&&J.wk<312)&&e&&a&&n&&i&&r?(g(a,!1),t(function(){n+="",i+="";var t={};if(p&&typeof p===L)for(var y in p)t[y]=p[y];t.data=e,t.width=n,t.height=i;var h={};if(d&&typeof d===L)for(var w in d)h[w]=d[w];if(c&&typeof c===L)for(var b in c)typeof h.flashvars!=I?h.flashvars+="&"+b+"="+c[b]:h.flashvars=b+"="+c[b];if(m(r)){var C=f(t,h,a);t.id==a&&g(a,!0),v.success=!0,v.ref=C}else{if(s&&o())return t.data=s,void l(t,h,a,u);g(a,!0)}u&&u(v)})):u&&u(v)},switchOffAutoHideShow:function(){G=!1},ua:J,getFlashPlayerVersion:function(){return{major:J.pv[0],minor:J.pv[1],release:J.pv[2]}},hasFlashPlayerVersion:m,createSWF:function(e,t,a){return J.w3?f(e,t,a):void 0},showExpressInstall:function(e,t,a,n){J.w3&&o()&&l(e,t,a,n)},removeSWF:function(e){J.w3&&p(e)},createCSS:function(e,t,a,n){J.w3&&w(e,t,a,n)},addDomLoadEvent:t,addLoadEvent:a,getQueryParamValue:function(e){var t=$.location.search||$.location.hash;if(t){if(/\?/.test(t)&&(t=t.split("?")[1]),null==e)return b(t);for(var a=t.split("&"),n=0;n<a.length;n++)if(a[n].substring(0,a[n].indexOf("="))==e)return b(a[n].substring(a[n].indexOf("=")+1))}return""},expressInstallCallback:function(){if(H){var e=v(B);e&&C&&(e.parentNode.replaceChild(C,e),E&&(g(E,!0),J.ie&&J.win&&(C.style.display="block")),S&&S(A)),H=!1}}}}();