"use strict";!function(){function e(e){return e.replace(/\\'/g,"'")}function t(e){return e.replace(/'/g,"\\$&")}function a(e){for(var t,a=e.length,n=[],r=0;r<a;r++)t=e.charCodeAt(r),n.push(t);return"String.fromCharCode("+n.join(",")+")"}function n(e,a){var n,r,o,i=e.plugins.link,l=i.compiledProtectionFunction.name,d=i.compiledProtectionFunction.params;o=[l,"("];for(var c=0;c<d.length;c++)r=a[n=d[c].toLowerCase()],c>0&&o.push(","),o.push("'",r?t(encodeURIComponent(a[n])):"","'");return o.push(")"),o.join("")}function r(e){var t,a=e.config.emailProtection||"";return a&&"encode"!=a&&(t={},a.replace(/^([^(]+)\(([^)]+)\)$/,function(e,a,n){t.name=a,t.params=[],n.replace(/[^,\s]+/g,function(e){t.params.push(e)})})),t}CKEDITOR.plugins.add("link",{requires:"dialog,fakeobjects",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"anchor,anchor-rtl,link,unlink",hidpi:!0,onLoad:function(){function e(e){return a.replace(/%1/g,"rtl"==e?"right":"left").replace(/%2/g,"cke_contents_"+e)}var t="background:url("+CKEDITOR.getUrl(this.path+"images"+(CKEDITOR.env.hidpi?"/hidpi":"")+"/anchor.png")+") no-repeat %1 center;border:1px dotted #00f;background-size:16px;",a=".%2 a.cke_anchor,.%2 a.cke_anchor_empty,.cke_editable.%2 a[name],.cke_editable.%2 a[data-cke-saved-name]{"+t+"padding-%1:18px;cursor:auto;}.%2 img.cke_anchor{"+t+"width:16px;min-height:15px;height:1.15em;vertical-align:text-bottom;}";CKEDITOR.addCss(e("ltr")+e("rtl"))},init:function(e){var t="a[!href]";CKEDITOR.dialog.isTabEnabled(e,"link","advanced")&&(t=t.replace("]",",accesskey,charset,dir,id,lang,name,rel,tabindex,title,type,download]{*}(*)")),CKEDITOR.dialog.isTabEnabled(e,"link","target")&&(t=t.replace("]",",target,onclick]")),e.addCommand("link",new CKEDITOR.dialogCommand("link",{allowedContent:t,requiredContent:"a[href]"})),e.addCommand("anchor",new CKEDITOR.dialogCommand("anchor",{allowedContent:"a[!name,id]",requiredContent:"a[name]"})),e.addCommand("unlink",new CKEDITOR.unlinkCommand),e.addCommand("removeAnchor",new CKEDITOR.removeAnchorCommand),e.setKeystroke(CKEDITOR.CTRL+76,"link"),e.ui.addButton&&(e.ui.addButton("Link",{label:e.lang.link.toolbar,command:"link",toolbar:"links,10"}),e.ui.addButton("Unlink",{label:e.lang.link.unlink,command:"unlink",toolbar:"links,20"}),e.ui.addButton("Anchor",{label:e.lang.link.anchor.toolbar,command:"anchor",toolbar:"links,30"})),CKEDITOR.dialog.add("link",this.path+"dialogs/link.js"),CKEDITOR.dialog.add("anchor",this.path+"dialogs/anchor.js"),e.on("doubleclick",function(t){var a=CKEDITOR.plugins.link.getSelectedLink(e)||t.data.element.getAscendant("a",1);a&&!a.isReadOnly()&&(a.is("a")?(t.data.dialog=!a.getAttribute("name")||a.getAttribute("href")&&a.getChildCount()?"link":"anchor",t.data.link=a):CKEDITOR.plugins.link.tryRestoreFakeAnchor(e,a)&&(t.data.dialog="anchor"))},null,null,0),e.on("doubleclick",function(t){t.data.dialog in{link:1,anchor:1}&&t.data.link&&e.getSelection().selectElement(t.data.link)},null,null,20),e.addMenuItems&&e.addMenuItems({anchor:{label:e.lang.link.anchor.menu,command:"anchor",group:"anchor",order:1},removeAnchor:{label:e.lang.link.anchor.remove,command:"removeAnchor",group:"anchor",order:5},link:{label:e.lang.link.menu,command:"link",group:"link",order:1},unlink:{label:e.lang.link.unlink,command:"unlink",group:"link",order:5}}),e.contextMenu&&e.contextMenu.addListener(function(t){if(!t||t.isReadOnly())return null;var a=CKEDITOR.plugins.link.tryRestoreFakeAnchor(e,t);if(!a&&!(a=CKEDITOR.plugins.link.getSelectedLink(e)))return null;var n={};return a.getAttribute("href")&&a.getChildCount()&&(n={link:CKEDITOR.TRISTATE_OFF,unlink:CKEDITOR.TRISTATE_OFF}),a&&a.hasAttribute("name")&&(n.anchor=n.removeAnchor=CKEDITOR.TRISTATE_OFF),n}),this.compiledProtectionFunction=r(e)},afterInit:function(e){e.dataProcessor.dataFilter.addRules({elements:{a:function(t){return t.attributes.name?t.children.length?null:e.createFakeParserElement(t,"cke_anchor","anchor"):null}}});var t=e._.elementsPath&&e._.elementsPath.filters;t&&t.push(function(t,a){if("a"==a&&(CKEDITOR.plugins.link.tryRestoreFakeAnchor(e,t)||t.getAttribute("name")&&(!t.getAttribute("href")||!t.getChildCount())))return"anchor"})}});var o=/^javascript:/,i=/^mailto:([^?]+)(?:\?(.+))?$/,l=/subject=([^;?:@&=$,\/]*)/i,d=/body=([^;?:@&=$,\/]*)/i,c=/^#(.*)$/,s=/^((?:http|https|ftp|news):\/\/)?(.*)$/,u=/^(_(?:self|top|parent|blank))$/,m=/^javascript:void\(location\.href='mailto:'\+String\.fromCharCode\(([^)]+)\)(?:\+'(.*)')?\)$/,h=/^javascript:([^(]+)\(([^)]+)\)$/,g=/\s*window.open\(\s*this\.href\s*,\s*(?:'([^']*)'|null)\s*,\s*'([^']*)'\s*\)\s*;\s*return\s*false;*\s*/,p=/(?:^|,)([^=]+)=(\d+|yes|no)/gi,k={id:"advId",dir:"advLangDir",accessKey:"advAccessKey",name:"advName",lang:"advLangCode",tabindex:"advTabIndex",title:"advTitle",type:"advContentType",class:"advCSSClasses",charset:"advCharset",style:"advStyles",rel:"advRel"};CKEDITOR.plugins.link={getSelectedLink:function(e,t){var a,n,r,o=e.getSelection(),i=o.getSelectedElement(),l=o.getRanges(),d=[];if(!t&&i&&i.is("a"))return i;for(r=0;r<l.length;r++)if((n=o.getRanges()[r]).shrink(CKEDITOR.SHRINK_TEXT,!1,{skipBogus:!0}),(a=e.elementPath(n.getCommonAncestor()).contains("a",1))&&t)d.push(a);else if(a)return a;return t?d:null},getEditorAnchors:function(e){for(var t,a=e.editable(),n=a.isInline()&&!e.plugins.divarea?e.document:a,r=n.getElementsByTag("a"),o=n.getElementsByTag("img"),i=[],l=0;t=r.getItem(l++);)(t.data("cke-saved-name")||t.hasAttribute("name"))&&i.push({name:t.data("cke-saved-name")||t.getAttribute("name"),id:t.getAttribute("id")});for(l=0;t=o.getItem(l++);)(t=this.tryRestoreFakeAnchor(e,t))&&i.push({name:t.getAttribute("name"),id:t.getAttribute("id")});return i},fakeAnchor:!0,tryRestoreFakeAnchor:function(e,t){if(t&&t.data("cke-real-element-type")&&"anchor"==t.data("cke-real-element-type")){var a=e.restoreRealElement(t);if(a.data("cke-saved-name"))return a}},parseLinkAttributes:function(t,a){var n,r,f,v=a&&(a.data("cke-saved-href")||a.getAttribute("href"))||"",C=t.plugins.link.compiledProtectionFunction,b=t.config.emailProtection,T={};if(v.match(o)&&("encode"==b?v=v.replace(m,function(t,a,n){return n=n||"","mailto:"+String.fromCharCode.apply(String,a.split(","))+e(n)}):b&&v.replace(h,function(t,a,n){if(a==C.name){T.type="email";for(var r,o=T.email={},i=/[^,\s]+/g,l=/(^')|('$)/g,d=n.match(i),c=d.length,s=0;s<c;s++)r=decodeURIComponent(e(d[s].replace(l,""))),o[C.params[s].toLowerCase()]=r;o.address=[o.name,o.domain].join("@")}})),!T.type)if(r=v.match(c))T.type="anchor",T.anchor={},T.anchor.name=T.anchor.id=r[1];else if(n=v.match(i)){var R=v.match(l),E=v.match(d);T.type="email";var I=T.email={};I.address=n[1],R&&(I.subject=decodeURIComponent(R[1])),E&&(I.body=decodeURIComponent(E[1]))}else v&&(f=v.match(s))&&(T.type="url",T.url={},T.url.protocol=f[1],T.url.url=f[2]);if(a){var y=a.getAttribute("target");if(y)T.target={type:y.match(u)?y:"frame",name:y};else{var A=a.data("cke-pa-onclick")||a.getAttribute("onclick"),O=A&&A.match(g);if(O){T.target={type:"popup",name:O[1]};for(var D;D=p.exec(O[2]);)"yes"!=D[2]&&"1"!=D[2]||D[1]in{height:1,width:1,top:1,left:1}?isFinite(D[2])&&(T.target[D[1]]=D[2]):T.target[D[1]]=!0}}null!==a.getAttribute("download")&&(T.download=!0);var K={};for(var S in k){var w=a.getAttribute(S);w&&(K[k[S]]=w)}var x=a.data("cke-saved-name")||K.advName;x&&(K.advName=x),CKEDITOR.tools.isEmpty(K)||(T.advanced=K)}return T},getLinkAttributes:function(e,r){var o=e.config.emailProtection||"",i={};switch(r.type){case"url":var l=r.url&&void 0!==r.url.protocol?r.url.protocol:"http://",d=r.url&&CKEDITOR.tools.trim(r.url.url)||"";i["data-cke-saved-href"]=0===d.indexOf("/")?d:l+d;break;case"anchor":var c=r.anchor&&r.anchor.name,s=r.anchor&&r.anchor.id;i["data-cke-saved-href"]="#"+(c||s||"");break;case"email":var u,m=r.email,h=m.address;switch(o){case"":case"encode":var g=encodeURIComponent(m.subject||""),p=encodeURIComponent(m.body||""),f=[];g&&f.push("subject="+g),p&&f.push("body="+p),f=f.length?"?"+f.join("&"):"","encode"==o?(u=["javascript:void(location.href='mailto:'+",a(h)],f&&u.push("+'",t(f),"'"),u.push(")")):u=["mailto:",h,f];break;default:var v=h.split("@",2);m.name=v[0],m.domain=v[1],u=["javascript:",n(e,m)]}i["data-cke-saved-href"]=u.join("")}if(r.target)if("popup"==r.target.type){for(var C=["window.open(this.href, '",r.target.name||"","', '"],b=["resizable","status","location","toolbar","menubar","fullscreen","scrollbars","dependent"],T=b.length,R=function(e){r.target[e]&&b.push(e+"="+r.target[e])},E=0;E<T;E++)b[E]=b[E]+(r.target[b[E]]?"=yes":"=no");R("width"),R("left"),R("height"),R("top"),C.push(b.join(","),"'); return false;"),i["data-cke-pa-onclick"]=C.join("")}else"notSet"!=r.target.type&&r.target.name&&(i.target=r.target.name);if(r.download&&(i.download=""),r.advanced){for(var I in k){var y=r.advanced[k[I]];y&&(i[I]=y)}i.name&&(i["data-cke-saved-name"]=i.name)}i["data-cke-saved-href"]&&(i.href=i["data-cke-saved-href"]);var A={target:1,onclick:1,"data-cke-pa-onclick":1,"data-cke-saved-name":1,download:1};r.advanced&&CKEDITOR.tools.extend(A,k);for(var O in i)delete A[O];return{set:i,removed:CKEDITOR.tools.objectKeys(A)}},showDisplayTextForElement:function(e,t){var a={img:1,table:1,tbody:1,thead:1,tfoot:1,input:1,select:1,textarea:1},n=t.getSelection();return!(t.widgets&&t.widgets.focused||n&&n.getRanges().length>1||e&&e.getName&&e.is(a))}},CKEDITOR.unlinkCommand=function(){},CKEDITOR.unlinkCommand.prototype={exec:function(e){if(CKEDITOR.env.ie){var t,a=e.getSelection().getRanges()[0],n=a.getPreviousEditableNode()&&a.getPreviousEditableNode().getAscendant("a",!0)||a.getNextEditableNode()&&a.getNextEditableNode().getAscendant("a",!0);a.collapsed&&n&&(t=a.createBookmark(),a.selectNodeContents(n),a.select())}var r=new CKEDITOR.style({element:"a",type:CKEDITOR.STYLE_INLINE,alwaysRemoveElement:1});e.removeStyle(r),t&&(a.moveToBookmark(t),a.select())},refresh:function(e,t){var a=t.lastElement&&t.lastElement.getAscendant("a",!0);a&&"a"==a.getName()&&a.getAttribute("href")&&a.getChildCount()?this.setState(CKEDITOR.TRISTATE_OFF):this.setState(CKEDITOR.TRISTATE_DISABLED)},contextSensitive:1,startDisabled:1,requiredContent:"a[href]",editorFocus:1},CKEDITOR.removeAnchorCommand=function(){},CKEDITOR.removeAnchorCommand.prototype={exec:function(e){var t,a=e.getSelection(),n=a.createBookmarks();a&&(t=a.getSelectedElement())&&(t.getChildCount()?t.is("a"):CKEDITOR.plugins.link.tryRestoreFakeAnchor(e,t))?t.remove(1):(t=CKEDITOR.plugins.link.getSelectedLink(e))&&(t.hasAttribute("href")?(t.removeAttributes({name:1,"data-cke-saved-name":1}),t.removeClass("cke_anchor")):t.remove(1)),a.selectBookmarks(n)},requiredContent:"a[name]"},CKEDITOR.tools.extend(CKEDITOR.config,{linkShowAdvancedTab:!0,linkShowTargetTab:!0})}();