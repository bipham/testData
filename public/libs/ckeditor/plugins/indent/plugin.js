!function(){"use strict";function t(t,i){var a,o;i.on("refresh",function(t){var i=[e];for(var a in t.data.states)i.push(t.data.states[a]);this.setState(CKEDITOR.tools.search(i,n)?n:e)},i,null,100),i.on("exec",function(e){a=t.getSelection(),o=a.createBookmarks(1),e.data||(e.data={}),e.data.done=!1},i,null,0),i.on("exec",function(){t.forceNextSelectionCheck(),a.selectBookmarks(o)},i,null,100)}var e=CKEDITOR.TRISTATE_DISABLED,n=CKEDITOR.TRISTATE_OFF;CKEDITOR.plugins.add("indent",{lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"indent,indent-rtl,outdent,outdent-rtl",hidpi:!0,init:function(e){var n=CKEDITOR.plugins.indent.genericDefinition;t(e,e.addCommand("indent",new n(!0))),t(e,e.addCommand("outdent",new n)),e.ui.addButton&&(e.ui.addButton("Indent",{label:e.lang.indent.indent,command:"indent",directional:!0,toolbar:"indent,20"}),e.ui.addButton("Outdent",{label:e.lang.indent.outdent,command:"outdent",directional:!0,toolbar:"indent,10"})),e.on("dirChanged",function(t){var n=e.createRange(),i=t.data.node;n.setStartBefore(i),n.setEndAfter(i);for(var a,o=new CKEDITOR.dom.walker(n);a=o.next();)if(a.type==CKEDITOR.NODE_ELEMENT){if(!a.equals(i)&&a.getDirection()){n.setStartAfter(a),o=new CKEDITOR.dom.walker(n);continue}var r=e.config.indentClasses;if(r)for(var s="ltr"==t.data.dir?["_rtl",""]:["","_rtl"],d=0;d<r.length;d++)a.hasClass(r[d]+s[0])&&(a.removeClass(r[d]+s[0]),a.addClass(r[d]+s[1]));var l=a.getStyle("margin-right"),c=a.getStyle("margin-left");l?a.setStyle("margin-left",l):a.removeStyle("margin-left"),c?a.setStyle("margin-right",c):a.removeStyle("margin-right")}})}}),CKEDITOR.plugins.indent={genericDefinition:function(t){this.isIndent=!!t,this.startDisabled=!this.isIndent},specificDefinition:function(t,e,n){this.name=e,this.editor=t,this.jobs={},this.enterBr=t.config.enterMode==CKEDITOR.ENTER_BR,this.isIndent=!!n,this.relatedGlobal=n?"indent":"outdent",this.indentKey=n?9:CKEDITOR.SHIFT+9,this.database={}},registerCommands:function(t,e){t.on("pluginsLoaded",function(){for(var t in e)!function(t,e){var n=t.getCommand(e.relatedGlobal);for(var i in e.jobs)n.on("exec",function(n){n.data.done||(t.fire("lockSnapshot"),e.execJob(t,i)&&(n.data.done=!0),t.fire("unlockSnapshot"),CKEDITOR.dom.element.clearAllMarkers(e.database))},this,null,i),n.on("refresh",function(n){n.data.states||(n.data.states={}),n.data.states[e.name+"@"+i]=e.refreshJob(t,i,n.data.path)},this,null,i);t.addFeature(e)}(this,e[t])})}},CKEDITOR.plugins.indent.genericDefinition.prototype={context:"p",exec:function(){}},CKEDITOR.plugins.indent.specificDefinition.prototype={execJob:function(t,n){var i=this.jobs[n];if(i.state!=e)return i.exec.call(this,t)},refreshJob:function(t,n,i){var a=this.jobs[n];return t.activeFilter.checkFeature(this)?a.state=a.refresh.call(this,t,i):a.state=e,a.state},getContext:function(t){return t.contains(this.context)}}}();