CKEDITOR.dom.window=function(e){CKEDITOR.dom.domObject.call(this,e)},CKEDITOR.dom.window.prototype=new CKEDITOR.dom.domObject,CKEDITOR.tools.extend(CKEDITOR.dom.window.prototype,{focus:function(){this.$.focus()},getViewPaneSize:function(){var e=this.$.document,t="CSS1Compat"==e.compatMode;return{width:(t?e.documentElement.clientWidth:e.body.clientWidth)||0,height:(t?e.documentElement.clientHeight:e.body.clientHeight)||0}},getScrollPosition:function(){var e=this.$;if("pageXOffset"in e)return{x:e.pageXOffset||0,y:e.pageYOffset||0};var t=e.document;return{x:t.documentElement.scrollLeft||t.body.scrollLeft||0,y:t.documentElement.scrollTop||t.body.scrollTop||0}},getFrame:function(){var e=this.$.frameElement;return e?new CKEDITOR.dom.element.get(e):null}});