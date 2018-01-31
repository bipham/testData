!function(){"use strict";function e(e){var t=e.data,n=t&&t.$;return!(!t||!n)&&(CKEDITOR.env.ie&&CKEDITOR.env.version<9?1===n.button:0===n.button)}function t(e,t,n,o){var a,r=new CKEDITOR.dom.walker(e);if(!(a=e.startContainer.getAscendant(t,!0)||e.endContainer.getAscendant(t,!0))||(n(a),!o))for(;a=r.next();)if((a=a.getAscendant(t,!0))&&(n(a),o))return}function n(e,t){var n={ul:"ol",ol:"ul"};return-1!==a(t,function(t){return t.element===e||t.element===n[e]})}function o(e){this.styles=null,this.sticky=!1,this.editor=e,this.filter=new CKEDITOR.filter(e.config.copyFormatting_allowRules),!0===e.config.copyFormatting_allowRules&&(this.filter.disabled=!0),e.config.copyFormatting_disallowRules&&this.filter.disallow(e.config.copyFormatting_disallowRules)}var a=CKEDITOR.tools.indexOf,r=!1;CKEDITOR.plugins.add("copyformatting",{lang:"az,de,en,it,ja,nb,nl,oc,pl,pt-br,ru,sv,tr,zh,zh-cn",icons:"copyformatting",hidpi:!0,init:function(t){var o=CKEDITOR.plugins.copyformatting;o._addScreenReaderContainer(),r||(CKEDITOR.document.appendStyleSheet(this.path+"styles/copyformatting.css"),r=!0),t.addContentsCss&&t.addContentsCss(this.path+"styles/copyformatting.css"),t.copyFormatting=new o.state(t),t.addCommand("copyFormatting",o.commands.copyFormatting),t.addCommand("applyFormatting",o.commands.applyFormatting),t.ui.addButton("CopyFormatting",{label:t.lang.copyformatting.label,command:"copyFormatting",toolbar:"cleanup,0"}),t.on("contentDom",function(){var n,o=t.editable(),a=o.isInline()?o:t.document,r=t.ui.get("CopyFormatting");o.attachListener(a,"mouseup",function(n){e(n)&&t.execCommand("applyFormatting")}),o.attachListener(CKEDITOR.document,"mouseup",function(n){var a=t.getCommand("copyFormatting");e(n)&&a.state===CKEDITOR.TRISTATE_ON&&!o.contains(n.data.getTarget())&&t.execCommand("copyFormatting")}),r&&(n=CKEDITOR.document.getById(r._.id),o.attachListener(n,"dblclick",function(){t.execCommand("copyFormatting",{sticky:!0})}),o.attachListener(n,"mouseup",function(e){e.data.stopPropagation()}))}),t.config.copyFormatting_keystrokeCopy&&t.setKeystroke(t.config.copyFormatting_keystrokeCopy,"copyFormatting"),t.on("key",function(e){var n=t.getCommand("copyFormatting"),o=e.data.domEvent;o.getKeystroke&&27===o.getKeystroke()&&n.state===CKEDITOR.TRISTATE_ON&&t.execCommand("copyFormatting")}),t.copyFormatting.on("extractFormatting",function(e){var n,a=e.data.element;return a.contains(t.editable())||a.equals(t.editable())?e.cancel():(n=o._convertElementToStyleDef(a),t.copyFormatting.filter.check(new CKEDITOR.style(n),!0,!0)?void(e.data.styleDef=n):e.cancel())}),t.copyFormatting.on("applyFormatting",function(e){if(!e.data.preventFormatStripping){var r,i,l,s=e.data.range,c=o._extractStylesFromRange(t,s),m=o._determineContext(s);if(t.copyFormatting._isContextAllowed(m))for(l=0;l<c.length;l++)r=c[l],i=s.createBookmark(),-1===a(o.preservedElements,r.element)?CKEDITOR.env.webkit&&!CKEDITOR.env.chrome?c[l].removeFromRange(e.data.range,e.editor):c[l].remove(e.editor):n(r.element,e.data.styles)&&o._removeStylesFromElementInRange(s,r.element),s.moveToBookmark(i)}}),t.copyFormatting.on("applyFormatting",function(e){var n=CKEDITOR.plugins.copyformatting,o=n._determineContext(e.data.range);"list"===o&&t.copyFormatting._isContextAllowed("list")?n._applyStylesToListContext(e.editor,e.data.range,e.data.styles):"table"===o&&t.copyFormatting._isContextAllowed("table")?n._applyStylesToTableContext(e.editor,e.data.range,e.data.styles):t.copyFormatting._isContextAllowed("text")&&n._applyStylesToTextContext(e.editor,e.data.range,e.data.styles)},null,null,999)}}),o.prototype._isContextAllowed=function(e){var t=this.editor.config.copyFormatting_allowedContexts;return!0===t||-1!==a(t,e)},CKEDITOR.event.implementOn(o.prototype),CKEDITOR.plugins.copyformatting={state:o,inlineBoundary:["h1","h2","h3","h4","h5","h6","p","div"],excludedAttributes:["id","style","href","data-cke-saved-href","dir"],elementsForInlineTransform:["li"],excludedElementsFromInlineTransform:["table","thead","tbody","ul","ol"],excludedAttributesFromInlineTransform:["value","type"],preservedElements:["ul","ol","li","td","th","tr","thead","tbody","table"],breakOnElements:["ul","ol","table"],_initialKeystrokePasteCommand:null,commands:{copyFormatting:{exec:function(e,t){var n=this,o=CKEDITOR.plugins.copyformatting,a=e.copyFormatting,r=!!t&&"keystrokeHandler"==t.from,i=!!t&&(t.sticky||r),l=o._getCursorContainer(e),s=CKEDITOR.document.getDocumentElement();if(n.state===CKEDITOR.TRISTATE_ON)return a.styles=null,a.sticky=!1,l.removeClass("cke_copyformatting_active"),s.removeClass("cke_copyformatting_disabled"),s.removeClass("cke_copyformatting_tableresize_cursor"),o._putScreenReaderMessage(e,"canceled"),o._detachPasteKeystrokeHandler(e),n.setState(CKEDITOR.TRISTATE_OFF);a.styles=o._extractStylesFromElement(e,e.elementPath().lastElement),n.setState(CKEDITOR.TRISTATE_ON),r||(l.addClass("cke_copyformatting_active"),s.addClass("cke_copyformatting_tableresize_cursor"),e.config.copyFormatting_outerCursor&&s.addClass("cke_copyformatting_disabled")),a.sticky=i,o._putScreenReaderMessage(e,"copied"),o._attachPasteKeystrokeHandler(e)}},applyFormatting:{editorFocus:!1,exec:function(e,t){var n,o=e.getCommand("copyFormatting"),a=!!t&&"keystrokeHandler"==t.from,r=CKEDITOR.plugins.copyformatting,i=e.copyFormatting,l=r._getCursorContainer(e),s=CKEDITOR.document.getDocumentElement();if(a||o.state===CKEDITOR.TRISTATE_ON){if(a&&!i.styles)return r._putScreenReaderMessage(e,"failed"),r._detachPasteKeystrokeHandler(e),!1;n=r._applyFormat(e,i.styles),i.sticky||(i.styles=null,l.removeClass("cke_copyformatting_active"),s.removeClass("cke_copyformatting_disabled"),s.removeClass("cke_copyformatting_tableresize_cursor"),o.setState(CKEDITOR.TRISTATE_OFF),r._detachPasteKeystrokeHandler(e)),r._putScreenReaderMessage(e,n?"applied":"canceled")}}}},_getCursorContainer:function(e){return e.elementMode===CKEDITOR.ELEMENT_MODE_INLINE?e.editable():e.editable().getParent()},_convertElementToStyleDef:function(e){var t=CKEDITOR.tools,n=e.getAttributes(CKEDITOR.plugins.copyformatting.excludedAttributes),o=t.parseCssText(e.getAttribute("style"),!0,!0);return{element:e.getName(),type:CKEDITOR.STYLE_INLINE,attributes:n,styles:o}},_extractStylesFromElement:function(e,t){var n={},o=[];do{if(t.type===CKEDITOR.NODE_ELEMENT&&!t.hasAttribute("data-cke-bookmark")&&(n.element=t,e.copyFormatting.fire("extractFormatting",n,e)&&n.styleDef&&o.push(new CKEDITOR.style(n.styleDef)),t.getName&&-1!==a(CKEDITOR.plugins.copyformatting.breakOnElements,t.getName())))break}while((t=t.getParent())&&t.type===CKEDITOR.NODE_ELEMENT);return o},_extractStylesFromRange:function(e,t){for(var n,o=[],a=new CKEDITOR.dom.walker(t);n=a.next();)o=o.concat(CKEDITOR.plugins.copyformatting._extractStylesFromElement(e,n));return o},_removeStylesFromElementInRange:function(e,t){for(var n,o=-1!==a(["ol","ul","table"],t),r=new CKEDITOR.dom.walker(e);n=r.next();)if((n=n.getAscendant(t,!0))&&(n.removeAttributes(n.getAttributes()),o))return},_getSelectedWordOffset:function(e){function t(e,t){return e[t?"getPrevious":"getNext"](function(e){return e.type!==CKEDITOR.NODE_COMMENT})}function n(e){return e.type==CKEDITOR.NODE_ELEMENT?e.getHtml().replace(/<span.*?>&nbsp;<\/span>/g,"").replace(/<.*?>/g,""):e.getText()}function o(e,r){var i,l,s,c,m=e,d=/\s/g,g=["p","br","ol","ul","li","td","th","div","caption","body"],p=!1,y=!1;do{for(i=t(m,r);!i&&m.getParent();){if(m=m.getParent(),-1!==a(g,m.getName())){p=!0,y=!0;break}i=t(m,r)}if(i&&i.getName&&-1!==a(g,i.getName())){p=!0;break}m=i}while(m&&m.getStyle&&("none"==m.getStyle("display")||!m.getText()));for(m||(m=e);m.type!==CKEDITOR.NODE_TEXT;)m=!p||r||y?m.getChild(0):m.getChild(m.getChildCount()-1);for(l=n(m);null!=(s=d.exec(l))&&(c=s.index,r););if("number"!=typeof c&&!p)return o(m,r);if(p)c=r?0:(s=(d=/([\.\b]*$)/).exec(l))?s.index:l.length;else if(r&&(c+=1)>l.length)return o(m);return{node:m,offset:c}}var r,i,l,s,c,m,d,g=/\b\w+\b/gi;for(r=n(l=s=c=e.startContainer);null!=(i=g.exec(r));)if(i.index+i[0].length>=e.startOffset){if(m=i.index,d=i.index+i[0].length,0===i.index){var p=o(l,!0);s=p.node,m=p.offset}if(d>=r.length){var y=o(l);c=y.node,d=y.offset}return{startNode:s,startOffset:m,endNode:c,endOffset:d}}return null},_filterStyles:function(e){var t,n,o=CKEDITOR.tools.isEmpty,a=[];for(n=0;n<e.length;n++)t=e[n]._.definition,-1!==CKEDITOR.tools.indexOf(CKEDITOR.plugins.copyformatting.inlineBoundary,t.element)&&(t.element=e[n].element="span"),"span"===t.element&&o(t.attributes)&&o(t.styles)||a.push(e[n]);return a},_determineContext:function(e){function t(t){var n,o=new CKEDITOR.dom.walker(e);if(e.startContainer.getAscendant(t,!0)||e.endContainer.getAscendant(t,!0))return!0;for(;n=o.next();)if(n.getAscendant(t,!0))return!0}return t({ul:1,ol:1})?"list":t("table")?"table":"text"},_applyStylesToTextContext:function(e,t,n){var o,r,i,l=CKEDITOR.plugins.copyformatting,s=l.excludedAttributesFromInlineTransform;for(CKEDITOR.env.webkit&&!CKEDITOR.env.chrome&&e.getSelection().selectRanges([t]),r=0;r<n.length;r++)if(o=n[r],-1===a(l.excludedElementsFromInlineTransform,o.element)){if(-1!==a(l.elementsForInlineTransform,o.element))for(o.element=o._.definition.element="span",i=0;i<s.length;i++)o._.definition.attributes[s[i]]&&delete o._.definition.attributes[s[i]];o.apply(e)}},_applyStylesToListContext:function(e,n,o){function a(e,t){e.getName()!==t.element&&e.renameNode(t.element),t.applyToObject(e)}var r,i,l;for(l=0;l<o.length;l++)r=o[l],i=n.createBookmark(),"ol"===r.element||"ul"===r.element?t(n,{ul:1,ol:1},function(e){a(e,r)},!0):"li"===r.element?t(n,"li",function(e){r.applyToObject(e)}):CKEDITOR.plugins.copyformatting._applyStylesToTextContext(e,n,[r]),n.moveToBookmark(i)},_applyStylesToTableContext:function(e,n,o){function r(e,t){e.getName()!==t.element&&((t=t.getDefinition()).element=e.getName(),t=new CKEDITOR.style(t)),t.applyToObject(e)}var i,l,s;for(s=0;s<o.length;s++)i=o[s],l=n.createBookmark(),-1!==a(["table","tr"],i.element)?t(n,i.element,function(e){i.applyToObject(e)}):-1!==a(["td","th"],i.element)?t(n,{td:1,th:1},function(e){r(e,i)}):-1!==a(["thead","tbody"],i.element)?t(n,{thead:1,tbody:1},function(e){r(e,i)}):CKEDITOR.plugins.copyformatting._applyStylesToTextContext(e,n,[i]),n.moveToBookmark(l)},_applyFormat:function(e,t){var n,o,a,r=e.getSelection().getRanges()[0],i=CKEDITOR.plugins.copyformatting;if(!r)return!1;if(r.collapsed){if(o=e.getSelection().createBookmarks(),!(n=i._getSelectedWordOffset(r)))return;(r=e.createRange()).setStart(n.startNode,n.startOffset),r.setEnd(n.endNode,n.endOffset),r.select()}return t=i._filterStyles(t),a={styles:t,range:r,preventFormatStripping:!1},!!e.copyFormatting.fire("applyFormatting",a,e)&&(o&&e.getSelection().selectBookmarks(o),!0)},_putScreenReaderMessage:function(e,t){var n=this._getScreenReaderContainer();n&&n.setText(e.lang.copyformatting.notification[t])},_addScreenReaderContainer:function(){return this._getScreenReaderContainer()?this._getScreenReaderContainer():CKEDITOR.env.ie6Compat||CKEDITOR.env.ie7Compat?void 0:CKEDITOR.document.getBody().append(CKEDITOR.dom.element.createFromHtml('<div class="cke_screen_reader_only cke_copyformatting_notification"><div aria-live="polite"></div></div>')).getChild(0)},_getScreenReaderContainer:function(){if(!CKEDITOR.env.ie6Compat&&!CKEDITOR.env.ie7Compat)return CKEDITOR.document.getBody().findOne(".cke_copyformatting_notification div[aria-live]")},_attachPasteKeystrokeHandler:function(e){var t=e.config.copyFormatting_keystrokePaste;t&&(this._initialKeystrokePasteCommand=e.keystrokeHandler.keystrokes[t],e.setKeystroke(t,"applyFormatting"))},_detachPasteKeystrokeHandler:function(e){var t=e.config.copyFormatting_keystrokePaste;t&&e.setKeystroke(t,this._initialKeystrokePasteCommand||!1)}},CKEDITOR.config.copyFormatting_outerCursor=!0,CKEDITOR.config.copyFormatting_allowRules="b s u i em strong span p div td th ol ul li(*)[*]{*}",CKEDITOR.config.copyFormatting_disallowRules="*[data-cke-widget*,data-widget*,data-cke-realelement](cke_widget*)",CKEDITOR.config.copyFormatting_allowedContexts=!0,CKEDITOR.config.copyFormatting_keystrokeCopy=CKEDITOR.CTRL+CKEDITOR.SHIFT+67,CKEDITOR.config.copyFormatting_keystrokePaste=CKEDITOR.CTRL+CKEDITOR.SHIFT+86}();