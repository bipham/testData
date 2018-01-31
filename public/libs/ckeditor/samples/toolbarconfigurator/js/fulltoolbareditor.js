"use strict";window.ToolbarConfigurator={},function(){function t(){this.instanceid="fte"+CKEDITOR.tools.getNextId(),this.textarea=new CKEDITOR.dom.element("textarea"),this.textarea.setAttributes({id:this.instanceid,name:this.instanceid,contentEditable:!0}),this.buttons=null,this.editorInstance=null}ToolbarConfigurator.FullToolbarEditor=t,t.prototype.init=function(o){var e=this;document.body.appendChild(this.textarea.$),CKEDITOR.replace(this.instanceid),this.editorInstance=CKEDITOR.instances[this.instanceid],this.editorInstance.once("configLoaded",function(n){var r=n.editor.config;delete r.removeButtons,delete r.toolbarGroups,delete r.toolbar,ToolbarConfigurator.AbstractToolbarModifier.extendPluginsConfig(r),n.editor.once("loaded",function(){e.buttons=t.toolbarToButtons(e.editorInstance.toolbar),e.buttonsByGroup=t.groupButtons(e.buttons),e.buttonNamesByGroup=e.groupButtonNamesByGroup(e.buttons),n.editor.container.hide(),"function"==typeof o&&o(e.buttons)})})},t.prototype.groupButtonNamesByGroup=function(o){var e=this,n=t.groupButtons(o);for(var r in n){var a=n[r];n[r]=t.map(a,function(t){return e.getCamelCasedButtonName(t.name)})}return n},t.prototype.getGroupByName=function(t){for(var o=this.editorInstance.config.toolbarGroups||this.getFullToolbarGroupsConfig(),e=o.length,n=0;n<e;n+=1)if(o[n].name===t)return o[n];return null},t.prototype.getCamelCasedButtonName=function(t){var o=this.editorInstance.ui.items;for(var e in o)if(o[e].name==t)return e;return null},t.prototype.getFullToolbarGroupsConfig=function(t){t=!0===t;for(var o=[],e=this.editorInstance.toolbar,n=e.length,r=0;r<n;r+=1){var a=e[r],i={};"string"==typeof a.name?(i.name=a.name,a.groups&&(i.groups=Array.prototype.slice.call(a.groups)),o.push(i)):t&&o.push("/")}return o},t.filter=function(t,o){for(var e=t&&t.length?t.length:0,n=[],r=0;r<e;r+=1)o(t[r])&&n.push(t[r]);return n},t.map=function(t,o){var e;if(CKEDITOR.tools.isArray(t)){e=[];for(var n=t.length,r=0;r<n;r+=1)e.push(o(t[r]))}else{e={};for(var a in t)e[a]=o(t[a])}return e},t.groupButtons=function(t){for(var o={},e=t.length,n=0;n<e;n+=1){var r=t[n],a=r.toolbar.split(",")[0];o[a]=o[a]||[],o[a].push(r)}return o},t.toolbarToButtons=function(o){for(var e=[],n=o.length,r=0;r<n;r+=1)"object"==typeof o[r]&&(e=e.concat(t.groupToButtons(o[r])));return e},t.createToolbarButton=function(o){var e=new CKEDITOR.dom.element("a"),n=t.createIcon(o.name,o.icon,o.command);if(e.setStyle("float","none"),e.addClass("cke_"+("rtl"==CKEDITOR.lang.dir?"rtl":"ltr")),o instanceof CKEDITOR.ui.button)e.addClass("cke_button"),e.addClass("cke_toolgroup"),e.append(n);else if(CKEDITOR.ui.richCombo&&o instanceof CKEDITOR.ui.richCombo){var r=new CKEDITOR.dom.element("span"),a=new CKEDITOR.dom.element("span"),i=new CKEDITOR.dom.element("span");e.addClass("cke_combo_button"),r.addClass("cke_combo_text"),r.addClass("cke_combo_inlinelabel"),r.setText(o.label),a.addClass("cke_combo_open"),i.addClass("cke_combo_arrow"),a.append(i),e.append(r),e.append(a)}return e},t.createIcon=function(t,o,e){var n=CKEDITOR.skin.getIconStyle(t,"rtl"==CKEDITOR.lang.dir);n=(n=n||CKEDITOR.skin.getIconStyle(o,"rtl"==CKEDITOR.lang.dir))||CKEDITOR.skin.getIconStyle(e,"rtl"==CKEDITOR.lang.dir);var r=new CKEDITOR.dom.element("span");return r.addClass("cke_button_icon"),r.addClass("cke_button__"+t+"_icon"),r.setAttribute("style",n),r.setStyle("float","none"),r},t.createButton=function(t,o){var e=new CKEDITOR.dom.element("button");if(e.addClass("button-a"),e.setAttribute("type","button"),"string"==typeof o)for(var n=(o=o.split(" ")).length;n--;)e.addClass(o[n]);return e.setHtml(t),e},t.groupToButtons=function(o){for(var e=[],n=o.items,r=n?n.length:0,a=0;a<r;a+=1){var i=n[a];(i instanceof CKEDITOR.ui.button||CKEDITOR.ui.richCombo&&i instanceof CKEDITOR.ui.richCombo)&&(i.$=t.createToolbarButton(i),e.push(i))}return e}}();