CKEDITOR.dom.text=function(t,e){"string"==typeof t&&(t=(e?e.$:document).createTextNode(t)),this.$=t},CKEDITOR.dom.text.prototype=new CKEDITOR.dom.node,CKEDITOR.tools.extend(CKEDITOR.dom.text.prototype,{type:CKEDITOR.NODE_TEXT,getLength:function(){return this.$.nodeValue.length},getText:function(){return this.$.nodeValue},setText:function(t){this.$.nodeValue=t},split:function(t){var e=this.$.parentNode,n=e.childNodes.length,o=this.getLength(),i=this.getDocument(),s=new CKEDITOR.dom.text(this.$.splitText(t),i);if(e.childNodes.length==n)if(t>=o)(s=i.createText("")).insertAfter(this);else{var r=i.createText("");r.insertAfter(s),r.remove()}return s},substring:function(t,e){return"number"!=typeof e?this.$.nodeValue.substr(t):this.$.nodeValue.substring(t,e)}});