CKEDITOR.dialog.add("textfield",function(e){function t(e){var t=e.element,i=this.getValue();i?t.setAttribute(this.id,i):t.removeAttribute(this.id)}function i(e){var t=e.hasAttribute(this.id)&&e.getAttribute(this.id);this.setValue(t||"")}var l={email:1,password:1,search:1,tel:1,text:1,url:1};return{title:e.lang.forms.textfield.title,minWidth:350,minHeight:150,onShow:function(){delete this.textField;var e=this.getParentEditor().getSelection().getSelectedElement();!e||"input"!=e.getName()||!l[e.getAttribute("type")]&&e.getAttribute("type")||(this.textField=e,this.setupContent(e))},onOk:function(){var e=this.getParentEditor(),t=this.textField,i=!t;i&&(t=e.document.createElement("input")).setAttribute("type","text");var l={element:t};i&&e.insertElement(l.element),this.commitContent(l),i||e.getSelection().selectElement(l.element)},onLoad:function(){this.foreach(function(e){e.getValue&&(e.setup||(e.setup=i),e.commit||(e.commit=t))})},contents:[{id:"info",label:e.lang.forms.textfield.title,title:e.lang.forms.textfield.title,elements:[{type:"hbox",widths:["50%","50%"],children:[{id:"_cke_saved_name",type:"text",label:e.lang.forms.textfield.name,default:"",accessKey:"N",setup:function(e){this.setValue(e.data("cke-saved-name")||e.getAttribute("name")||"")},commit:function(e){var t=e.element;this.getValue()?t.data("cke-saved-name",this.getValue()):(t.data("cke-saved-name",!1),t.removeAttribute("name"))}},{id:"value",type:"text",label:e.lang.forms.textfield.value,default:"",accessKey:"V",commit:function(i){if(CKEDITOR.env.ie&&!this.getValue()){var l=i.element,a=new CKEDITOR.dom.element("input",e.document);l.copyAttributes(a,{value:1}),a.replace(l),i.element=a}else t.call(this,i)}}]},{type:"hbox",widths:["50%","50%"],children:[{id:"size",type:"text",label:e.lang.forms.textfield.charWidth,default:"",accessKey:"C",style:"width:50px",validate:CKEDITOR.dialog.validate.integer(e.lang.common.validateNumberFailed)},{id:"maxLength",type:"text",label:e.lang.forms.textfield.maxChars,default:"",accessKey:"M",style:"width:50px",validate:CKEDITOR.dialog.validate.integer(e.lang.common.validateNumberFailed)}],onLoad:function(){CKEDITOR.env.ie7Compat&&this.getElement().setStyle("zoom","100%")}},{id:"type",type:"select",label:e.lang.forms.textfield.type,default:"text",accessKey:"M",items:[[e.lang.forms.textfield.typeEmail,"email"],[e.lang.forms.textfield.typePass,"password"],[e.lang.forms.textfield.typeSearch,"search"],[e.lang.forms.textfield.typeTel,"tel"],[e.lang.forms.textfield.typeText,"text"],[e.lang.forms.textfield.typeUrl,"url"]],setup:function(e){this.setValue(e.getAttribute("type"))},commit:function(t){var i=t.element;if(CKEDITOR.env.ie){var l=i.getAttribute("type"),a=this.getValue();if(l!=a){var n=CKEDITOR.dom.element.createFromHtml('<input type="'+a+'"></input>',e.document);i.copyAttributes(n,{type:1}),n.replace(i),t.element=n}}else i.setAttribute("type",this.getValue())}},{id:"required",type:"checkbox",label:e.lang.forms.textfield.required,default:"",accessKey:"Q",value:"required",setup:function(e){this.setValue(e.getAttribute("required"))},commit:function(e){var t=e.element;this.getValue()?t.setAttribute("required","required"):t.removeAttribute("required")}}]}]}});