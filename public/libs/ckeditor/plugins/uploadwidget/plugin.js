"use strict";CKEDITOR.plugins.add("uploadwidget",{lang:"az,ca,cs,da,de,de-ch,el,en,eo,es,es-mx,eu,fr,gl,hr,hu,id,it,ja,km,ko,ku,nb,nl,no,oc,pl,pt,pt-br,ru,sk,sv,tr,ug,uk,zh,zh-cn",requires:"widget,clipboard,filetools,notificationaggregator",init:function(e){e.filter.allow("*[!data-widget,!data-cke-upload-id]")}}),CKEDITOR.fileTools||(CKEDITOR.fileTools={}),CKEDITOR.tools.extend(CKEDITOR.fileTools,{addUploadWidget:function(e,t,a){var o=CKEDITOR.fileTools,i=e.uploadRepository,n=a.supportedTypes?10:20;a.fileToElement&&e.on("paste",function(n){var d,l,r=n.data,s=r.dataTransfer,u=s.getFilesCount(),p=a.loadMethod||"loadAndUpload";if(!r.dataValue&&u)for(l=0;l<u;l++)if(d=s.getFile(l),!a.supportedTypes||o.isTypeSupported(d,a.supportedTypes)){var c=a.fileToElement(d),g=i.create(d);c&&(g[p](a.uploadUrl,a.additionalRequestParameters),CKEDITOR.fileTools.markElement(c,t,g.id),"loadAndUpload"!=p&&"upload"!=p||CKEDITOR.fileTools.bindNotifications(e,g),r.dataValue+=c.getOuterHtml())}},null,null,n),CKEDITOR.tools.extend(a,{downcast:function(){return new CKEDITOR.htmlParser.text("")},init:function(){var t,a,o=this,n=this.wrapper.findOne("[data-cke-upload-id]").data("cke-upload-id"),d=i.loaders[n],l=CKEDITOR.tools.capitalize;d.on("update",function(i){if(!o.wrapper||!o.wrapper.getParent())return e.editable().find('[data-cke-upload-id="'+n+'"]').count()||d.abort(),void i.removeListener();e.fire("lockSnapshot");var r="on"+l(d.status);"function"!=typeof o[r]||!1!==o[r](d)?(a="cke_upload_"+d.status,o.wrapper&&a!=t&&(t&&o.wrapper.removeClass(t),o.wrapper.addClass(a),t=a),"error"!=d.status&&"abort"!=d.status||e.widgets.del(o),e.fire("unlockSnapshot")):e.fire("unlockSnapshot")}),d.update()},replaceWith:function(t,a){if(""!==t.trim()){var o,i,n=this==e.widgets.focused,d=e.editable(),l=e.createRange();n||(i=e.getSelection().createBookmarks()),l.setStartBefore(this.wrapper),l.setEndAfter(this.wrapper),n&&(o=l.createBookmark()),d.insertHtmlIntoRange(t,l,a),e.widgets.checkWidgets({initOnlyNew:!0}),e.widgets.destroy(this,!0),n?(l.moveToBookmark(o),l.select()):e.getSelection().selectBookmarks(i)}else e.widgets.del(this)}}),e.widgets.add(t,a)},markElement:function(e,t,a){e.setAttributes({"data-cke-upload-id":a,"data-widget":t})},bindNotifications:function(e,t){function a(){(o=e._.uploadWidgetNotificaionAggregator)&&!o.isFinished()||(o=e._.uploadWidgetNotificaionAggregator=new CKEDITOR.plugins.notificationAggregator(e,e.lang.uploadwidget.uploadMany,e.lang.uploadwidget.uploadOne)).once("finished",function(){var t=o.getTaskCount();0===t?o.notification.hide():o.notification.update({message:1==t?e.lang.uploadwidget.doneOne:e.lang.uploadwidget.doneMany.replace("%1",t),type:"success",important:1})})}var o,i=null;t.on("update",function(){!i&&t.uploadTotal&&(a(),i=o.createTask({weight:t.uploadTotal})),i&&"uploading"==t.status&&i.update(t.uploaded)}),t.on("uploaded",function(){i&&i.done()}),t.on("error",function(){i&&i.cancel(),e.showNotification(t.message,"warning")}),t.on("abort",function(){i&&i.cancel(),e.showNotification(e.lang.uploadwidget.abort,"info")})}});