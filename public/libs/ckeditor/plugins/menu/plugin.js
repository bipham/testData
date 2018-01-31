CKEDITOR.plugins.add("menu",{requires:"floatpanel",beforeInit:function(e){for(var t=e.config.menu_groups.split(","),i=e._.menuGroups={},n=e._.menuItems={},o=0;o<t.length;o++)i[t[o]]=o+1;e.addMenuGroup=function(e,t){i[e]=t||100},e.addMenuItem=function(e,t){i[t.group]&&(n[e]=new CKEDITOR.menuItem(this,e,t))},e.addMenuItems=function(e){for(var t in e)this.addMenuItem(t,e[t])},e.getMenuItem=function(e){return n[e]},e.removeMenuItem=function(e){delete n[e]}}}),function(){function e(e){e.sort(function(e,t){return e.group<t.group?-1:e.group>t.group?1:e.order<t.order?-1:e.order>t.order?1:0})}var t='<span class="cke_menuitem"><a id="{id}" class="cke_menubutton cke_menubutton__{name} cke_menubutton_{state} {cls}" href="{href}" title="{title}" tabindex="-1" _cke_focus=1 hidefocus="true" role="{role}" aria-label="{label}" aria-describedby="{id}_description" aria-haspopup="{hasPopup}" aria-disabled="{disabled}" {ariaChecked} draggable="false"';CKEDITOR.env.gecko&&CKEDITOR.env.mac&&(t+=' onkeypress="return false;"'),CKEDITOR.env.gecko&&(t+=' onblur="this.style.cssText = this.style.cssText;" ondragstart="return false;"'),t+=' onmouseover="CKEDITOR.tools.callFunction({hoverFn},{index});" onmouseout="CKEDITOR.tools.callFunction({moveOutFn},{index});" '+(CKEDITOR.env.ie?'onclick="return false;" onmouseup':"onclick")+'="CKEDITOR.tools.callFunction({clickFn},{index}); return false;">',t+='<span class="cke_menubutton_inner"><span class="cke_menubutton_icon"><span class="cke_button_icon cke_button__{iconName}_icon" style="{iconStyle}"></span></span><span class="cke_menubutton_label">{label}</span>{shortcutHtml}{arrowHtml}</span></a><span id="{id}_description" class="cke_voice_label" aria-hidden="false">{ariaShortcut}</span></span>';var i=CKEDITOR.addTemplate("menuItem",t),n=CKEDITOR.addTemplate("menuArrow",'<span class="cke_menuarrow"><span>{label}</span></span>'),o=CKEDITOR.addTemplate("menuShortcut",'<span class="cke_menubutton_label cke_menubutton_shortcut">{shortcut}</span>');CKEDITOR.menu=CKEDITOR.tools.createClass({$:function(e,t){t=this._.definition=t||{},this.id=CKEDITOR.tools.getNextId(),this.editor=e,this.items=[],this._.listeners=[],this._.level=t.level||1;var i=CKEDITOR.tools.extend({},t.panel,{css:[CKEDITOR.skin.getPath("editor")],level:this._.level-1,block:{}}),n=i.block.attributes=i.attributes||{};!n.role&&(n.role="menu"),this._.panelDefinition=i},_:{onShow:function(){var e=this.editor.getSelection(),t=e&&e.getStartElement(),i=this.editor.elementPath(),n=this._.listeners;this.removeAll();for(var o=0;o<n.length;o++){var s=n[o](t,e,i);if(s)for(var a in s){var l=this.editor.getMenuItem(a);!l||l.command&&!this.editor.getCommand(l.command).state||(l.state=s[a],this.add(l))}}},onClick:function(e){this.hide(),e.onClick?e.onClick():e.command&&this.editor.execCommand(e.command)},onEscape:function(e){var t=this.parent;return t?t._.panel.hideChild(1):27==e&&this.hide(1),!1},onHide:function(){this.onHide&&this.onHide()},showSubMenu:function(e){var t=this._.subMenu,i=this.items[e],n=i.getItems&&i.getItems();if(n){t?t.removeAll():((t=this._.subMenu=new CKEDITOR.menu(this.editor,CKEDITOR.tools.extend({},this._.definition,{level:this._.level+1},!0))).parent=this,t._.onClick=CKEDITOR.tools.bind(this._.onClick,this));for(var o in n){var s=this.editor.getMenuItem(o);s&&(s.state=n[o],t.add(s))}var a=this._.panel.getBlock(this.id).element.getDocument().getById(this.id+String(e));setTimeout(function(){t.show(a,2)},0)}else this._.panel.hideChild(1)}},proto:{add:function(e){e.order||(e.order=this.items.length),this.items.push(e)},removeAll:function(){this.items=[]},show:function(t,i,n,o){if(this.parent||(this._.onShow(),this.items.length)){i=i||("rtl"==this.editor.lang.dir?2:1);var s=this.items,a=this.editor,l=this._.panel,r=this._.element;if(!l){(l=this._.panel=new CKEDITOR.ui.floatPanel(this.editor,CKEDITOR.document.getBody(),this._.panelDefinition,this._.level)).onEscape=CKEDITOR.tools.bind(function(e){if(!1===this._.onEscape(e))return!1},this),l.onShow=function(){l._.panel.getHolderElement().getParent().addClass("cke").addClass("cke_reset_all")},l.onHide=CKEDITOR.tools.bind(function(){this._.onHide&&this._.onHide()},this);var u=l.addBlock(this.id,this._.panelDefinition.block);u.autoSize=!0;var h=u.keys;h[40]="next",h[9]="next",h[38]="prev",h[CKEDITOR.SHIFT+9]="prev",h["rtl"==a.lang.dir?37:39]=CKEDITOR.env.ie?"mouseup":"click",h[32]=CKEDITOR.env.ie?"mouseup":"click",CKEDITOR.env.ie&&(h[13]="mouseup");var c=(r=this._.element=u.element).getDocument();c.getBody().setStyle("overflow","hidden"),c.getElementsByTag("html").getItem(0).setStyle("overflow","hidden"),this._.itemOverFn=CKEDITOR.tools.addFunction(function(e){clearTimeout(this._.showSubTimeout),this._.showSubTimeout=CKEDITOR.tools.setTimeout(this._.showSubMenu,a.config.menu_subMenuDelay||400,this,[e])},this),this._.itemOutFn=CKEDITOR.tools.addFunction(function(){clearTimeout(this._.showSubTimeout)},this),this._.itemClickFn=CKEDITOR.tools.addFunction(function(e){var t=this.items[e];t.state!=CKEDITOR.TRISTATE_DISABLED?t.getItems?this._.showSubMenu(e):this._.onClick(t):this.hide(1)},this)}e(s);for(var d=a.elementPath(),m=['<div class="cke_menu'+(d&&d.direction()!=a.lang.dir?" cke_mixed_dir_content":"")+'" role="presentation">'],_=s.length,p=_&&s[0].group,T=0;T<_;T++){var f=s[T];p!=f.group&&(m.push('<div class="cke_menuseparator" role="separator"></div>'),p=f.group),f.render(this,T,m)}m.push("</div>"),r.setHtml(m.join("")),CKEDITOR.ui.fire("ready",this),this.parent?this.parent._.panel.showAsChild(l,this.id,t,i,n,o):l.showBlock(this.id,t,i,n,o),a.fire("menuShow",[l])}},addListener:function(e){this._.listeners.push(e)},hide:function(e){this._.onHide&&this._.onHide(),this._.panel&&this._.panel.hide(e)}}}),CKEDITOR.menuItem=CKEDITOR.tools.createClass({$:function(e,t,i){CKEDITOR.tools.extend(this,i,{order:0,className:"cke_menubutton__"+t}),this.group=e._.menuGroups[this.group],this.editor=e,this.name=t},proto:{render:function(e,t,s){var a,l,r,u=e.id+String(t),h=void 0===this.state?CKEDITOR.TRISTATE_OFF:this.state,c="",d=this.editor,m=h==CKEDITOR.TRISTATE_ON?"on":h==CKEDITOR.TRISTATE_DISABLED?"disabled":"off";this.role in{menuitemcheckbox:1,menuitemradio:1}&&(c=' aria-checked="'+(h==CKEDITOR.TRISTATE_ON?"true":"false")+'"');var _=this.getItems,p="&#"+("rtl"==this.editor.lang.dir?"9668":"9658")+";",T=this.name;this.icon&&!/\./.test(this.icon)&&(T=this.icon),this.command&&(l=d.getCommand(this.command),(a=d.getCommandKeystroke(l))&&(r=CKEDITOR.tools.keystrokeToString(d.lang.common.keyboard,a)));var f={id:u,name:this.name,iconName:T,label:this.label,cls:this.className||"",state:m,hasPopup:_?"true":"false",disabled:h==CKEDITOR.TRISTATE_DISABLED,title:this.label+(r?" ("+r.display+")":""),ariaShortcut:r?d.lang.common.keyboardShortcut+" "+r.aria:"",href:"javascript:void('"+(this.label||"").replace("'")+"')",hoverFn:e._.itemOverFn,moveOutFn:e._.itemOutFn,clickFn:e._.itemClickFn,index:t,iconStyle:CKEDITOR.skin.getIconStyle(T,"rtl"==this.editor.lang.dir,T==this.icon?null:this.icon,this.iconOffset),shortcutHtml:r?o.output({shortcut:r.display}):"",arrowHtml:_?n.output({label:p}):"",role:this.role?this.role:"menuitem",ariaChecked:c};i.output(f,s)}}})}(),CKEDITOR.config.menu_groups="clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,div";