"use strict";CKEDITOR.htmlParser.node=function(){},CKEDITOR.htmlParser.node.prototype={remove:function(){var t=this.parent.children,e=CKEDITOR.tools.indexOf(t,this),n=this.previous,i=this.next;n&&(n.next=i),i&&(i.previous=n),t.splice(e,1),this.parent=null},replaceWith:function(t){var e=this.parent.children,n=CKEDITOR.tools.indexOf(e,this),i=t.previous=this.previous,r=t.next=this.next;i&&(i.next=t),r&&(r.previous=t),e[n]=t,t.parent=this.parent,this.parent=null},insertAfter:function(t){var e=t.parent.children,n=CKEDITOR.tools.indexOf(e,t),i=t.next;e.splice(n+1,0,this),this.next=t.next,this.previous=t,t.next=this,i&&(i.previous=this),this.parent=t.parent},insertBefore:function(t){var e=t.parent.children,n=CKEDITOR.tools.indexOf(e,t);e.splice(n,0,this),this.next=t,this.previous=t.previous,t.previous&&(t.previous.next=this),t.previous=this,this.parent=t.parent},getAscendant:function(t){for(var e="function"==typeof t?t:"string"==typeof t?function(e){return e.name==t}:function(e){return e.name in t},n=this.parent;n&&n.type==CKEDITOR.NODE_ELEMENT;){if(e(n))return n;n=n.parent}return null},wrapWith:function(t){return this.replaceWith(t),t.add(this),t},getIndex:function(){return CKEDITOR.tools.indexOf(this.parent.children,this)},getFilterContext:function(t){return t||{}}};