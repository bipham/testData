"use strict";CKEDITOR.STYLE_BLOCK=1,CKEDITOR.STYLE_INLINE=2,CKEDITOR.STYLE_OBJECT=3,function(){function e(e,t){for(var n,r;(e=e.getParent())&&!e.equals(t);)if(e.getAttribute("data-nostyle"))n=e;else if(!r){var i=e.getAttribute("contentEditable");"false"==i?n=e:"true"==i&&(r=1)}return n}function t(e,t,n,r,i,s,a,l){return r?!i[r]||s?0:a&&!l?0:o(t,n,e,F):1}function n(e,t,n,r){return t&&((t.getDtd()||CKEDITOR.dtd.span)[n]||r)&&(!e.parentRule||e.parentRule(t))}function r(e,t,n){return!e||!CKEDITOR.dtd.$removeEmpty[e]||(t.getPosition(n)|F)==F}function i(e,t){var n=e.type;return n==CKEDITOR.NODE_TEXT||t||n==CKEDITOR.NODE_ELEMENT&&!e.getChildCount()}function o(e,t,n,r){return(e.getPosition(t)|r)==r&&(!n.childRule||n.childRule(e))}function s(s){var a=s.document;if(s.collapsed){var c=K(this,a);return s.insertNode(c),void s.moveToPosition(c,CKEDITOR.POSITION_BEFORE_END)}var E,u=this.element,f=this._.definition,T=f.ignoreReadonly,m=T||f.includeReadonly;null==m&&(m=s.root.getCustomData("cke_includeReadonly"));var h=CKEDITOR.dtd[u];h||(E=!0,h=CKEDITOR.dtd.span),s.enlarge(CKEDITOR.ENLARGE_INLINE,1),s.trim();var d,O=s.createBookmark(),g=O.startNode,C=O.endNode,R=g;if(!T){var I=s.getCommonAncestor(),p=e(g,I),y=e(C,I);p&&(R=p.getNextSourceNode(!0)),y&&(C=y)}for(R.getPosition(C)==CKEDITOR.POSITION_FOLLOWING&&(R=0);R;){var D=!1;if(R.equals(C))R=null,D=!0;else{var b=R.type==CKEDITOR.NODE_ELEMENT?R.getName():null,_=b&&"false"==R.getAttribute("contentEditable"),N=b&&R.getAttribute("data-nostyle");if(b&&R.data("cke-bookmark")){R=R.getNextSourceNode(!0);continue}if(_&&m&&CKEDITOR.dtd.$block[b]&&l.call(this,R),t(f,R,C,b,h,N,_,m))if(n(f,R.getParent(),u,E)){if(!d&&r(b,R,C)&&(d=s.clone()).setStartBefore(R),i(R,_)){for(var S,k=R;(D=!k.getNext(x))&&(S=k.getParent(),h[S.getName()])&&o(S,g,f,H);)k=S;d.setEndAfter(k)}}else D=!0;else D=!0;R=R.getNextSourceNode(N||_)}if(D&&d&&!d.collapsed){for(var L,A,B,P=K(this,a),M=P.hasAttributes(),w=d.getCommonAncestor(),Y={styles:{},attrs:{},blockedStyles:{},blockedAttrs:{}};P&&w;){if(w.getName()==u){for(L in f.attributes)!Y.blockedAttrs[L]&&(B=w.getAttribute(A))&&(P.getAttribute(L)==B?Y.attrs[L]=1:Y.blockedAttrs[L]=1);for(A in f.styles)!Y.blockedStyles[A]&&(B=w.getStyle(A))&&(P.getStyle(A)==B?Y.styles[A]=1:Y.blockedStyles[A]=1)}w=w.getParent()}for(L in Y.attrs)P.removeAttribute(L);for(A in Y.styles)P.removeStyle(A);M&&!P.hasAttributes()&&(P=null),P?(d.extractContents().appendTo(P),d.insertNode(P),v.call(this,P),P.mergeSiblings(),CKEDITOR.env.ie||P.$.normalize()):(P=new CKEDITOR.dom.element("span"),d.extractContents().appendTo(P),d.insertNode(P),v.call(this,P),P.remove(!0)),d=null}}s.moveToBookmark(O),s.shrink(CKEDITOR.SHRINK_TEXT),s.shrink(CKEDITOR.NODE_ELEMENT,!0)}function a(e){function t(){for(var e=new CKEDITOR.dom.elementPath(r.getParent()),t=new CKEDITOR.dom.elementPath(f.getParent()),n=null,i=null,o=0;o<e.elements.length;o++){var s=e.elements[o];if(s==e.block||s==e.blockLimit)break;T.checkElementRemovable(s,!0)&&(n=s)}for(o=0;o<t.elements.length&&(s=t.elements[o])!=t.block&&s!=t.blockLimit;o++)T.checkElementRemovable(s,!0)&&(i=s);i&&f.breakParent(i),n&&r.breakParent(n)}e.enlarge(CKEDITOR.ENLARGE_INLINE,1);var n=e.createBookmark(),r=n.startNode,i=this._.definition.alwaysRemoveElement;if(e.collapsed){for(var o,s,a=new CKEDITOR.dom.elementPath(r.getParent(),e.root),l=0;l<a.elements.length&&(s=a.elements[l])&&s!=a.block&&s!=a.blockLimit;l++)if(this.checkElementRemovable(s)){var c;!i&&e.collapsed&&(e.checkBoundaryOfElement(s,CKEDITOR.END)||(c=e.checkBoundaryOfElement(s,CKEDITOR.START)))?(o=s).match=c?"start":"end":(s.mergeSiblings(),s.is(this.element)?p.call(this,s):y(s,S(this)[s.getName()]))}if(o){var E=r;for(l=0;;l++){var u=a.elements[l];if(u.equals(o))break;u.match||((u=u.clone()).append(E),E=u)}E["start"==o.match?"insertBefore":"insertAfter"](o)}}else{var f=n.endNode,T=this;t();for(var m=r;!m.equals(f);){var h=m.getNextSourceNode();m.type==CKEDITOR.NODE_ELEMENT&&this.checkElementRemovable(m)&&(m.getName()==this.element?p.call(this,m):y(m,S(this)[m.getName()]),h.type==CKEDITOR.NODE_ELEMENT&&h.contains(r)&&(t(),h=r.getNext())),m=h}}e.moveToBookmark(n),e.shrink(CKEDITOR.NODE_ELEMENT,!0)}function l(e){for(var t,n=c(e),r=n.length,i=0,o=r&&new CKEDITOR.dom.range(e.getDocument());i<r;++i)E(t=n[i],this)&&(o.selectNodeContents(t),s.call(this,o))}function c(e){var t=[];return e.forEach(function(e){if("true"==e.getAttribute("contenteditable"))return t.push(e),!1},CKEDITOR.NODE_ELEMENT,!0),t}function E(e,t){var n=CKEDITOR.filter.instances[e.data("cke-filter")];return n?n.check(t):1}function u(e,t){return e.activeFilter?e.activeFilter.check(t):1}function f(e){var t=e.getEnclosedNode()||e.getCommonAncestor(!1,!0),n=new CKEDITOR.dom.elementPath(t,e.root).contains(this.element,1);n&&!n.isReadOnly()&&b(n,this)}function T(e){var t=e.getCommonAncestor(!0,!0),n=new CKEDITOR.dom.elementPath(t,e.root).contains(this.element,1);if(n){var r=this._.definition,i=r.attributes;if(i)for(var o in i)n.removeAttribute(o,i[o]);if(r.styles)for(var s in r.styles)r.styles.hasOwnProperty(s)&&n.removeStyle(s)}}function m(e){var t=e.createBookmark(!0),n=e.createIterator();n.enforceRealBlocks=!0,this._.enterMode&&(n.enlargeBr=this._.enterMode!=CKEDITOR.ENTER_BR);for(var r,i=e.document;r=n.getNextParagraph();)!r.isReadOnly()&&u(n,this)&&d(r,K(this,i,r));e.moveToBookmark(t)}function h(e){var t=e.createBookmark(1),n=e.createIterator();n.enforceRealBlocks=!0,n.enlargeBr=this._.enterMode!=CKEDITOR.ENTER_BR;for(var r,i;r=n.getNextParagraph();)this.checkElementRemovable(r)&&(r.is("pre")?((i=this._.enterMode==CKEDITOR.ENTER_BR?null:e.document.createElement(this._.enterMode==CKEDITOR.ENTER_P?"p":"div"))&&r.copyAttributes(i),d(r,i)):p.call(this,r));e.moveToBookmark(t)}function d(e,t){var n=!t;n&&(t=e.getDocument().createElement("div"),e.copyAttributes(t));var r=t&&t.is("pre"),i=e.is("pre"),o=r&&!i,s=!r&&i;o?t=I(e,t):s?t=R(n?[e.getHtml()]:g(e),t):e.moveChildren(t),t.replace(e),r?O(t):n&&D(t)}function O(e){var t;if((t=e.getPrevious(Y))&&t.type==CKEDITOR.NODE_ELEMENT&&t.is("pre")){var n=C(t.getHtml(),/\n$/,"")+"\n\n"+C(e.getHtml(),/^\n/,"");CKEDITOR.env.ie?e.$.outerHTML="<pre>"+n+"</pre>":e.setHtml(n),t.remove()}}function g(e){var t=/(\S\s*)\n(?:\s|(<span[^>]+data-cke-bookmark.*?\/span>))*\n(?!$)/gi,n=[];return C(e.getOuterHtml(),t,function(e,t,n){return t+"</pre>"+n+"<pre>"}).replace(/<pre\b.*?>([\s\S]*?)<\/pre>/gi,function(e,t){n.push(t)}),n}function C(e,t,n){var r="",i="";return e=e.replace(/(^<span[^>]+data-cke-bookmark.*?\/span>)|(<span[^>]+data-cke-bookmark.*?\/span>$)/gi,function(e,t,n){return t&&(r=t),n&&(i=n),""}),r+e.replace(t,n)+i}function R(e,t){var n;e.length>1&&(n=new CKEDITOR.dom.documentFragment(t.getDocument()));for(var r=0;r<e.length;r++){var i=e[r];if(i=i.replace(/(\r\n|\r)/g,"\n"),i=C(i,/^[ \t]*\n/,""),i=C(i,/\n$/,""),i=C(i,/^[ \t]+|[ \t]+$/g,function(e,t){return 1==e.length?"&nbsp;":t?" "+CKEDITOR.tools.repeat("&nbsp;",e.length-1):CKEDITOR.tools.repeat("&nbsp;",e.length-1)+" "}),i=i.replace(/\n/g,"<br>"),i=i.replace(/[ \t]{2,}/g,function(e){return CKEDITOR.tools.repeat("&nbsp;",e.length-1)+" "}),n){var o=t.clone();o.setHtml(i),n.append(o)}else t.setHtml(i)}return n||t}function I(e,t){var n=e.getBogus();n&&n.remove();var r=e.getHtml();if(r=C(r,/(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g,""),r=r.replace(/[ \t\r\n]*(<br[^>]*>)[ \t\r\n]*/gi,"$1"),r=r.replace(/([ \t\n\r]+|&nbsp;)/g," "),r=r.replace(/<br\b[^>]*>/gi,"\n"),CKEDITOR.env.ie){var i=e.getDocument().createElement("div");i.append(t),t.$.outerHTML="<pre>"+r+"</pre>",t.copyAttributes(i.getFirst()),t=i.getFirst().remove()}else t.setHtml(r);return t}function p(e,t){var n=this._.definition,r=n.attributes,i=n.styles,o=S(this)[e.getName()],s=CKEDITOR.tools.isEmpty(r)&&CKEDITOR.tools.isEmpty(i);for(var a in r)("class"!=a&&!this._.definition.fullMatch||e.getAttribute(a)==k(a,r[a]))&&(t&&"data-"==a.slice(0,5)||(s=e.hasAttribute(a),e.removeAttribute(a)));for(var l in i)this._.definition.fullMatch&&e.getStyle(l)!=k(l,i[l],!0)||(s=s||!!e.getStyle(l),e.removeStyle(l));y(e,o,B[e.getName()]),s&&(this._.definition.alwaysRemoveElement?D(e,1):!CKEDITOR.dtd.$block[e.getName()]||this._.enterMode==CKEDITOR.ENTER_BR&&!e.hasAttributes()?D(e):e.renameNode(this._.enterMode==CKEDITOR.ENTER_P?"p":"div"))}function v(e){for(var t,n=S(this),r=e.getElementsByTag(this.element),i=r.count();--i>=0;)(t=r.getItem(i)).isReadOnly()||p.call(this,t,!0);for(var o in n)if(o!=this.element)for(i=(r=e.getElementsByTag(o)).count()-1;i>=0;i--)(t=r.getItem(i)).isReadOnly()||y(t,n[o])}function y(e,t,n){var r=t&&t.attributes;if(r)for(var i=0;i<r.length;i++){var o,s=r[i][0];if(o=e.getAttribute(s)){var a=r[i][1];(null===a||a.test&&a.test(o)||"string"==typeof a&&o==a)&&e.removeAttribute(s)}}n||D(e)}function D(e,t){if(!e.hasAttributes()||t)if(CKEDITOR.dtd.$block[e.getName()]){var n=e.getPrevious(Y),r=e.getNext(Y);!n||n.type!=CKEDITOR.NODE_TEXT&&n.isBlockBoundary({br:1})||e.append("br",1),!r||r.type!=CKEDITOR.NODE_TEXT&&r.isBlockBoundary({br:1})||e.append("br"),e.remove(!0)}else{var i=e.getFirst(),o=e.getLast();e.remove(!0),i&&(i.type==CKEDITOR.NODE_ELEMENT&&i.mergeSiblings(),o&&!i.equals(o)&&o.type==CKEDITOR.NODE_ELEMENT&&o.mergeSiblings())}}function K(e,t,n){var r,i=e.element;return"*"==i&&(i="span"),r=new CKEDITOR.dom.element(i,t),n&&n.copyAttributes(r),r=b(r,e),t.getCustomData("doc_processing_style")&&r.hasAttribute("id")?r.removeAttribute("id"):t.setCustomData("doc_processing_style",1),r}function b(e,t){var n=t._.definition,r=n.attributes,i=CKEDITOR.style.getStyleText(n);if(r)for(var o in r)e.setAttribute(o,r[o]);return i&&e.setAttribute("style",i),e}function _(e,t){for(var n in e)e[n]=e[n].replace(w,function(e,n){return t[n]})}function N(e){var t=e._AC;if(t)return t;t={};var n=0,r=e.attributes;if(r)for(var i in r)n++,t[i]=r[i];var o=CKEDITOR.style.getStyleText(e);return o&&(t.style||n++,t.style=o),t._length=n,e._AC=t}function S(e){if(e._.overrides)return e._.overrides;var t=e._.overrides={},n=e._.definition.overrides;if(n){CKEDITOR.tools.isArray(n)||(n=[n]);for(var r=0;r<n.length;r++){var i,o,s,a=n[r];if("string"==typeof a?i=a.toLowerCase():(i=a.element?a.element.toLowerCase():e.element,s=a.attributes),o=t[i]||(t[i]={}),s){var l=o.attributes=o.attributes||[];for(var c in s)l.push([c.toLowerCase(),s[c]])}}}return t}function k(e,t,n){var r=new CKEDITOR.dom.element("span");return r[n?"setStyle":"setAttribute"](e,t),r[n?"getStyle":"getAttribute"](e)}function L(e,t){function n(e,t){return"font-family"==t.toLowerCase()?e.replace(/["']/g,""):e}"string"==typeof e&&(e=CKEDITOR.tools.parseCssText(e)),"string"==typeof t&&(t=CKEDITOR.tools.parseCssText(t,!0));for(var r in e){if(!(r in t))return!1;if(n(t[r],r)!=n(e[r],r)&&"inherit"!=e[r]&&"inherit"!=t[r])return!1}return!0}function A(e,t,n){var r,i,o,s=e.document,a=e.getRanges(),l=t?this.removeFromRange:this.applyToRange;if(e.isFake&&e.isInTable())for(r=[],o=0;o<a.length;o++)r.push(a[o].clone());for(var c=a.createIterator();i=c.getNextRange();)l.call(this,i,n);e.selectRanges(r||a),s.removeCustomData("doc_processing_style")}var B={address:1,div:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,p:1,pre:1,section:1,header:1,footer:1,nav:1,article:1,aside:1,figure:1,dialog:1,hgroup:1,time:1,meter:1,menu:1,command:1,keygen:1,output:1,progress:1,details:1,datagrid:1,datalist:1},P={a:1,blockquote:1,embed:1,hr:1,img:1,li:1,object:1,ol:1,table:1,td:1,tr:1,th:1,ul:1,dl:1,dt:1,dd:1,form:1,audio:1,video:1},M=/\s*(?:;\s*|$)/,w=/#\((.+?)\)/g,x=CKEDITOR.dom.walker.bookmark(0,1),Y=CKEDITOR.dom.walker.whitespaces(1);CKEDITOR.style=function(e,t){if("string"==typeof e.type)return new CKEDITOR.style.customHandlers[e.type](e);var n=e.attributes;n&&n.style&&(e.styles=CKEDITOR.tools.extend({},e.styles,CKEDITOR.tools.parseCssText(n.style)),delete n.style),t&&(_((e=CKEDITOR.tools.clone(e)).attributes,t),_(e.styles,t));var r=this.element=e.element?"string"==typeof e.element?e.element.toLowerCase():e.element:"*";this.type=e.type||(B[r]?CKEDITOR.STYLE_BLOCK:P[r]?CKEDITOR.STYLE_OBJECT:CKEDITOR.STYLE_INLINE),"object"==typeof this.element&&(this.type=CKEDITOR.STYLE_OBJECT),this._={definition:e}},CKEDITOR.style.prototype={apply:function(e){if(e instanceof CKEDITOR.dom.document)return A.call(this,e.getSelection());if(this.checkApplicable(e.elementPath(),e)){var t=this._.enterMode;t||(this._.enterMode=e.activeEnterMode),A.call(this,e.getSelection(),0,e),this._.enterMode=t}},remove:function(e){if(e instanceof CKEDITOR.dom.document)return A.call(this,e.getSelection(),1);if(this.checkApplicable(e.elementPath(),e)){var t=this._.enterMode;t||(this._.enterMode=e.activeEnterMode),A.call(this,e.getSelection(),1,e),this._.enterMode=t}},applyToRange:function(e){return this.applyToRange=this.type==CKEDITOR.STYLE_INLINE?s:this.type==CKEDITOR.STYLE_BLOCK?m:this.type==CKEDITOR.STYLE_OBJECT?f:null,this.applyToRange(e)},removeFromRange:function(e){return this.removeFromRange=this.type==CKEDITOR.STYLE_INLINE?a:this.type==CKEDITOR.STYLE_BLOCK?h:this.type==CKEDITOR.STYLE_OBJECT?T:null,this.removeFromRange(e)},applyToObject:function(e){b(e,this)},checkActive:function(e,t){switch(this.type){case CKEDITOR.STYLE_BLOCK:return this.checkElementRemovable(e.block||e.blockLimit,!0,t);case CKEDITOR.STYLE_OBJECT:case CKEDITOR.STYLE_INLINE:for(var n,r=e.elements,i=0;i<r.length;i++)if(n=r[i],this.type!=CKEDITOR.STYLE_INLINE||n!=e.block&&n!=e.blockLimit){if(this.type==CKEDITOR.STYLE_OBJECT){var o=n.getName();if(!("string"==typeof this.element?o==this.element:o in this.element))continue}if(this.checkElementRemovable(n,!0,t))return!0}}return!1},checkApplicable:function(e,t,n){if(t&&t instanceof CKEDITOR.filter&&(n=t),n&&!n.check(this))return!1;switch(this.type){case CKEDITOR.STYLE_OBJECT:return!!e.contains(this.element);case CKEDITOR.STYLE_BLOCK:return!!e.blockLimit.getDtd()[this.element]}return!0},checkElementMatch:function(e,t){var n=this._.definition;if(!e||!n.ignoreReadonly&&e.isReadOnly())return!1;var r,i=e.getName();if("string"==typeof this.element?i==this.element:i in this.element){if(!t&&!e.hasAttributes())return!0;if(!(r=N(n))._length)return!0;for(var o in r)if("_length"!=o){var s=e.getAttribute(o)||"";if("style"==o?L(r[o],s):r[o]==s){if(!t)return!0}else if(t)return!1}if(t)return!0}return!1},checkElementRemovable:function(e,t,n){if(this.checkElementMatch(e,t,n))return!0;var r=S(this)[e.getName()];if(r){var i,o;if(!(i=r.attributes))return!0;for(var s=0;s<i.length;s++){o=i[s][0];var a=e.getAttribute(o);if(a){var l=i[s][1];if(null===l)return!0;if("string"==typeof l){if(a==l)return!0}else if(l.test(a))return!0}}}return!1},buildPreview:function(e){var t=this._.definition,n=[],r=t.element;"bdo"==r&&(r="span"),n=["<",r];var i=t.attributes;if(i)for(var o in i)n.push(" ",o,'="',i[o],'"');var s=CKEDITOR.style.getStyleText(t);return s&&n.push(' style="',s,'"'),n.push(">",e||t.name,"</",r,">"),n.join("")},getDefinition:function(){return this._.definition}},CKEDITOR.style.getStyleText=function(e){var t=e._ST;if(t)return t;t=e.styles;var n=e.attributes&&e.attributes.style||"",r="";n.length&&(n=n.replace(M,";"));for(var i in t){var o=t[i],s=(i+":"+o).replace(M,";");"inherit"==o?r+=s:n+=s}return n.length&&(n=CKEDITOR.tools.normalizeCssText(n,!0)),n+=r,e._ST=n},CKEDITOR.style.customHandlers={},CKEDITOR.style.addCustomHandler=function(e){var t=function(e){this._={definition:e},this.setup&&this.setup(e)};return t.prototype=CKEDITOR.tools.extend(CKEDITOR.tools.prototypedCopy(CKEDITOR.style.prototype),{assignedTo:CKEDITOR.STYLE_OBJECT},e,!0),this.customHandlers[e.type]=t,t};var F=CKEDITOR.POSITION_PRECEDING|CKEDITOR.POSITION_IDENTICAL|CKEDITOR.POSITION_IS_CONTAINED,H=CKEDITOR.POSITION_FOLLOWING|CKEDITOR.POSITION_IDENTICAL|CKEDITOR.POSITION_IS_CONTAINED}(),CKEDITOR.styleCommand=function(e,t){this.style=e,this.allowedContent=e,this.requiredContent=e,CKEDITOR.tools.extend(this,t,!0)},CKEDITOR.styleCommand.prototype.exec=function(e){e.focus(),this.state==CKEDITOR.TRISTATE_OFF?e.applyStyle(this.style):this.state==CKEDITOR.TRISTATE_ON&&e.removeStyle(this.style)},CKEDITOR.stylesSet=new CKEDITOR.resourceManager("","stylesSet"),CKEDITOR.addStylesSet=CKEDITOR.tools.bind(CKEDITOR.stylesSet.add,CKEDITOR.stylesSet),CKEDITOR.loadStylesSet=function(e,t,n){CKEDITOR.stylesSet.addExternal(e,t,""),CKEDITOR.stylesSet.load(e,n)},CKEDITOR.tools.extend(CKEDITOR.editor.prototype,{attachStyleStateChange:function(e,t){var n=this._.styleStateChangeCallbacks;n||(n=this._.styleStateChangeCallbacks=[],this.on("selectionChange",function(e){for(var t=0;t<n.length;t++){var r=n[t],i=r.style.checkActive(e.data.path,this)?CKEDITOR.TRISTATE_ON:CKEDITOR.TRISTATE_OFF;r.fn.call(this,i)}})),n.push({style:e,fn:t})},applyStyle:function(e){e.apply(this)},removeStyle:function(e){e.remove(this)},getStylesSet:function(e){if(this._.stylesDefinitions)e(this._.stylesDefinitions);else{var t=this,n=t.config.stylesCombo_stylesSet||t.config.stylesSet;if(!1===n)return void e(null);if(n instanceof Array)return t._.stylesDefinitions=n,void e(n);n||(n="default");var r=n.split(":"),i=r[0],o=r[1];CKEDITOR.stylesSet.addExternal(i,o?r.slice(1).join(":"):CKEDITOR.getUrl("styles.js"),""),CKEDITOR.stylesSet.load(i,function(n){t._.stylesDefinitions=n[i],e(t._.stylesDefinitions)})}}});