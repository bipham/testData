"use strict";CKEDITOR.htmlParser.cdata=function(t){this.value=t},CKEDITOR.htmlParser.cdata.prototype=CKEDITOR.tools.extend(new CKEDITOR.htmlParser.node,{type:CKEDITOR.NODE_TEXT,filter:function(){},writeHtml:function(t){t.write(this.value)}});