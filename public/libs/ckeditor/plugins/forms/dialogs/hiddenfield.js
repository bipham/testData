CKEDITOR.dialog.add("hiddenfield",function(e){return{title:e.lang.forms.hidden.title,hiddenField:null,minWidth:350,minHeight:110,onShow:function(){delete this.hiddenField;var e=this.getParentEditor(),t=e.getSelection(),i=t.getSelectedElement();i&&i.data("cke-real-element-type")&&"hiddenfield"==i.data("cke-real-element-type")&&(this.hiddenField=i,i=e.restoreRealElement(this.hiddenField),this.setupContent(i),t.selectElement(this.hiddenField))},onOk:function(){var e=this.getValueOf("info","_cke_saved_name"),t=this.getParentEditor(),i=CKEDITOR.env.ie&&CKEDITOR.document.$.documentMode<8?t.document.createElement('<input name="'+CKEDITOR.tools.htmlEncode(e)+'">'):t.document.createElement("input");i.setAttribute("type","hidden"),this.commitContent(i);var n=t.createFakeElement(i,"cke_hidden","hiddenfield");return this.hiddenField?(n.replace(this.hiddenField),t.getSelection().selectElement(n)):t.insertElement(n),!0},contents:[{id:"info",label:e.lang.forms.hidden.title,title:e.lang.forms.hidden.title,elements:[{id:"_cke_saved_name",type:"text",label:e.lang.forms.hidden.name,default:"",accessKey:"N",setup:function(e){this.setValue(e.data("cke-saved-name")||e.getAttribute("name")||"")},commit:function(e){this.getValue()?e.setAttribute("name",this.getValue()):e.removeAttribute("name")}},{id:"value",type:"text",label:e.lang.forms.hidden.value,default:"",accessKey:"V",setup:function(e){this.setValue(e.getAttribute("value")||"")},commit:function(e){this.getValue()?e.setAttribute("value",this.getValue()):e.removeAttribute("value")}}]}]}});