"use strict";!function(){function t(t){for(var e=t.getChildren(),n=0,i=e.count();n<i;n++){var o=e.getItem(n);if(o.type==CKEDITOR.NODE_ELEMENT&&CKEDITOR.dtd.$block[o.getName()])return!0}return!1}var e,n={},i={};for(e in CKEDITOR.dtd.$blockLimit)e in CKEDITOR.dtd.$list||(n[e]=1);for(e in CKEDITOR.dtd.$block)e in CKEDITOR.dtd.$blockLimit||e in CKEDITOR.dtd.$empty||(i[e]=1);CKEDITOR.dom.elementPath=function(e,o){var r,l=null,s=null,c=[],u=e;o=o||e.getDocument().getBody(),u||(u=o);do{if(u.type==CKEDITOR.NODE_ELEMENT){if(c.push(u),!this.lastElement&&(this.lastElement=u,u.is(CKEDITOR.dtd.$object)||"false"==u.getAttribute("contenteditable")))continue;if(u.equals(o))break;s||(r=u.getName(),"true"==u.getAttribute("contenteditable")?s=u:!l&&i[r]&&(l=u),n[r]&&(l||"div"!=r||t(u)?s=u:l=u))}}while(u=u.getParent());s||(s=o),this.block=l,this.blockLimit=s,this.root=o,this.elements=c}}(),CKEDITOR.dom.elementPath.prototype={compare:function(t){var e=this.elements,n=t&&t.elements;if(!n||e.length!=n.length)return!1;for(var i=0;i<e.length;i++)if(!e[i].equals(n[i]))return!1;return!0},contains:function(t,e,n){var i;"string"==typeof t&&(i=function(e){return e.getName()==t}),t instanceof CKEDITOR.dom.element?i=function(e){return e.equals(t)}:CKEDITOR.tools.isArray(t)?i=function(e){return CKEDITOR.tools.indexOf(t,e.getName())>-1}:"function"==typeof t?i=t:"object"==typeof t&&(i=function(e){return e.getName()in t});var o=this.elements,r=o.length;e&&r--,n&&(o=Array.prototype.slice.call(o,0)).reverse();for(var l=0;l<r;l++)if(i(o[l]))return o[l];return null},isContextFor:function(t){return!(t in CKEDITOR.dtd.$block&&!(this.contains(CKEDITOR.dtd.$intermediate)||this.root.equals(this.block)&&this.block||this.blockLimit).getDtd()[t])},direction:function(){return(this.block||this.blockLimit||this.root).getDirection(1)}};