!function(){function e(e){var t="left"==e?"pageXOffset":"pageYOffset",i="left"==e?"scrollLeft":"scrollTop";return t in n.$?n.$[t]:CKEDITOR.document.$.documentElement[i]}function t(t){var o=t.config,a=t.fire("uiSpace",{space:"top",html:""}).html,l=function(){function a(e,t,n){r.setStyle(t,i(n)),r.setStyle("position",e)}function c(e){var t=f.getDocumentPosition();switch(e){case"top":a("absolute","top",t.y-g-v);break;case"pin":a("fixed","top",b);break;case"bottom":a("absolute","top",t.y+(p.height||p.bottom-p.top)+v)}s=e}var s,f,d,p,u,g,h,m=o.floatSpaceDockedOffsetX||0,v=o.floatSpaceDockedOffsetY||0,D=o.floatSpacePinnedOffsetX||0,b=o.floatSpacePinnedOffsetY||0;return function(a){if(f=t.editable()){var b=a&&"focus"==a.name;if(b&&r.show(),t.fire("floatingSpaceLayout",{show:b}),r.removeStyle("left"),r.removeStyle("right"),d=r.getClientRect(),p=f.getClientRect(),u=n.getViewPaneSize(),g=d.height,h=e("left"),!s)return s="pin",c("pin"),void l(a);c(g+v<=p.top?"top":g+v>u.height-p.bottom?"pin":"bottom");var w,C,k=u.width/2;w=o.floatSpacePreferRight?"right":p.left>0&&p.right<u.width&&p.width>d.width?"rtl"==o.contentsLangDirection?"right":"left":k-p.left>p.right-k?"left":"right",d.width>u.width?(w="left",C=0):(C="left"==w?p.left>0?p.left:0:p.right<u.width?u.width-p.right:0)+d.width>u.width&&(w="left"==w?"right":"left",C=0);var O="pin"==s?0:"left"==w?h:-h;r.setStyle(w,i(("pin"==s?D:m)+C+O))}}}();if(a){var c=new CKEDITOR.template('<div id="cke_{name}" class="cke {id} cke_reset_all cke_chrome cke_editor_{name} cke_float cke_{langDir} '+CKEDITOR.env.cssClass+'" dir="{langDir}" title="'+(CKEDITOR.env.gecko?" ":"")+'" lang="{langCode}" role="application" style="{style}"'+(t.title?' aria-labelledby="cke_{name}_arialbl"':" ")+">"+(t.title?'<span id="cke_{name}_arialbl" class="cke_voice_label">{voiceLabel}</span>':" ")+'<div class="cke_inner"><div id="{topId}" class="cke_top" role="presentation">{content}</div></div></div>'),r=CKEDITOR.document.getBody().append(CKEDITOR.dom.element.createFromHtml(c.output({content:a,id:t.id,langDir:t.lang.dir,langCode:t.langCode,name:t.name,style:"display:none;z-index:"+(o.baseFloatZIndex-1),topId:t.ui.spaceId("top"),voiceLabel:t.title}))),s=CKEDITOR.tools.eventsBuffer(500,l),f=CKEDITOR.tools.eventsBuffer(100,l);r.unselectable(),r.on("mousedown",function(e){(e=e.data).getTarget().hasAscendant("a",1)||e.preventDefault()}),t.on("focus",function(e){l(e),t.on("change",s.input),n.on("scroll",f.input),n.on("resize",f.input)}),t.on("blur",function(){r.hide(),t.removeListener("change",s.input),n.removeListener("scroll",f.input),n.removeListener("resize",f.input)}),t.on("destroy",function(){n.removeListener("scroll",f.input),n.removeListener("resize",f.input),r.clearCustomData(),r.remove()}),t.focusManager.hasFocus&&r.show(),t.focusManager.add(r,1)}}var n=CKEDITOR.document.getWindow(),i=CKEDITOR.tools.cssLength;CKEDITOR.plugins.add("floatingspace",{init:function(e){e.on("loaded",function(){t(this)},null,null,20)}})}();