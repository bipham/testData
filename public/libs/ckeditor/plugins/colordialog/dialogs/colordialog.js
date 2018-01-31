CKEDITOR.dialog.add("colordialog",function(e){function t(){v.getById(E).removeStyle("background-color"),d.getContentElement("picker","selectedColor").setValue(""),l()}function o(e){var t,o=e.data.getTarget();"td"==o.getName()&&(t=o.getChild(0).getHtml())&&(l(),(g=o).setAttribute("aria-selected",!0),g.addClass(I),d.getContentElement("picker","selectedColor").setValue(t))}function l(){g&&(g.removeClass(I),g.removeAttribute("aria-selected"),g=null)}function a(e){e=e.replace(/^#/,"");for(var t=0,o=[];t<=2;t++)o[t]=parseInt(e.substr(2*t,2),16);return.2126*o[0]+.7152*o[1]+.0722*o[2]>=165}function r(e){!e.name&&(e=new CKEDITOR.event(e));var t,o=!/mouse/.test(e.name),l=e.data.getTarget();"td"==l.getName()&&(t=l.getChild(0).getHtml())&&(i(e),o?u=l:p=l,o&&l.addClass(a(t)?y:C),s(t))}function n(){u.removeClass(y),u.removeClass(C),s(!1),u=null}function i(e){var t=!/mouse/.test(e.name)&&u;t&&(t.removeClass(y),t.removeClass(C)),u||p||s(!1)}function s(e){e?(v.getById(D).setStyle("background-color",e),v.getById(_).setHtml(e)):(v.getById(D).removeStyle("background-color"),v.getById(_).setHtml("&nbsp;"))}function c(t){var l,a,r=t.data,n=r.getTarget(),i=r.getKeystroke(),s="rtl"==e.lang.dir;switch(i){case 38:(l=n.getParent().getPrevious())&&(a=l.getChild([n.getIndex()])).focus(),r.preventDefault();break;case 40:(l=n.getParent().getNext())&&(a=l.getChild([n.getIndex()]))&&1==a.type&&a.focus(),r.preventDefault();break;case 32:case 13:o(t),r.preventDefault();break;case s?37:39:(a=n.getNext())?1==a.type&&(a.focus(),r.preventDefault(!0)):(l=n.getParent().getNext())&&(a=l.getChild([0]))&&1==a.type&&(a.focus(),r.preventDefault(!0));break;case s?39:37:(a=n.getPrevious())?(a.focus(),r.preventDefault(!0)):(l=n.getParent().getPrevious())&&((a=l.getLast()).focus(),r.preventDefault(!0));break;default:return}}var d,g,u,p,f,m=CKEDITOR.dom.element,v=CKEDITOR.document,b=e.lang.colordialog,h="cke_colordialog_colorcell",y="cke_colordialog_focused_light",C="cke_colordialog_focused_dark",I="cke_colordialog_selected",k={type:"html",html:"&nbsp;"},x=function(e){return CKEDITOR.tools.getNextId()+"_"+e},D=x("hicolor"),_=x("hicolortext"),E=x("selhicolor");return function(){function e(e,o){for(var a=e;a<e+3;a++){var r=new m(f.$.insertRow(-1));r.setAttribute("role","row");for(var n=o;n<o+3;n++)for(var i=0;i<6;i++)t(r.$,"#"+l[n]+l[i]+l[a])}}function t(e,t){var l=new m(e.insertCell(-1));l.setAttribute("class","ColorCell "+h),l.setAttribute("tabIndex",-1),l.setAttribute("role","gridcell"),l.on("keydown",c),l.on("click",o),l.on("focus",r),l.on("blur",i),l.setStyle("background-color",t);var a=x("color_table_cell");l.setAttribute("aria-labelledby",a),l.append(CKEDITOR.dom.element.createFromHtml('<span id="'+a+'" class="cke_voice_label">'+t+"</span>",CKEDITOR.document))}(f=CKEDITOR.dom.element.createFromHtml('<table tabIndex="-1" class="cke_colordialog_table" aria-label="'+b.options+'" role="grid" style="border-collapse:separate;" cellspacing="0"><caption class="cke_voice_label">'+b.options+'</caption><tbody role="presentation"></tbody></table>')).on("mouseover",r),f.on("mouseout",i);var l=["00","33","66","99","cc","ff"];e(0,0),e(3,0),e(0,3),e(3,3);var a=new m(f.$.insertRow(-1));a.setAttribute("role","row"),t(a.$,"#000000");for(var n=0;n<16;n++){var s=n.toString(16);t(a.$,"#"+s+s+s+s+s+s)}t(a.$,"#ffffff")}(),CKEDITOR.document.appendStyleSheet(CKEDITOR.getUrl(CKEDITOR.plugins.get("colordialog").path+"dialogs/colordialog.css")),{title:b.title,minWidth:360,minHeight:220,onLoad:function(){d=this},onHide:function(){t(),n()},contents:[{id:"picker",label:b.title,accessKey:"I",elements:[{type:"hbox",padding:0,widths:["70%","10%","30%"],children:[{type:"html",html:"<div></div>",onLoad:function(){CKEDITOR.document.getById(this.domId).append(f)},focus:function(){(u||this.getElement().getElementsByTag("td").getItem(0)).focus()}},k,{type:"vbox",padding:0,widths:["70%","5%","25%"],children:[{type:"html",html:"<span>"+b.highlight+'</span><div id="'+D+'" style="border: 1px solid; height: 74px; width: 74px;"></div><div id="'+_+'">&nbsp;</div><span>'+b.selected+'</span><div id="'+E+'" style="border: 1px solid; height: 20px; width: 74px;"></div>'},{type:"text",label:b.selected,labelStyle:"display:none",id:"selectedColor",style:"width: 76px;margin-top:4px",onChange:function(){try{v.getById(E).setStyle("background-color",this.getValue())}catch(e){t()}}},k,{type:"button",id:"clear",label:b.clear,onClick:t}]}]}]}]}});