"use strict";!function(){function e(e,t,a){return t.type||(t.type="auto"),(!a||!1!==e.fire("beforePaste",t))&&!(!t.dataValue&&t.dataTransfer.isEmpty())&&(t.dataValue||(t.dataValue=""),CKEDITOR.env.gecko&&"drop"==t.method&&e.toolbox&&e.once("afterPaste",function(){e.toolbox.focus()}),e.fire("paste",t))}function t(t){function a(e){return{type:e,canUndo:"cut"==e,startDisabled:!0,fakeKeystroke:"cut"==e?CKEDITOR.CTRL+88:CKEDITOR.CTRL+67,exec:function(){"cut"==this.type&&s();var e=function(e){if(CKEDITOR.env.ie)return o(e);try{return t.document.$.execCommand(e,!1,null)}catch(e){return!1}}(this.type);return e||t.showNotification(t.lang.clipboard[this.type+"Error"]),e}}}function n(){return{canUndo:!1,async:!0,fakeKeystroke:CKEDITOR.CTRL+86,exec:function(t,a){function n(a,n){n=void 0===n||n,a?(a.method="paste",a.dataTransfer||(a.dataTransfer=p.initPasteDataTransfer()),e(t,a,n)):r&&t.showNotification(l,"info",t.config.clipboard_notificationDuration),t.fire("afterCommandExec",{name:"paste",command:i,returnValue:!!a})}var i=this,r=void 0===(a=void 0!==a&&null!==a?a:{}).notification||a.notification,o=a.type,s=CKEDITOR.tools.keystrokeToString(t.lang.common.keyboard,t.getCommandKeystroke(this)),l="string"==typeof r?r:t.lang.clipboard.pasteNotification.replace(/%1/,'<kbd aria-label="'+s.aria+'">'+s.display+"</kbd>"),d="string"==typeof a?a:a.dataValue;o?t._.nextPasteType=o:delete t._.nextPasteType,"string"==typeof d?n({dataValue:d}):t.getClipboardData(n)}}}function i(){g=1,setTimeout(function(){g=0},100)}function r(){T=1,setTimeout(function(){T=0},10)}function o(e){var a=t.document,n=a.getBody(),i=!1,r=function(){i=!0};return n.on(e,r),CKEDITOR.env.version>7?a.$.execCommand(e):a.$.selection.createRange().execCommand(e),n.removeListener(e,r),i}function s(){if(CKEDITOR.env.ie&&!CKEDITOR.env.quirks){var e,a,n,i=t.getSelection();i.getType()==CKEDITOR.SELECTION_ELEMENT&&(e=i.getSelectedElement())&&(a=i.getRanges()[0],(n=t.document.createText("")).insertBefore(e),a.setStartBefore(n),a.setEndAfter(e),i.selectRanges([a]),setTimeout(function(){e.getParent()&&(n.remove(),i.selectElement(e))},0))}}function l(e,a){var n,i=t.document,r=t.editable(),o=function(e){e.cancel()};if(!i.getById("cke_pastebin")){var s=t.getSelection(),l=s.createBookmarks();CKEDITOR.env.ie&&s.root.fire("selectionchange");var d=new CKEDITOR.dom.element(!CKEDITOR.env.webkit&&!r.is("body")||CKEDITOR.env.ie?"div":"body",i);d.setAttributes({id:"cke_pastebin","data-cke-temp":"1"});var c=0,u=i.getWindow();CKEDITOR.env.webkit?(r.append(d),d.addClass("cke_editable"),r.is("body")||(c=("static"!=r.getComputedStyle("position")?r:CKEDITOR.dom.element.get(r.$.offsetParent)).getDocumentPosition().y)):r.getAscendant(CKEDITOR.env.ie?"body":"html",1).append(d),d.setStyles({position:"absolute",top:u.getScrollPosition().y-c+10+"px",width:"1px",height:Math.max(1,u.getViewPaneSize().height-20)+"px",overflow:"hidden",margin:0,padding:0}),CKEDITOR.env.safari&&d.setStyles(CKEDITOR.tools.cssVendorPrefix("user-select","text"));var f=d.getParent().isReadOnly();f?(d.setOpacity(0),d.setAttribute("contenteditable",!0)):d.setStyle("ltr"==t.config.contentsLangDirection?"left":"right","-10000px"),t.on("selectionChange",o,null,null,0),(CKEDITOR.env.webkit||CKEDITOR.env.gecko)&&(n=r.once("blur",o,null,null,-100)),f&&d.focus();var p=new CKEDITOR.dom.range(d);p.selectNodeContents(d);var T=p.select();CKEDITOR.env.ie&&(n=r.once("blur",function(){t.lockSelection(T)}));var g=CKEDITOR.document.getWindow().getScrollPosition().y;setTimeout(function(){CKEDITOR.env.webkit&&(CKEDITOR.document.getBody().$.scrollTop=g),n&&n.removeListener(),CKEDITOR.env.ie&&r.focus(),s.selectBookmarks(l),d.remove();var e;CKEDITOR.env.webkit&&(e=d.getFirst())&&e.is&&e.hasClass("Apple-style-span")&&(d=e),t.removeListener("selectionChange",o),a(d.getHtml())},0)}}function d(){if("paste"==p.mainPasteEvent)return t.fire("beforePaste",{type:"auto",method:"paste"}),!1;t.focus(),i();var e=t.focusManager;return e.lock(),t.editable().fire(p.mainPasteEvent)&&!o("paste")?(e.unlock(),!1):(e.unlock(),!0)}function c(a){var n={type:"auto",method:"paste",dataTransfer:p.initPasteDataTransfer(a)};n.dataTransfer.cacheData();var i=!1!==t.fire("beforePaste",n);i&&p.canClipboardApiBeTrusted(n.dataTransfer,t)?(a.data.preventDefault(),setTimeout(function(){e(t,n)},0)):l(a,function(a){n.dataValue=a.replace(/<span[^>]+data-cke-bookmark[^<]*?<\/span>/gi,""),i&&e(t,n)})}function u(){if("wysiwyg"==t.mode){var e=f("paste");t.getCommand("cut").setState(f("cut")),t.getCommand("copy").setState(f("copy")),t.getCommand("paste").setState(e),t.fire("pasteState",e)}}function f(e){if(D&&e in{paste:1,cut:1})return CKEDITOR.TRISTATE_DISABLED;if("paste"==e)return CKEDITOR.TRISTATE_OFF;var a=t.getSelection(),n=a.getRanges();return a.getType()==CKEDITOR.SELECTION_NONE||1==n.length&&n[0].collapsed?CKEDITOR.TRISTATE_DISABLED:CKEDITOR.TRISTATE_OFF}var p=CKEDITOR.plugins.clipboard,T=0,g=0,D=0;t.on("key",function(e){if("wysiwyg"==t.mode)switch(e.data.keyCode){case CKEDITOR.CTRL+86:case CKEDITOR.SHIFT+45:var a=t.editable();return i(),void("paste"==p.mainPasteEvent&&a.fire("beforepaste"));case CKEDITOR.CTRL+88:case CKEDITOR.SHIFT+46:t.fire("saveSnapshot"),setTimeout(function(){t.fire("saveSnapshot")},50)}}),t.on("contentDom",function(){var e=t.editable();if(CKEDITOR.plugins.clipboard.isCustomCopyCutSupported){var a=function(e){t.readOnly&&"cut"==e.name||p.initPasteDataTransfer(e,t),e.data.preventDefault()};e.on("copy",a),e.on("cut",a),e.on("cut",function(){t.readOnly||t.extractSelectedHtml()},null,null,999)}e.on(p.mainPasteEvent,function(e){"beforepaste"==p.mainPasteEvent&&T||c(e)}),"beforepaste"==p.mainPasteEvent&&(e.on("paste",function(e){g||(i(),e.data.preventDefault(),c(e),o("paste"))}),e.on("contextmenu",r,null,null,0),e.on("beforepaste",function(e){!e.data||e.data.$.ctrlKey||e.data.$.shiftKey||r()},null,null,0)),e.on("beforecut",function(){!T&&s()});var n;e.attachListener(CKEDITOR.env.ie?e:t.document.getDocumentElement(),"mouseup",function(){n=setTimeout(function(){u()},0)}),t.on("destroy",function(){clearTimeout(n)}),e.on("keyup",u)}),t.on("selectionChange",function(e){D=e.data.selection.getRanges()[0].checkReadOnly(),u()}),t.contextMenu&&t.contextMenu.addListener(function(e,t){return D=t.getRanges()[0].checkReadOnly(),{cut:f("cut"),copy:f("copy"),paste:f("paste")}}),function(){function e(e,a,n,i,r){var o=t.lang.clipboard[a];t.addCommand(a,n),t.ui.addButton&&t.ui.addButton(e,{label:o,command:a,toolbar:"clipboard,"+i}),t.addMenuItems&&t.addMenuItem(a,{label:o,command:a,group:"clipboard",order:r})}e("Cut","cut",a("cut"),10,1),e("Copy","copy",a("copy"),20,4),e("Paste","paste",n(),30,8)}(),t.getClipboardData=function(e,a){function n(e){e.removeListener(),e.cancel(),a(e.data)}a||(a=e,e=null),t.on("paste",n,null,null,0),!1===d()&&(t.removeListener("paste",n),a(null))}}function a(e){if(CKEDITOR.env.webkit){if(!e.match(/^[^<]*$/g)&&!e.match(/^(<div><br( ?\/)?><\/div>|<div>[^<]*<\/div>)*$/gi))return"html"}else if(CKEDITOR.env.ie){if(!e.match(/^([^<]|<br( ?\/)?>)*$/gi)&&!e.match(/^(<p>([^<]|<br( ?\/)?>)*<\/p>|(\r\n))*$/gi))return"html"}else{if(!CKEDITOR.env.gecko)return"html";if(!e.match(/^([^<]|<br( ?\/)?>)*$/gi))return"html"}return"htmlifiedtext"}function n(e,t){function a(e){return CKEDITOR.tools.repeat("</p><p>",~~(e/2))+(e%2==1?"<br>":"")}return t=t.replace(/\s+/g," ").replace(/> +</g,"><").replace(/<br ?\/>/gi,"<br>"),(t=t.replace(/<\/?[A-Z]+>/g,function(e){return e.toLowerCase()})).match(/^[^<]$/)?t:(CKEDITOR.env.webkit&&t.indexOf("<div>")>-1&&((t=t.replace(/^(<div>(<br>|)<\/div>)(?!$|(<div>(<br>|)<\/div>))/g,"<br>").replace(/^(<div>(<br>|)<\/div>){2}(?!$)/g,"<div></div>")).match(/<div>(<br>|)<\/div>/)&&(t="<p>"+t.replace(/(<div>(<br>|)<\/div>)+/g,function(e){return a(e.split("</div><div>").length+1)})+"</p>"),t=(t=t.replace(/<\/div><div>/g,"<br>")).replace(/<\/?div>/g,"")),CKEDITOR.env.gecko&&e.enterMode!=CKEDITOR.ENTER_BR&&(CKEDITOR.env.gecko&&(t=t.replace(/^<br><br>$/,"<br>")),t.indexOf("<br><br>")>-1&&(t="<p>"+t.replace(/(<br>){2,}/g,function(e){return a(e.length/4)})+"</p>")),o(e,t))}function i(){function e(){var e={};for(var t in CKEDITOR.dtd)"$"!=t.charAt(0)&&"div"!=t&&"span"!=t&&(e[t]=1);return e}function t(){var t=new CKEDITOR.filter;return t.allow({$1:{elements:e(),attributes:!0,styles:!1,classes:!1}}),t}var a={};return{get:function(e){return"plain-text"==e?a.plainText||(a.plainText=new CKEDITOR.filter("br")):"semantic-content"==e?a.semanticContent||(a.semanticContent=t()):e?new CKEDITOR.filter(e):null}}}function r(e,t,a){var n=CKEDITOR.htmlParser.fragment.fromHtml(t),i=new CKEDITOR.htmlParser.basicWriter;return a.applyTo(n,!0,!1,e.activeEnterMode),n.writeHtml(i),i.getHtml()}function o(e,t){return e.enterMode==CKEDITOR.ENTER_BR?t=t.replace(/(<\/p><p>)+/g,function(e){return CKEDITOR.tools.repeat("<br>",e.length/7*2)}).replace(/<\/?p>/g,""):e.enterMode==CKEDITOR.ENTER_DIV&&(t=t.replace(/<(\/)?p>/g,"<$1div>")),t}function s(e){e.data.preventDefault(),e.data.$.dataTransfer.dropEffect="none"}function l(t){var a=CKEDITOR.plugins.clipboard;t.on("contentDom",function(){function n(a,n,i){n.select(),e(t,{dataTransfer:i,method:"drop"},1),i.sourceEditor.fire("saveSnapshot"),i.sourceEditor.editable().extractHtmlFromRange(a),i.sourceEditor.getSelection().selectRanges([a]),i.sourceEditor.fire("saveSnapshot")}function i(n,i){n.select(),e(t,{dataTransfer:i,method:"drop"},1),a.resetDragDataTransfer()}function r(e,a,n){var i={$:e.data.$,target:e.data.getTarget()};a&&(i.dragRange=a),n&&(i.dropRange=n),!1===t.fire(e.name,i)&&e.data.preventDefault()}function o(e){return e.type!=CKEDITOR.NODE_ELEMENT&&(e=e.getParent()),e.getChildCount()}var s=t.editable(),l=CKEDITOR.plugins.clipboard.getDropTarget(t),d=t.ui.space("top"),c=t.ui.space("bottom");a.preventDefaultDropOnElement(d),a.preventDefaultDropOnElement(c),s.attachListener(l,"dragstart",r),s.attachListener(t,"dragstart",a.resetDragDataTransfer,a,null,1),s.attachListener(t,"dragstart",function(e){a.initDragDataTransfer(e,t)},null,null,2),s.attachListener(t,"dragstart",function(){var e=a.dragRange=t.getSelection().getRanges()[0];CKEDITOR.env.ie&&CKEDITOR.env.version<10&&(a.dragStartContainerChildCount=e?o(e.startContainer):null,a.dragEndContainerChildCount=e?o(e.endContainer):null)},null,null,100),s.attachListener(l,"dragend",r),s.attachListener(t,"dragend",a.initDragDataTransfer,a,null,1),s.attachListener(t,"dragend",a.resetDragDataTransfer,a,null,100),s.attachListener(l,"dragover",function(e){if(CKEDITOR.env.edge)e.data.preventDefault();else{var t=e.data.getTarget();t&&t.is&&t.is("html")?e.data.preventDefault():CKEDITOR.env.ie&&CKEDITOR.plugins.clipboard.isFileApiSupported&&e.data.$.dataTransfer.types.contains("Files")&&e.data.preventDefault()}}),s.attachListener(l,"drop",function(e){if(!e.data.$.defaultPrevented){e.data.preventDefault();var n=e.data.getTarget();if(!n.isReadOnly()||n.type==CKEDITOR.NODE_ELEMENT&&n.is("html")){var i=a.getRangeAtDropPosition(e,t),o=a.dragRange;i&&r(e,o,i)}}},null,null,9999),s.attachListener(t,"drop",a.initDragDataTransfer,a,null,1),s.attachListener(t,"drop",function(e){var r=e.data;if(r){var o=r.dropRange,s=r.dragRange,l=r.dataTransfer;l.getTransferType(t)==CKEDITOR.DATA_TRANSFER_INTERNAL?setTimeout(function(){a.internalDrop(s,o,l,t)},0):l.getTransferType(t)==CKEDITOR.DATA_TRANSFER_CROSS_EDITORS?n(s,o,l):i(o,l)}},null,null,9999)})}CKEDITOR.plugins.add("clipboard",{requires:"notification",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"copy,copy-rtl,cut,cut-rtl,paste,paste-rtl",hidpi:!0,init:function(e){var o,s=i();if(e.config.forcePasteAsPlainText?o="plain-text":e.config.pasteFilter?o=e.config.pasteFilter:!CKEDITOR.env.webkit||"pasteFilter"in e.config||(o="semantic-content"),e.pasteFilter=s.get(o),t(e),l(e),CKEDITOR.env.gecko){var d,c=["image/png","image/jpeg","image/gif"];e.on("paste",function(t){var a=t.data,n=a.dataValue,i=a.dataTransfer;if(!n&&"paste"==a.method&&i&&1==i.getFilesCount()&&d!=i.id){var r=i.getFile(0);if(-1!=CKEDITOR.tools.indexOf(c,r.type)){var o=new FileReader;o.addEventListener("load",function(){t.data.dataValue='<img src="'+o.result+'" />',e.fire("paste",t.data)},!1),o.addEventListener("abort",function(){e.fire("paste",t.data)},!1),o.addEventListener("error",function(){e.fire("paste",t.data)},!1),o.readAsDataURL(r),d=a.dataTransfer.id,t.stop()}}},null,null,1)}e.on("paste",function(t){if(t.data.dataTransfer||(t.data.dataTransfer=new CKEDITOR.plugins.clipboard.dataTransfer),!t.data.dataValue){var a=t.data.dataTransfer,n=a.getData("text/html");n?(t.data.dataValue=n,t.data.type="html"):(n=a.getData("text/plain"))&&(t.data.dataValue=e.editable().transformPlainTextToHtml(n),t.data.type="text")}},null,null,1),e.on("paste",function(e){var t=e.data.dataValue,a=CKEDITOR.dtd.$block;if(t.indexOf("Apple-")>-1&&(t=t.replace(/<span class="Apple-converted-space">&nbsp;<\/span>/gi," "),"html"!=e.data.type&&(t=t.replace(/<span class="Apple-tab-span"[^>]*>([^<]*)<\/span>/gi,function(e,t){return t.replace(/\t/g,"&nbsp;&nbsp; &nbsp;")})),t.indexOf('<br class="Apple-interchange-newline">')>-1&&(e.data.startsWithEOL=1,e.data.preSniffing="html",t=t.replace(/<br class="Apple-interchange-newline">/,"")),t=t.replace(/(<[^>]+) class="Apple-[^"]*"/gi,"$1")),t.match(/^<[^<]+cke_(editable|contents)/i)){var n,i,r=new CKEDITOR.dom.element("div");for(r.setHtml(t);1==r.getChildCount()&&(n=r.getFirst())&&n.type==CKEDITOR.NODE_ELEMENT&&(n.hasClass("cke_editable")||n.hasClass("cke_contents"));)r=i=n;i&&(t=i.getHtml().replace(/<br>$/i,""))}CKEDITOR.env.ie?t=t.replace(/^&nbsp;(?: |\r\n)?<(\w+)/g,function(t,n){return n.toLowerCase()in a?(e.data.preSniffing="html","<"+n):t}):CKEDITOR.env.webkit?t=t.replace(/<\/(\w+)><div><br><\/div>$/,function(t,n){return n in a?(e.data.endsWithEOL=1,"</"+n+">"):t}):CKEDITOR.env.gecko&&(t=t.replace(/(\s)<br>$/,"$1")),e.data.dataValue=t},null,null,3),e.on("paste",function(t){var i,o=t.data,l=e._.nextPasteType||o.type,d=o.dataValue,c=e.config.clipboard_defaultContentType||"html",u=o.dataTransfer.getTransferType(e);i="html"==l||"html"==o.preSniffing?"html":a(d),delete e._.nextPasteType,"htmlifiedtext"==i&&(d=n(e.config,d)),"text"==l&&"html"==i?d=r(e,d,s.get("plain-text")):u==CKEDITOR.DATA_TRANSFER_EXTERNAL&&e.pasteFilter&&!o.dontFilter&&(d=r(e,d,e.pasteFilter)),o.startsWithEOL&&(d='<br data-cke-eol="1">'+d),o.endsWithEOL&&(d+='<br data-cke-eol="1">'),"auto"==l&&(l="html"==i||"html"==c?"html":"text"),o.type=l,o.dataValue=d,delete o.preSniffing,delete o.startsWithEOL,delete o.endsWithEOL},null,null,6),e.on("paste",function(t){var a=t.data;a.dataValue&&(e.insertHtml(a.dataValue,a.type,a.range),setTimeout(function(){e.fire("afterPaste")},0))},null,null,1e3)}}),CKEDITOR.plugins.clipboard={isCustomCopyCutSupported:!CKEDITOR.env.ie&&!CKEDITOR.env.iOS,isCustomDataTypesSupported:!CKEDITOR.env.ie,isFileApiSupported:!CKEDITOR.env.ie||CKEDITOR.env.version>9,mainPasteEvent:CKEDITOR.env.ie&&!CKEDITOR.env.edge?"beforepaste":"paste",canClipboardApiBeTrusted:function(e,t){return e.getTransferType(t)!=CKEDITOR.DATA_TRANSFER_EXTERNAL||!(!CKEDITOR.env.chrome||e.isEmpty())||!(!CKEDITOR.env.gecko||!e.getData("text/html")&&!e.getFilesCount())||!(!(CKEDITOR.env.safari&&CKEDITOR.env.version>=603)||CKEDITOR.env.iOS)},getDropTarget:function(e){var t=e.editable();return CKEDITOR.env.ie&&CKEDITOR.env.version<9||t.isInline()?t:e.document},fixSplitNodesAfterDrop:function(e,t,a,n){function i(e,a,n){var i=e;if(i.type==CKEDITOR.NODE_TEXT&&(i=e.getParent()),i.equals(a)&&n!=a.getChildCount())return r(t),!0}function r(e){var t=e.startContainer.getChild(e.startOffset-1),a=e.startContainer.getChild(e.startOffset);if(t&&t.type==CKEDITOR.NODE_TEXT&&a&&a.type==CKEDITOR.NODE_TEXT){var n=t.getLength();t.setText(t.getText()+a.getText()),a.remove(),e.setStart(t,n),e.collapse(!0)}}var o=t.startContainer;"number"==typeof n&&"number"==typeof a&&o.type==CKEDITOR.NODE_ELEMENT&&(i(e.startContainer,o,a)||i(e.endContainer,o,n))},isDropRangeAffectedByDragRange:function(e,t){var a=t.startContainer,n=t.endOffset;return!!(e.endContainer.equals(a)&&e.endOffset<=n)||!!(e.startContainer.getParent().equals(a)&&e.startContainer.getIndex()<n)||!!(e.endContainer.getParent().equals(a)&&e.endContainer.getIndex()<n)},internalDrop:function(t,a,n,i){var r,o,s,l=CKEDITOR.plugins.clipboard,d=i.editable();i.fire("saveSnapshot"),i.fire("lockSnapshot",{dontUpdate:1}),CKEDITOR.env.ie&&CKEDITOR.env.version<10&&this.fixSplitNodesAfterDrop(t,a,l.dragStartContainerChildCount,l.dragEndContainerChildCount),(s=this.isDropRangeAffectedByDragRange(t,a))||(r=t.createBookmark(!1)),o=a.clone().createBookmark(!1),s&&(r=t.createBookmark(!1));var c=r.startNode,u=r.endNode,f=o.startNode;u&&c.getPosition(f)&CKEDITOR.POSITION_PRECEDING&&u.getPosition(f)&CKEDITOR.POSITION_FOLLOWING&&f.insertBefore(c),(t=i.createRange()).moveToBookmark(r),d.extractHtmlFromRange(t,1),(a=i.createRange()).moveToBookmark(o),e(i,{dataTransfer:n,method:"drop",range:a},1),i.fire("unlockSnapshot")},getRangeAtDropPosition:function(e,t){var a,n=e.data.$,i=n.clientX,r=n.clientY,o=t.getSelection(!0).getRanges()[0],s=t.createRange();if(e.data.testRange)return e.data.testRange;if(document.caretRangeFromPoint&&t.document.$.caretRangeFromPoint(i,r))a=t.document.$.caretRangeFromPoint(i,r),s.setStart(CKEDITOR.dom.node(a.startContainer),a.startOffset),s.collapse(!0);else if(n.rangeParent)s.setStart(CKEDITOR.dom.node(n.rangeParent),n.rangeOffset),s.collapse(!0);else{if(CKEDITOR.env.ie&&CKEDITOR.env.version>8&&o&&t.editable().hasFocus)return o;if(!document.body.createTextRange)return null;t.focus(),a=t.document.getBody().$.createTextRange();try{for(var l=!1,d=0;d<20&&!l;d++){if(!l)try{a.moveToPoint(i,r-d),l=!0}catch(e){}if(!l)try{a.moveToPoint(i,r+d),l=!0}catch(e){}}if(l){var c="cke-temp-"+(new Date).getTime();a.pasteHTML('<span id="'+c+'">​</span>');var u=t.document.getById(c);s.moveToPosition(u,CKEDITOR.POSITION_BEFORE_START),u.remove()}else{var f=t.document.$.elementFromPoint(i,r),p=new CKEDITOR.dom.element(f);if(p.equals(t.editable())||"html"==p.getName())return o&&o.startContainer&&!o.startContainer.equals(t.editable())?o:null;i<p.getClientRect().left?(s.setStartAt(p,CKEDITOR.POSITION_AFTER_START),s.collapse(!0)):(s.setStartAt(p,CKEDITOR.POSITION_BEFORE_END),s.collapse(!0))}}catch(e){return null}}return s},initDragDataTransfer:function(e,t){var a=e.data.$?e.data.$.dataTransfer:null,n=new this.dataTransfer(a,t);a?this.dragData&&n.id==this.dragData.id?n=this.dragData:this.dragData=n:this.dragData?n=this.dragData:this.dragData=n,e.data.dataTransfer=n},resetDragDataTransfer:function(){this.dragData=null},initPasteDataTransfer:function(e,t){if(this.isCustomCopyCutSupported){if(e&&e.data&&e.data.$){var a=new this.dataTransfer(e.data.$.clipboardData,t);return this.copyCutData&&a.id==this.copyCutData.id?(a=this.copyCutData).$=e.data.$.clipboardData:this.copyCutData=a,a}return new this.dataTransfer(null,t)}return new this.dataTransfer(CKEDITOR.env.edge&&e&&e.data.$&&e.data.$.clipboardData||null,t)},preventDefaultDropOnElement:function(e){e&&e.on("dragover",s)}};var d=CKEDITOR.plugins.clipboard.isCustomDataTypesSupported?"cke/id":"Text";CKEDITOR.plugins.clipboard.dataTransfer=function(e,t){if(e&&(this.$=e),this._={metaRegExp:/^<meta.*?>/i,bodyRegExp:/<body(?:[\s\S]*?)>([\s\S]*)<\/body>/i,fragmentRegExp:/<!--(?:Start|End)Fragment-->/g,data:{},files:[],normalizeType:function(e){return"text"==(e=e.toLowerCase())||"text/plain"==e?"Text":"url"==e?"URL":e}},this.id=this.getData(d),this.id||(this.id="Text"==d?"":"cke-"+CKEDITOR.tools.getUniqueId()),"Text"!=d)try{this.$.setData(d,this.id)}catch(e){}t&&(this.sourceEditor=t,this.setData("text/html",t.getSelectedHtml(1)),"Text"==d||this.getData("text/plain")||this.setData("text/plain",t.getSelection().getSelectedText()))},CKEDITOR.DATA_TRANSFER_INTERNAL=1,CKEDITOR.DATA_TRANSFER_CROSS_EDITORS=2,CKEDITOR.DATA_TRANSFER_EXTERNAL=3,CKEDITOR.plugins.clipboard.dataTransfer.prototype={getData:function(e,t){function a(e){return void 0===e||null===e||""===e}e=this._.normalizeType(e);var n,i=this._.data[e];if(a(i))try{i=this.$.getData(e)}catch(e){}return a(i)&&(i=""),"text/html"!=e||t?"Text"==e&&CKEDITOR.env.gecko&&this.getFilesCount()&&"file://"==i.substring(0,7)&&(i=""):(i=i.replace(this._.metaRegExp,""),(n=this._.bodyRegExp.exec(i))&&n.length&&(i=(i=n[1]).replace(this._.fragmentRegExp,""))),function(e){if("string"!=typeof e)return e;var t=e.indexOf("</html>");return-1!==t?e.substring(0,t+7):e}(i)},setData:function(e,t){if(e=this._.normalizeType(e),this._.data[e]=t,CKEDITOR.plugins.clipboard.isCustomDataTypesSupported||"URL"==e||"Text"==e){"Text"==d&&"Text"==e&&(this.id=t);try{this.$.setData(e,t)}catch(e){}}},getTransferType:function(e){return this.sourceEditor?this.sourceEditor==e?CKEDITOR.DATA_TRANSFER_INTERNAL:CKEDITOR.DATA_TRANSFER_CROSS_EDITORS:CKEDITOR.DATA_TRANSFER_EXTERNAL},cacheData:function(){function e(e){e=n._.normalizeType(e);var t=n.getData(e,!0);t&&(n._.data[e]=t)}if(this.$){var t,a,n=this;if(CKEDITOR.plugins.clipboard.isCustomDataTypesSupported){if(this.$.types)for(t=0;t<this.$.types.length;t++)e(this.$.types[t])}else e("Text"),e("URL");if(a=this._getImageFromClipboard(),this.$&&this.$.files||a){if(this._.files=[],this.$.files&&this.$.files.length)for(t=0;t<this.$.files.length;t++)this._.files.push(this.$.files[t]);0===this._.files.length&&a&&this._.files.push(a)}}},getFilesCount:function(){return this._.files.length?this._.files.length:this.$&&this.$.files&&this.$.files.length?this.$.files.length:this._getImageFromClipboard()?1:0},getFile:function(e){return this._.files.length?this._.files[e]:this.$&&this.$.files&&this.$.files.length?this.$.files[e]:0===e?this._getImageFromClipboard():void 0},isEmpty:function(){var e,t={};if(this.getFilesCount())return!1;for(e in this._.data)t[e]=1;if(this.$)if(CKEDITOR.plugins.clipboard.isCustomDataTypesSupported){if(this.$.types)for(var a=0;a<this.$.types.length;a++)t[this.$.types[a]]=1}else t.Text=1,t.URL=1;"Text"!=d&&(t[d]=0);for(e in t)if(t[e]&&""!==this.getData(e))return!1;return!0},_getImageFromClipboard:function(){var e;if(this.$&&this.$.items&&this.$.items[0])try{if((e=this.$.items[0].getAsFile())&&e.type)return e}catch(e){}}}}(),CKEDITOR.config.clipboard_notificationDuration=1e4;