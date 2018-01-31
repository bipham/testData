"use strict";CKEDITOR.dialog.add("link",function(e){function t(e,t){var i=e.createRange();return i.setStartBefore(t),i.setEndAfter(t),i}function i(e,t){var i,l,a,s,d,r=o.getLinkAttributes(e,t),h=e.getSelection().getRanges(),u=new CKEDITOR.style({element:"a",attributes:r.set}),c=[];for(u.type=CKEDITOR.STYLE_INLINE,s=0;s<h.length;s++){for((i=h[s]).collapsed?(l=new CKEDITOR.dom.text(t.linkText||("email"==t.type?t.email.address:r.set["data-cke-saved-href"]),e.document),i.insertNode(l),i.selectNodeContents(l)):n!==t.linkText&&(l=new CKEDITOR.dom.text(t.linkText,e.document),i.shrink(CKEDITOR.SHRINK_TEXT),e.editable().extractHtmlFromRange(i),i.insertNode(l)),a=i._find("a"),d=0;d<a.length;d++)a[d].remove(!0);u.applyToRange(i,e),c.push(i)}e.getSelection().selectRanges(c)}function l(e,i,l){var a,s,d,r,h,u=o.getLinkAttributes(e,l),c=[];for(h=0;h<i.length;h++)s=(a=i[h]).data("cke-saved-href"),d=a.getHtml(),a.setAttributes(u.set),a.removeAttributes(u.removed),l.linkText&&n!=l.linkText?r=l.linkText:(s==d||"email"==l.type&&-1!=d.indexOf("@"))&&(r="email"==l.type?l.email.address:u.set["data-cke-saved-href"]),r&&a.setText(r),c.push(t(e,a));e.getSelection().selectRanges(c)}var n,a,o=CKEDITOR.plugins.link,s=function(){var t=this.getDialog(),i=t.getContentElement("target","popupFeatures"),l=t.getContentElement("target","linkTargetName"),n=this.getValue();if(i&&l)switch((i=i.getElement()).hide(),l.setValue(""),n){case"frame":l.setLabel(e.lang.link.targetFrameName),l.getElement().show();break;case"popup":i.show(),l.setLabel(e.lang.link.targetPopupName),l.getElement().show();break;default:l.setValue(n),l.getElement().hide()}},d=function(e,t){t[e]&&this.setValue(t[e][this.id]||"")},r=function(e){return d.call(this,"target",e)},h=function(e){return d.call(this,"advanced",e)},u=function(e,t){t[e]||(t[e]={}),t[e][this.id]=this.getValue()||""},c=function(e){return u.call(this,"target",e)},p=function(e){return u.call(this,"advanced",e)},m=e.lang.common,g=e.lang.link;return{title:g.title,minWidth:"moono-lisa"==(CKEDITOR.skinName||e.config.skin)?450:350,minHeight:240,contents:[{id:"info",label:g.info,title:g.info,elements:[{type:"text",id:"linkDisplayText",label:g.displayText,setup:function(){this.enable(),this.setValue(e.getSelection().getSelectedText()),n=this.getValue()},commit:function(e){e.linkText=this.isEnabled()?this.getValue():""}},{id:"linkType",type:"select",label:g.type,default:"url",items:[[g.toUrl,"url"],[g.toAnchor,"anchor"],[g.toEmail,"email"]],onChange:function(){var t=this.getDialog(),i=["urlOptions","anchorOptions","emailOptions"],l=this.getValue(),n=t.definition.getContents("upload"),a=n&&n.hidden;"url"==l?(e.config.linkShowTargetTab&&t.showPage("target"),a||t.showPage("upload")):(t.hidePage("target"),a||t.hidePage("upload"));for(var o=0;o<i.length;o++){var s=t.getContentElement("info",i[o]);s&&(s=s.getElement().getParent().getParent(),i[o]==l+"Options"?s.show():s.hide())}t.layout()},setup:function(e){this.setValue(e.type||"url")},commit:function(e){e.type=this.getValue()}},{type:"vbox",id:"urlOptions",children:[{type:"hbox",widths:["25%","75%"],children:[{id:"protocol",type:"select",label:m.protocol,default:"http://",items:[["http://‎","http://"],["https://‎","https://"],["ftp://‎","ftp://"],["news://‎","news://"],[g.other,""]],setup:function(e){e.url&&this.setValue(e.url.protocol||"")},commit:function(e){e.url||(e.url={}),e.url.protocol=this.getValue()}},{type:"text",id:"url",label:m.url,required:!0,onLoad:function(){this.allowOnChange=!0},onKeyUp:function(){this.allowOnChange=!1;var e=this.getDialog().getContentElement("info","protocol"),t=this.getValue(),i=/^((javascript:)|[#\/\.\?])/i,l=/^(http|https|ftp|news):\/\/(?=.)/i.exec(t);l?(this.setValue(t.substr(l[0].length)),e.setValue(l[0].toLowerCase())):i.test(t)&&e.setValue(""),this.allowOnChange=!0},onChange:function(){this.allowOnChange&&this.onKeyUp()},validate:function(){var t=this.getDialog();return!(!t.getContentElement("info","linkType")||"url"==t.getValueOf("info","linkType"))||(!e.config.linkJavaScriptLinksAllowed&&/javascript\:/.test(this.getValue())?(alert(m.invalidValue),!1):!!this.getDialog().fakeObj||CKEDITOR.dialog.validate.notEmpty(g.noUrl).apply(this))},setup:function(e){this.allowOnChange=!1,e.url&&this.setValue(e.url.url),this.allowOnChange=!0},commit:function(e){this.onChange(),e.url||(e.url={}),e.url.url=this.getValue(),this.allowOnChange=!1}}],setup:function(){this.getDialog().getContentElement("info","linkType")||this.getElement().show()}},{type:"button",id:"browse",hidden:"true",filebrowser:"info:url",label:m.browseServer}]},{type:"vbox",id:"anchorOptions",width:260,align:"center",padding:0,children:[{type:"fieldset",id:"selectAnchorText",label:g.selectAnchor,setup:function(){a=o.getEditorAnchors(e),this.getElement()[a&&a.length?"show":"hide"]()},children:[{type:"hbox",id:"selectAnchor",children:[{type:"select",id:"anchorName",default:"",label:g.anchorName,style:"width: 100%;",items:[[""]],setup:function(e){if(this.clear(),this.add(""),a)for(var t=0;t<a.length;t++)a[t].name&&this.add(a[t].name);e.anchor&&this.setValue(e.anchor.name);var i=this.getDialog().getContentElement("info","linkType");i&&"email"==i.getValue()&&this.focus()},commit:function(e){e.anchor||(e.anchor={}),e.anchor.name=this.getValue()}},{type:"select",id:"anchorId",default:"",label:g.anchorId,style:"width: 100%;",items:[[""]],setup:function(e){if(this.clear(),this.add(""),a)for(var t=0;t<a.length;t++)a[t].id&&this.add(a[t].id);e.anchor&&this.setValue(e.anchor.id)},commit:function(e){e.anchor||(e.anchor={}),e.anchor.id=this.getValue()}}],setup:function(){this.getElement()[a&&a.length?"show":"hide"]()}}]},{type:"html",id:"noAnchors",style:"text-align: center;",html:'<div role="note" tabIndex="-1">'+CKEDITOR.tools.htmlEncode(g.noAnchors)+"</div>",focus:!0,setup:function(){this.getElement()[a&&a.length?"hide":"show"]()}}],setup:function(){this.getDialog().getContentElement("info","linkType")||this.getElement().hide()}},{type:"vbox",id:"emailOptions",padding:1,children:[{type:"text",id:"emailAddress",label:g.emailAddress,required:!0,validate:function(){var e=this.getDialog();return!e.getContentElement("info","linkType")||"email"!=e.getValueOf("info","linkType")||CKEDITOR.dialog.validate.notEmpty(g.noEmail).apply(this)},setup:function(e){e.email&&this.setValue(e.email.address);var t=this.getDialog().getContentElement("info","linkType");t&&"email"==t.getValue()&&this.select()},commit:function(e){e.email||(e.email={}),e.email.address=this.getValue()}},{type:"text",id:"emailSubject",label:g.emailSubject,setup:function(e){e.email&&this.setValue(e.email.subject)},commit:function(e){e.email||(e.email={}),e.email.subject=this.getValue()}},{type:"textarea",id:"emailBody",label:g.emailBody,rows:3,default:"",setup:function(e){e.email&&this.setValue(e.email.body)},commit:function(e){e.email||(e.email={}),e.email.body=this.getValue()}}],setup:function(){this.getDialog().getContentElement("info","linkType")||this.getElement().hide()}}]},{id:"target",requiredContent:"a[target]",label:g.target,title:g.target,elements:[{type:"hbox",widths:["50%","50%"],children:[{type:"select",id:"linkTargetType",label:m.target,default:"notSet",style:"width : 100%;",items:[[m.notSet,"notSet"],[g.targetFrame,"frame"],[g.targetPopup,"popup"],[m.targetNew,"_blank"],[m.targetTop,"_top"],[m.targetSelf,"_self"],[m.targetParent,"_parent"]],onChange:s,setup:function(e){e.target&&this.setValue(e.target.type||"notSet"),s.call(this)},commit:function(e){e.target||(e.target={}),e.target.type=this.getValue()}},{type:"text",id:"linkTargetName",label:g.targetFrameName,default:"",setup:function(e){e.target&&this.setValue(e.target.name)},commit:function(e){e.target||(e.target={}),e.target.name=this.getValue().replace(/([^\x00-\x7F]|\s)/gi,"")}}]},{type:"vbox",width:"100%",align:"center",padding:2,id:"popupFeatures",children:[{type:"fieldset",label:g.popupFeatures,children:[{type:"hbox",children:[{type:"checkbox",id:"resizable",label:g.popupResizable,setup:r,commit:c},{type:"checkbox",id:"status",label:g.popupStatusBar,setup:r,commit:c}]},{type:"hbox",children:[{type:"checkbox",id:"location",label:g.popupLocationBar,setup:r,commit:c},{type:"checkbox",id:"toolbar",label:g.popupToolbar,setup:r,commit:c}]},{type:"hbox",children:[{type:"checkbox",id:"menubar",label:g.popupMenuBar,setup:r,commit:c},{type:"checkbox",id:"fullscreen",label:g.popupFullScreen,setup:r,commit:c}]},{type:"hbox",children:[{type:"checkbox",id:"scrollbars",label:g.popupScrollBars,setup:r,commit:c},{type:"checkbox",id:"dependent",label:g.popupDependent,setup:r,commit:c}]},{type:"hbox",children:[{type:"text",widths:["50%","50%"],labelLayout:"horizontal",label:m.width,id:"width",setup:r,commit:c},{type:"text",labelLayout:"horizontal",widths:["50%","50%"],label:g.popupLeft,id:"left",setup:r,commit:c}]},{type:"hbox",children:[{type:"text",labelLayout:"horizontal",widths:["50%","50%"],label:m.height,id:"height",setup:r,commit:c},{type:"text",labelLayout:"horizontal",label:g.popupTop,widths:["50%","50%"],id:"top",setup:r,commit:c}]}]}]}]},{id:"upload",label:g.upload,title:g.upload,hidden:!0,filebrowser:"uploadButton",elements:[{type:"file",id:"upload",label:m.upload,style:"height:40px",size:29},{type:"fileButton",id:"uploadButton",label:m.uploadSubmit,filebrowser:"info:url",for:["upload","upload"]}]},{id:"advanced",label:g.advanced,title:g.advanced,elements:[{type:"vbox",padding:1,children:[{type:"hbox",widths:["45%","35%","20%"],children:[{type:"text",id:"advId",requiredContent:"a[id]",label:g.id,setup:h,commit:p},{type:"select",id:"advLangDir",requiredContent:"a[dir]",label:g.langDir,default:"",style:"width:110px",items:[[m.notSet,""],[g.langDirLTR,"ltr"],[g.langDirRTL,"rtl"]],setup:h,commit:p},{type:"text",id:"advAccessKey",requiredContent:"a[accesskey]",width:"80px",label:g.acccessKey,maxLength:1,setup:h,commit:p}]},{type:"hbox",widths:["45%","35%","20%"],children:[{type:"text",label:g.name,id:"advName",requiredContent:"a[name]",setup:h,commit:p},{type:"text",label:g.langCode,id:"advLangCode",requiredContent:"a[lang]",width:"110px",default:"",setup:h,commit:p},{type:"text",label:g.tabIndex,id:"advTabIndex",requiredContent:"a[tabindex]",width:"80px",maxLength:5,setup:h,commit:p}]}]},{type:"vbox",padding:1,children:[{type:"hbox",widths:["45%","55%"],children:[{type:"text",label:g.advisoryTitle,requiredContent:"a[title]",default:"",id:"advTitle",setup:h,commit:p},{type:"text",label:g.advisoryContentType,requiredContent:"a[type]",default:"",id:"advContentType",setup:h,commit:p}]},{type:"hbox",widths:["45%","55%"],children:[{type:"text",label:g.cssClasses,requiredContent:"a(cke-xyz)",default:"",id:"advCSSClasses",setup:h,commit:p},{type:"text",label:g.charset,requiredContent:"a[charset]",default:"",id:"advCharset",setup:h,commit:p}]},{type:"hbox",widths:["45%","55%"],children:[{type:"text",label:g.rel,requiredContent:"a[rel]",default:"",id:"advRel",setup:h,commit:p},{type:"text",label:g.styles,requiredContent:"a{cke-xyz}",default:"",id:"advStyles",validate:CKEDITOR.dialog.validate.inlineStyle(e.lang.common.invalidInlineStyle),setup:h,commit:p}]},{type:"hbox",widths:["45%","55%"],children:[{type:"checkbox",id:"download",requiredContent:"a[download]",label:g.download,setup:function(e){void 0!==e.download&&this.setValue("checked","checked")},commit:function(e){this.getValue()&&(e.download=this.getValue())}}]}]}]}],onShow:function(){var e=this.getParentEditor(),t=e.getSelection(),i=this.getContentElement("info","linkDisplayText").getElement().getParent().getParent(),l=o.getSelectedLink(e,!0),n=l[0]||null;n&&n.hasAttribute("href")&&(t.getSelectedElement()||t.isInTable()||t.selectElement(n));var a=o.parseLinkAttributes(e,n);l.length<=1&&o.showDisplayTextForElement(n,e)?i.show():i.hide(),this._.selectedElements=l,this.setupContent(a)},onOk:function(){var t={};this.commitContent(t),this._.selectedElements.length?(l(e,this._.selectedElements,t),delete this._.selectedElements):i(e,t)},onLoad:function(){e.config.linkShowAdvancedTab||this.hidePage("advanced"),e.config.linkShowTargetTab||this.hidePage("target")},onFocus:function(){var e=this.getContentElement("info","linkType");e&&"url"==e.getValue()&&this.getContentElement("info","url").select()}}});