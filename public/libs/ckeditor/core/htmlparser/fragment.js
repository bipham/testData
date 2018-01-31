"use strict";CKEDITOR.htmlParser.fragment=function(){this.children=[],this.parent=null,this._={isBlockLike:!0,hasInlineStarted:!1}},function(){function t(t){return!t.attributes["data-cke-survive"]&&("a"==t.name&&t.attributes.href||CKEDITOR.dtd.$removeEmpty[t.name])}var e=CKEDITOR.tools.extend({table:1,ul:1,ol:1,dl:1},CKEDITOR.dtd.table,CKEDITOR.dtd.ul,CKEDITOR.dtd.ol,CKEDITOR.dtd.dl),n={ol:1,ul:1},i=CKEDITOR.tools.extend({},{html:1},CKEDITOR.dtd.html,CKEDITOR.dtd.body,CKEDITOR.dtd.head,{style:1,script:1}),r={ul:"li",ol:"li",dl:"dd",table:"tbody",tbody:"tr",thead:"tr",tfoot:"tr",tr:"td"};CKEDITOR.htmlParser.fragment.fromHtml=function(l,a,d){function o(t){var e;if(u.length>0)for(var n=0;n<u.length;n++){var i=u[n],r=i.name,l=CKEDITOR.dtd[r],a=c.name&&CKEDITOR.dtd[c.name];a&&!a[r]||t&&l&&!l[t]&&CKEDITOR.dtd[t]?r==c.name&&(f(c,c.parent,1),n--):(e||(s(),e=1),(i=i.clone()).parent=c,c=i,u.splice(n,1),n--)}}function s(){for(;m.length;)f(m.shift(),c)}function h(t){if(t._.isBlockLike&&"pre"!=t.name&&"textarea"!=t.name){var e,n=t.children.length,i=t.children[n-1];i&&i.type==CKEDITOR.NODE_TEXT&&((e=CKEDITOR.tools.rtrim(i.value))?i.value=e:t.children.length=n-1)}}function f(e,n,i){n=n||c||O;var r=c;void 0===e.previous&&(E(n,e)&&(c=n,C.onTagOpen(d,{}),e.returnPoint=n=c),h(e),t(e)&&!e.children.length||n.add(e),"pre"==e.name&&(D=!1),"textarea"==e.name&&(p=!1)),e.returnPoint?(c=e.returnPoint,delete e.returnPoint):c=i?n:r}function E(t,e){if((t==O||"body"==t.name)&&d&&(!t.name||CKEDITOR.dtd[t.name][d])){var n,i;return(n=e.attributes&&(i=e.attributes["data-cke-real-element-type"])?i:e.name)&&n in CKEDITOR.dtd.$inline&&!(n in CKEDITOR.dtd.head)&&!e.isOrphan||e.type==CKEDITOR.NODE_TEXT}}function T(t,e){return(t in CKEDITOR.dtd.$listItem||t in CKEDITOR.dtd.$tableContent)&&(t==e||"dt"==t&&"dd"==e||"dd"==t&&"dt"==e)}var C=new CKEDITOR.htmlParser,O=a instanceof CKEDITOR.htmlParser.element?a:"string"==typeof a?new CKEDITOR.htmlParser.element(a):new CKEDITOR.htmlParser.fragment,u=[],m=[],c=O,p="textarea"==O.name,D="pre"==O.name;for(C.onTagOpen=function(r,l,a,d){var h=new CKEDITOR.htmlParser.element(r,l);if(h.isUnknown&&a&&(h.isEmpty=!0),h.isOptionalClose=d,t(h))u.push(h);else{if("pre"==r)D=!0;else{if("br"==r&&D)return void c.add(new CKEDITOR.htmlParser.text("\n"));"textarea"==r&&(p=!0)}if("br"!=r){for(;;){var E=c.name,O=E?CKEDITOR.dtd[E]||(c._.isBlockLike?CKEDITOR.dtd.div:CKEDITOR.dtd.span):i;if(h.isUnknown||c.isUnknown||O[r])break;if(c.isOptionalClose)C.onTagClose(E);else if(r in n&&E in n){var I=c.children,R=I[I.length-1];R&&"li"==R.name||f(R=new CKEDITOR.htmlParser.element("li"),c),!h.returnPoint&&(h.returnPoint=c),c=R}else if(r in CKEDITOR.dtd.$listItem&&!T(r,E))C.onTagOpen("li"==r?"ul":"dl",{},0,1);else if(E in e&&!T(r,E))!h.returnPoint&&(h.returnPoint=c),c=c.parent;else{if(E in CKEDITOR.dtd.$inline&&u.unshift(c),!c.parent){h.isOrphan=1;break}f(c,c.parent,1)}}o(r),s(),h.parent=c,h.isEmpty?f(h):c=h}else m.push(h)}},C.onTagClose=function(t){for(var e=u.length-1;e>=0;e--)if(t==u[e].name)return void u.splice(e,1);for(var n=[],i=[],r=c;r!=O&&r.name!=t;)r._.isBlockLike||i.unshift(r),n.push(r),r=r.returnPoint||r.parent;if(r!=O){for(e=0;e<n.length;e++){var l=n[e];f(l,l.parent)}c=r,r._.isBlockLike&&s(),f(r,r.parent),r==c&&(c=c.parent),u=u.concat(i)}"body"==t&&(d=!1)},C.onText=function(t){if(c._.hasInlineStarted&&!m.length||D||p||0!==(t=CKEDITOR.tools.ltrim(t)).length){var n=c.name,l=n?CKEDITOR.dtd[n]||(c._.isBlockLike?CKEDITOR.dtd.div:CKEDITOR.dtd.span):i;if(!p&&!l["#"]&&n in e)return C.onTagOpen(r[n]||""),void C.onText(t);s(),o(),D||p||(t=t.replace(/[\t\r\n ]{2,}|[\t\r\n]/g," ")),t=new CKEDITOR.htmlParser.text(t),E(c,t)&&this.onTagOpen(d,{},0,1),c.add(t)}},C.onCDATA=function(t){c.add(new CKEDITOR.htmlParser.cdata(t))},C.onComment=function(t){s(),o(),c.add(new CKEDITOR.htmlParser.comment(t))},C.parse(l),s();c!=O;)f(c,c.parent,1);return h(O),O},CKEDITOR.htmlParser.fragment.prototype={type:CKEDITOR.NODE_DOCUMENT_FRAGMENT,add:function(t,e){isNaN(e)&&(e=this.children.length);var n=e>0?this.children[e-1]:null;if(n){if(t._.isBlockLike&&n.type==CKEDITOR.NODE_TEXT&&(n.value=CKEDITOR.tools.rtrim(n.value),0===n.value.length))return this.children.pop(),void this.add(t);n.next=t}t.previous=n,t.parent=this,this.children.splice(e,0,t),this._.hasInlineStarted||(this._.hasInlineStarted=t.type==CKEDITOR.NODE_TEXT||t.type==CKEDITOR.NODE_ELEMENT&&!t._.isBlockLike)},filter:function(t,e){e=this.getFilterContext(e),t.onRoot(e,this),this.filterChildren(t,!1,e)},filterChildren:function(t,e,n){if(this.childrenFilteredBy!=t.id){n=this.getFilterContext(n),e&&!this.parent&&t.onRoot(n,this),this.childrenFilteredBy=t.id;for(var i=0;i<this.children.length;i++)!1===this.children[i].filter(t,n)&&i--}},writeHtml:function(t,e){e&&this.filter(e),this.writeChildrenHtml(t)},writeChildrenHtml:function(t,e,n){var i=this.getFilterContext();n&&!this.parent&&e&&e.onRoot(i,this),e&&this.filterChildren(e,!1,i);for(var r=0,l=this.children,a=l.length;r<a;r++)l[r].writeHtml(t)},forEach:function(t,e,n){if(!(n||e&&this.type!=e))var i=t(this);if(!1!==i)for(var r,l=this.children,a=0;a<l.length;a++)(r=l[a]).type==CKEDITOR.NODE_ELEMENT?r.forEach(t,e):e&&r.type!=e||t(r)},getFilterContext:function(t){return t||{}}}}();