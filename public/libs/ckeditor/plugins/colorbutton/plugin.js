CKEDITOR.plugins.add("colorbutton",{requires:"panelbutton,floatpanel",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"bgcolor,textcolor",hidpi:!0,init:function(t){function e(e,n,s,i,u){var f,d=new CKEDITOR.style(a["colorButton_"+n+"Style"]),g=CKEDITOR.tools.getNextId()+"_colorBox";u=u||{},t.ui.add(e,CKEDITOR.UI_PANELBUTTON,{label:s,title:s,modes:{wysiwyg:1},editorFocus:0,toolbar:"colors,"+i,allowedContent:d,requiredContent:d,contentTransformations:u.contentTransformations,panel:{css:CKEDITOR.skin.getPath("editor"),attributes:{role:"listbox","aria-label":c.panelTitle}},onBlock:function(e,r){f=r,r.autoSize=!0,r.element.addClass("cke_colorblock"),r.element.setHtml(o(e,n,g)),r.element.getDocument().getBody().setStyle("overflow","hidden"),CKEDITOR.ui.fire("ready",this);var l=r.keys,a="rtl"==t.lang.dir;l[a?37:39]="next",l[40]="next",l[9]="next",l[a?39:37]="prev",l[38]="prev",l[CKEDITOR.SHIFT+9]="prev",l[32]="click"},refresh:function(){t.activeFilter.check(d)||this.setState(CKEDITOR.TRISTATE_DISABLED)},onOpen:function(){var e,o=t.getSelection(),c=o&&o.getStartElement(),s=t.elementPath(c);if(s){c=s.block||s.blockLimit||t.document.getBody();do{e=c&&c.getComputedStyle("back"==n?"background-color":"color")||"transparent"}while("back"==n&&"transparent"==e&&c&&(c=c.getParent()));e&&"transparent"!=e||(e="#ffffff"),!1!==a.colorButton_enableAutomatic&&this._.panel._.iframe.getFrameDocument().getById(g).setStyle("background-color",e);var i=o&&o.getRanges()[0];if(i){for(var u,d=new CKEDITOR.dom.walker(i),p=i.collapsed?i.startContainer:d.next(),b="";p;){if(p.type===CKEDITOR.NODE_TEXT&&(p=p.getParent()),u=l(p.getComputedStyle("back"==n?"background-color":"color")),(b=b||u)!==u){b="";break}p=d.next()}r(f,b)}return e}}})}function o(e,o,r){var l=[],s=a.colorButton_colors.split(","),i=a.colorButton_colorsPerRow||6,u=t.plugins.colordialog&&!1!==a.colorButton_enableMore,f=s.length+(u?2:1),d=CKEDITOR.tools.addFunction(function o(r,l){function c(t){this.removeListener("ok",c),this.removeListener("cancel",c),"ok"==t.name&&o(this.getContentElement("picker","selectedColor").getValue(),l)}if("?"!=r){if(t.focus(),e.hide(),t.fire("saveSnapshot"),t.removeStyle(new CKEDITOR.style(a["colorButton_"+l+"Style"],{color:"inherit"})),r){var s=a["colorButton_"+l+"Style"];s.childRule="back"==l?function(t){return n(t)}:function(t){return!(t.is("a")||t.getElementsByTag("a").count())||n(t)},t.applyStyle(new CKEDITOR.style(s,{color:r}))}t.fire("saveSnapshot")}else t.openDialog("colordialog",function(){this.on("ok",c),this.on("cancel",c)})});!1!==a.colorButton_enableAutomatic&&l.push('<a class="cke_colorauto" _cke_focus=1 hidefocus=true title="',c.auto,'" onclick="CKEDITOR.tools.callFunction(',d,",null,'",o,"');return false;\" href=\"javascript:void('",c.auto,'\')" role="option" aria-posinset="1" aria-setsize="',f,'"><table role="presentation" cellspacing=0 cellpadding=0 width="100%"><tr><td colspan="'+i+'" align="center"><span class="cke_colorbox" id="',r,'"></span>',c.auto,"</td></tr></table></a>"),l.push('<table role="presentation" cellspacing=0 cellpadding=0 width="100%">');for(var g=0;g<s.length;g++){g%i==0&&l.push("</tr><tr>");var p=s[g].split("/"),b=p[0],k=p[1]||b;p[1]||(b="#"+b.replace(/^(.)(.)(.)$/,"$1$1$2$2$3$3"));var m=t.lang.colorbutton.colors[k]||k;l.push('<td><a class="cke_colorbox" _cke_focus=1 hidefocus=true title="',m,'" onclick="CKEDITOR.tools.callFunction(',d,",'",b,"','",o,"'); return false;\" href=\"javascript:void('",m,'\')" data-value="'+k+'" role="option" aria-posinset="',g+2,'" aria-setsize="',f,'"><span class="cke_colorbox" style="background-color:#',k,'"></span></a></td>')}return u&&l.push('</tr><tr><td colspan="'+i+'" align="center"><a class="cke_colormore" _cke_focus=1 hidefocus=true title="',c.more,'" onclick="CKEDITOR.tools.callFunction(',d,",'?','",o,"');return false;\" href=\"javascript:void('",c.more,"')\"",' role="option" aria-posinset="',f,'" aria-setsize="',f,'">',c.more,"</a></td>"),l.push("</tr></table>"),l.join("")}function n(t){return"false"==t.getAttribute("contentEditable")||t.getAttribute("data-nostyle")}function r(t,e){for(var o=t._.getItems(),n=0;n<o.count();n++){var r=o.getItem(n);r.removeAttribute("aria-selected"),e&&e==l(r.getAttribute("data-value"))&&r.setAttribute("aria-selected",!0)}}function l(t){return CKEDITOR.tools.convertRgbToHex(t||"").replace(/#/,"").toLowerCase()}var a=t.config,c=t.lang.colorbutton;if(!CKEDITOR.env.hc){e("TextColor","fore",c.textColorTitle,10,{contentTransformations:[[{element:"font",check:"span{color}",left:function(t){return!!t.attributes.color},right:function(t){t.name="span",t.attributes.color&&(t.styles.color=t.attributes.color),delete t.attributes.color}}]]});var s={},i=t.config.colorButton_normalizeBackground;(void 0===i||i)&&(s.contentTransformations=[[{element:"span",left:function(t){var e=CKEDITOR.tools;if("span"!=t.name||!t.styles||!t.styles.background)return!1;var o=e.style.parse.background(t.styles.background);return o.color&&1===e.objectKeys(o).length},right:function(e){var o=new CKEDITOR.style(t.config.colorButton_backStyle,{color:e.styles.background}).getDefinition();return e.name=o.element,e.styles=o.styles,e.attributes=o.attributes||{},e}}]]),e("BGColor","back",c.bgColorTitle,20,s)}}}),CKEDITOR.config.colorButton_colors="1ABC9C,2ECC71,3498DB,9B59B6,4E5F70,F1C40F,16A085,27AE60,2980B9,8E44AD,2C3E50,F39C12,E67E22,E74C3C,ECF0F1,95A5A6,DDD,FFF,D35400,C0392B,BDC3C7,7F8C8D,999,000",CKEDITOR.config.colorButton_foreStyle={element:"span",styles:{color:"#(color)"},overrides:[{element:"font",attributes:{color:null}}]},CKEDITOR.config.colorButton_backStyle={element:"span",styles:{"background-color":"#(color)"}};