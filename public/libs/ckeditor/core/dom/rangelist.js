!function(){function t(t,e,r){var o=t.serializable,n=e[r?"endContainer":"startContainer"],a=r?"endOffset":"startOffset",s=o?e.document.getById(t.startNode):t.startNode,i=o?e.document.getById(t.endNode):t.endNode;return n.equals(s.getPrevious())?(e.startOffset=e.startOffset-n.getLength()-i.getPrevious().getLength(),n=i.getNext()):n.equals(i.getPrevious())&&(e.startOffset=e.startOffset-n.getLength(),n=i.getNext()),n.equals(s.getParent())&&e[a]++,n.equals(i.getParent())&&e[a]++,e[r?"endContainer":"startContainer"]=n,e}CKEDITOR.dom.rangeList=function(t){return t instanceof CKEDITOR.dom.rangeList?t:(t?t instanceof CKEDITOR.dom.range&&(t=[t]):t=[],CKEDITOR.tools.extend(t,e))};var e={createIterator:function(){var t,e=this,r=CKEDITOR.dom.walker.bookmark(),o=[];return{getNextRange:function(n){var a=e[t=void 0===t?0:t+1];if(a&&e.length>1){if(!t)for(var s=e.length-1;s>=0;s--)o.unshift(e[s].createBookmark(!0));if(n)for(var i=0;e[t+i+1];){for(var f,u=a.document,d=0,g=u.getById(o[i].endNode),h=u.getById(o[i+1].startNode);;){if(f=g.getNextSourceNode(!1),h.equals(f))d=1;else if(r(f)||f.type==CKEDITOR.NODE_ELEMENT&&f.isBlockBoundary()){g=f;continue}break}if(!d)break;i++}for(a.moveToBookmark(o.shift());i--;)(f=e[++t]).moveToBookmark(o.shift()),a.setEnd(f.endContainer,f.endOffset)}return a}}},createBookmarks:function(e){for(var r,o=[],n=0;n<this.length;n++){o.push(r=this[n].createBookmark(e,!0));for(var a=n+1;a<this.length;a++)this[a]=t(r,this[a]),this[a]=t(r,this[a],!0)}return o},createBookmarks2:function(t){for(var e=[],r=0;r<this.length;r++)e.push(this[r].createBookmark2(t));return e},moveToBookmarks:function(t){for(var e=0;e<this.length;e++)this[e].moveToBookmark(t[e])}}}();