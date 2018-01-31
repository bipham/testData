!function(t){"function"==typeof define&&define.amd?define(["jquery","datatables.net"],function(e){return t(e,window,document)}):"object"==typeof exports?module.exports=function(e,o){return e||(e=window),o&&o.fn.dataTable||(o=require("datatables.net")(e,o).$),t(o,e,e.document)}:t(jQuery,window,document)}(function(t,e,o,i){"use strict";var n=t.fn.dataTable,l=0,s=function(e,o){if(!n.versionCheck||!n.versionCheck("1.10.8"))throw"Warning: AutoFill requires DataTables 1.10.8 or greater";this.c=t.extend(!0,{},n.defaults.autoFill,s.defaults,o),this.s={dt:new n.Api(e),namespace:".autoFill"+l++,scroll:{},scrollInterval:null,handle:{height:0,width:0},enabled:!1},this.dom={handle:t('<div class="dt-autofill-handle"/>'),select:{top:t('<div class="dt-autofill-select top"/>'),right:t('<div class="dt-autofill-select right"/>'),bottom:t('<div class="dt-autofill-select bottom"/>'),left:t('<div class="dt-autofill-select left"/>')},background:t('<div class="dt-autofill-background"/>'),list:t('<div class="dt-autofill-list">'+this.s.dt.i18n("autoFill.info","")+"<ul/></div>"),dtScroll:null,offsetParent:null},this._constructor()};t.extend(s.prototype,{enabled:function(){return this.s.enabled},enable:function(t){var e=this;return!1===t?this.disable():(this.s.enabled=!0,this._focusListener(),this.dom.handle.on("mousedown",function(t){return e._mousedown(t),!1}),this)},disable:function(){return this.s.enabled=!1,this._focusListenerRemove(),this},_constructor:function(){var e=this,o=this.s.dt,i=t("div.dataTables_scrollBody",this.s.dt.table().container());o.settings()[0].autoFill=this,i.length&&(this.dom.dtScroll=i,"static"===i.css("position")&&i.css("position","relative")),!1!==this.c.enable&&this.enable(),o.on("destroy.autoFill",function(){e._focusListenerRemove()})},_attach:function(e){var o=this.s.dt,i=o.cell(e).index(),n=this.dom.handle,l=this.s.handle;if(i&&-1!==o.columns(this.c.columns).indexes().indexOf(i.column)){this.dom.offsetParent||(this.dom.offsetParent=t(o.table().node()).offsetParent()),l.height&&l.width||(n.appendTo("body"),l.height=n.outerHeight(),l.width=n.outerWidth());var s=this._getPosition(e,this.dom.offsetParent);this.dom.attachedTo=e,n.css({top:s.top+e.offsetHeight-l.height,left:s.left+e.offsetWidth-l.width}).appendTo(this.dom.offsetParent)}else this._detach()},_actionSelector:function(e){var o=this,i=this.s.dt,n=s.actions,l=[];if(t.each(n,function(t,o){o.available(i,e)&&l.push(t)}),1===l.length&&!1===this.c.alwaysAsk){var a=n[l[0]].execute(i,e);this._update(a,e)}else{var r=this.dom.list.children("ul").empty();l.push("cancel"),t.each(l,function(l,a){r.append(t("<li/>").append('<div class="dt-autofill-question">'+n[a].option(i,e)+"<div>").append(t('<div class="dt-autofill-button">').append(t('<button class="'+s.classes.btn+'">'+i.i18n("autoFill.button","&gt;")+"</button>").on("click",function(){var l=n[a].execute(i,e,t(this).closest("li"));o._update(l,e),o.dom.background.remove(),o.dom.list.remove()}))))}),this.dom.background.appendTo("body"),this.dom.list.appendTo("body"),this.dom.list.css("margin-top",this.dom.list.outerHeight()/2*-1)}},_detach:function(){this.dom.attachedTo=null,this.dom.handle.detach()},_drawSelection:function(e,o){var i=this.s.dt,n=this.s.start,l=t(this.dom.start),s=t(e),a={row:i.rows({page:"current"}).nodes().indexOf(s.parent()[0]),column:s.index()},r=i.column.index("toData",a.column);if(i.cell(s).any()&&-1!==i.columns(this.c.columns).indexes().indexOf(r)){this.s.end=a;var d,u,c,h,f,m;d=n.row<a.row?l:s,u=n.row<a.row?s:l,c=n.column<a.column?l:s,h=n.column<a.column?s:l,d=this._getPosition(d).top,c=this._getPosition(c).left,f=this._getPosition(u).top+u.outerHeight()-d,m=this._getPosition(h).left+h.outerWidth()-c;var p=this.dom.select;p.top.css({top:d,left:c,width:m}),p.left.css({top:d,left:c,height:f}),p.bottom.css({top:d+f,left:c,width:m}),p.right.css({top:d,left:c+m,height:f})}},_editor:function(t){var e=this.s.dt,o=this.c.editor;if(o){for(var n={},l=[],s=o.fields(),a=0,r=t.length;a<r;a++)for(var d=0,u=t[a].length;d<u;d++){var c=t[a][d],h=e.settings()[0].aoColumns[c.index.column],f=h.editField;if(f===i)for(var m=h.mData,p=0,v=s.length;p<v;p++){var b=o.field(s[p]);if(b.dataSrc()===m){f=b.name();break}}if(!f)throw"Could not automatically determine field data. Please see https://datatables.net/tn/11";n[f]||(n[f]={});var g=e.row(c.index.row).id();n[f][g]=c.set,l.push(c.index)}o.bubble(l,!1).multiSet(n).submit()}},_emitEvent:function(e,o){this.s.dt.iterator("table",function(i,n){t(i.nTable).triggerHandler(e+".dt",o)})},_focusListener:function(){var e=this,i=this.s.dt,n=this.s.namespace,l=null!==this.c.focus?this.c.focus:i.init().keys||i.settings()[0].keytable?"focus":"hover";"focus"===l?i.on("key-focus.autoFill",function(t,o,i){e._attach(i.node())}).on("key-blur.autoFill",function(t,o,i){e._detach()}):"click"===l?(t(i.table().body()).on("click"+n,"td, th",function(t){e._attach(this)}),t(o.body).on("click"+n,function(o){t(o.target).parents().filter(i.table().body()).length||e._detach()})):t(i.table().body()).on("mouseenter"+n,"td, th",function(t){e._attach(this)}).on("mouseleave"+n,function(o){t(o.relatedTarget).hasClass("dt-autofill-handle")||e._detach()})},_focusListenerRemove:function(){var e=this.s.dt;e.off(".autoFill"),t(e.table().body()).off(this.s.namespace),t(o.body).off(this.s.namespace)},_getPosition:function(e,o){var i,n,l=t(e),s=0,a=0;o||(o=t(this.s.dt.table().node()).offsetParent());do{if(n=l.position(),i=l.offsetParent(),s+=n.top+i.scrollTop(),a+=n.left+i.scrollLeft(),"body"===l.get(0).nodeName.toLowerCase())break;l=i}while(i.get(0)!==o.get(0));return{top:s,left:a}},_mousedown:function(i){var n=this,l=this.s.dt;this.dom.start=this.dom.attachedTo,this.s.start={row:l.rows({page:"current"}).nodes().indexOf(t(this.dom.start).parent()[0]),column:t(this.dom.start).index()},t(o.body).on("mousemove.autoFill",function(t){n._mousemove(t)}).on("mouseup.autoFill",function(t){n._mouseup(t)});var s=this.dom.select,a=t(l.table().node()).offsetParent();s.top.appendTo(a),s.left.appendTo(a),s.right.appendTo(a),s.bottom.appendTo(a),this._drawSelection(this.dom.start,i),this.dom.handle.css("display","none");var r=this.dom.dtScroll;this.s.scroll={windowHeight:t(e).height(),windowWidth:t(e).width(),dtTop:r?r.offset().top:null,dtLeft:r?r.offset().left:null,dtHeight:r?r.outerHeight():null,dtWidth:r?r.outerWidth():null}},_mousemove:function(t){this.s.dt;var e=t.target.nodeName.toLowerCase();"td"!==e&&"th"!==e||(this._drawSelection(t.target,t),this._shiftScroll(t))},_mouseup:function(e){t(o.body).off(".autoFill");var n=this.s.dt,l=this.dom.select;l.top.remove(),l.left.remove(),l.right.remove(),l.bottom.remove(),this.dom.handle.css("display","block");var s=this.s.start,a=this.s.end;if(s.row!==a.row||s.column!==a.column){for(var r=this._range(s.row,a.row),d=this._range(s.column,a.column),u=[],c=n.settings()[0],h=c.aoColumns,f=0;f<r.length;f++)u.push(t.map(d,function(t){var e=n.cell(":eq("+r[f]+")",t+":visible",{page:"current"}),o=e.data(),l=e.index(),s=h[l.column].editField;return s!==i&&(o=c.oApi._fnGetObjectDataFn(s)(n.row(l.row).data())),{cell:e,data:o,label:e.data(),index:l}}));this._actionSelector(u),clearInterval(this.s.scrollInterval),this.s.scrollInterval=null}},_range:function(t,e){var o,i=[];if(t<=e)for(o=t;o<=e;o++)i.push(o);else for(o=t;o>=e;o--)i.push(o);return i},_shiftScroll:function(t){var e,i,n,l,s=this,a=(this.s.dt,this.s.scroll),r=!1,d=t.pageY-o.body.scrollTop,u=t.pageX-o.body.scrollLeft;d<65?e=-5:d>a.windowHeight-65&&(e=5),u<65?i=-5:u>a.windowWidth-65&&(i=5),null!==a.dtTop&&t.pageY<a.dtTop+65?n=-5:null!==a.dtTop&&t.pageY>a.dtTop+a.dtHeight-65&&(n=5),null!==a.dtLeft&&t.pageX<a.dtLeft+65?l=-5:null!==a.dtLeft&&t.pageX>a.dtLeft+a.dtWidth-65&&(l=5),e||i||n||l?(a.windowVert=e,a.windowHoriz=i,a.dtVert=n,a.dtHoriz=l,r=!0):this.s.scrollInterval&&(clearInterval(this.s.scrollInterval),this.s.scrollInterval=null),!this.s.scrollInterval&&r&&(this.s.scrollInterval=setInterval(function(){if(a.windowVert&&(o.body.scrollTop+=a.windowVert),a.windowHoriz&&(o.body.scrollLeft+=a.windowHoriz),a.dtVert||a.dtHoriz){var t=s.dom.dtScroll[0];a.dtVert&&(t.scrollTop+=a.dtVert),a.dtHoriz&&(t.scrollLeft+=a.dtHoriz)}},20))},_update:function(t,e){if(!1!==t){var o,i=this.s.dt;if(this._emitEvent("preAutoFill",[i,e]),this._editor(e),null!==this.c.update?this.c.update:!this.c.editor){for(var n=0,l=e.length;n<l;n++)for(var s=0,a=e[n].length;s<a;s++)(o=e[n][s]).cell.data(o.set);i.draw(!1)}this._emitEvent("autoFill",[i,e])}}}),s.actions={increment:{available:function(e,o){return t.isNumeric(o[0][0].label)},option:function(t,e){return t.i18n("autoFill.increment",'Increment / decrement each cell by: <input type="number" value="1">')},execute:function(e,o,i){for(var n=1*o[0][0].data,l=1*t("input",i).val(),s=0,a=o.length;s<a;s++)for(var r=0,d=o[s].length;r<d;r++)o[s][r].set=n,n+=l}},fill:{available:function(t,e){return!0},option:function(t,e){return t.i18n("autoFill.fill","Fill all cells with <i>"+e[0][0].label+"</i>")},execute:function(t,e,o){for(var i=e[0][0].data,n=0,l=e.length;n<l;n++)for(var s=0,a=e[n].length;s<a;s++)e[n][s].set=i}},fillHorizontal:{available:function(t,e){return e.length>1&&e[0].length>1},option:function(t,e){return t.i18n("autoFill.fillHorizontal","Fill cells horizontally")},execute:function(t,e,o){for(var i=0,n=e.length;i<n;i++)for(var l=0,s=e[i].length;l<s;l++)e[i][l].set=e[i][0].data}},fillVertical:{available:function(t,e){return e.length>1&&e[0].length>1},option:function(t,e){return t.i18n("autoFill.fillVertical","Fill cells vertically")},execute:function(t,e,o){for(var i=0,n=e.length;i<n;i++)for(var l=0,s=e[i].length;l<s;l++)e[i][l].set=e[0][l].data}},cancel:{available:function(){return!1},option:function(t){return t.i18n("autoFill.cancel","Cancel")},execute:function(){return!1}}},s.version="2.2.2",s.defaults={alwaysAsk:!1,focus:null,columns:"",enable:!0,update:null,editor:null},s.classes={btn:"btn"};var a=t.fn.dataTable.Api;return a.register("autoFill()",function(){return this}),a.register("autoFill().enabled()",function(){var t=this.context[0];return!!t.autoFill&&t.autoFill.enabled()}),a.register("autoFill().enable()",function(t){return this.iterator("table",function(e){e.autoFill&&e.autoFill.enable(t)})}),a.register("autoFill().disable()",function(){return this.iterator("table",function(t){t.autoFill&&t.autoFill.disable()})}),t(o).on("preInit.dt.autofill",function(e,o,i){if("dt"===e.namespace){var l=o.oInit.autoFill,a=n.defaults.autoFill;if(l||a){var r=t.extend({},l,a);!1!==l&&new s(o,r)}}}),n.AutoFill=s,n.AutoFill=s,s});