!function(){function e(e){for(var t,l=0,n=0,a=0,i=e.$.rows.length;a<i;a++){l=0;for(var o=0,r=(t=e.$.rows[a]).cells.length;o<r;o++)l+=t.cells[o].colSpan;l>n&&(n=l)}return n}function t(e){return function(){var t=this.getValue(),l=!!(CKEDITOR.dialog.validate.integer()(t)&&t>0);return l||(alert(e),this.select()),l}}function l(l,i){var o=function(e){return new CKEDITOR.dom.element(e,l.document)},r=l.editable(),s=l.plugins.dialogadvtab;return{title:l.lang.table.title,minWidth:310,minHeight:CKEDITOR.env.ie?310:280,onLoad:function(){var e=this,t=e.getContentElement("advanced","advStyles");t&&t.on("change",function(){var t=this.getStyle("width",""),l=e.getContentElement("info","txtWidth");l&&l.setValue(t,!0);var n=this.getStyle("height",""),a=e.getContentElement("info","txtHeight");a&&a.setValue(n,!0)})},onShow:function(){var e,t=l.getSelection(),n=t.getRanges(),a=this.getContentElement("info","txtRows"),o=this.getContentElement("info","txtCols"),r=this.getContentElement("info","txtWidth"),s=this.getContentElement("info","txtHeight");if("tableProperties"==i){var d=t.getSelectedElement();d&&d.is("table")?e=d:n.length>0&&(CKEDITOR.env.webkit&&n[0].shrink(CKEDITOR.NODE_ELEMENT),e=l.elementPath(n[0].getCommonAncestor(!0)).contains("table",1)),this._.selectedElement=e}e?(this.setupContent(e),a&&a.disable(),o&&o.disable()):(a&&a.enable(),o&&o.enable()),r&&r.onChange(),s&&s.onChange()},onOk:function(){var e=l.getSelection(),t=this._.selectedElement&&e.createBookmarks(),n=this._.selectedElement||o("table"),a={};if(this.commitContent(a,n),a.info){var i=a.info;if(!this._.selectedElement)for(var r=n.append(o("tbody")),s=parseInt(i.txtRows,10)||0,d=parseInt(i.txtCols,10)||0,g=0;g<s;g++)for(var h=r.append(o("tr")),m=0;m<d;m++)h.append(o("td")).appendBogus();var c=i.selHeaders;if(!n.$.tHead&&("row"==c||"both"==c)){var u=n.getElementsByTag("thead").getItem(0),b=(r=n.getElementsByTag("tbody").getItem(0)).getElementsByTag("tr").getItem(0);for(u||(u=new CKEDITOR.dom.element("thead")).insertBefore(r),g=0;g<b.getChildCount();g++){var p=b.getChild(g);p.type!=CKEDITOR.NODE_ELEMENT||p.data("cke-bookmark")||(p.renameNode("th"),p.setAttribute("scope","col"))}u.append(b.remove())}if(null!==n.$.tHead&&"row"!=c&&"both"!=c){u=new CKEDITOR.dom.element(n.$.tHead);for(var f=(r=n.getElementsByTag("tbody").getItem(0)).getFirst();u.getChildCount()>0;){for(b=u.getFirst(),g=0;g<b.getChildCount();g++){var v=b.getChild(g);v.type==CKEDITOR.NODE_ELEMENT&&(v.renameNode("td"),v.removeAttribute("scope"))}b.insertBefore(f)}u.remove()}if(!this.hasColumnHeaders&&("col"==c||"both"==c))for(h=0;h<n.$.rows.length;h++)(v=new CKEDITOR.dom.element(n.$.rows[h].cells[0])).renameNode("th"),v.setAttribute("scope","row");if(this.hasColumnHeaders&&"col"!=c&&"both"!=c)for(g=0;g<n.$.rows.length;g++)"tbody"==(h=new CKEDITOR.dom.element(n.$.rows[g])).getParent().getName()&&((v=new CKEDITOR.dom.element(h.$.cells[0])).renameNode("td"),v.removeAttribute("scope"));i.txtHeight?n.setStyle("height",i.txtHeight):n.removeStyle("height"),i.txtWidth?n.setStyle("width",i.txtWidth):n.removeStyle("width"),n.getAttribute("style")||n.removeAttribute("style")}if(this._.selectedElement)try{e.selectBookmarks(t)}catch(e){}else l.insertElement(n),setTimeout(function(){var e=new CKEDITOR.dom.element(n.$.rows[0].cells[0]),t=l.createRange();t.moveToPosition(e,CKEDITOR.POSITION_AFTER_START),t.select()},0)},contents:[{id:"info",label:l.lang.table.title,elements:[{type:"hbox",widths:[null,null],styles:["vertical-align:top"],children:[{type:"vbox",padding:0,children:[{type:"text",id:"txtRows",default:3,label:l.lang.table.rows,required:!0,controlStyle:"width:5em",validate:t(l.lang.table.invalidRows),setup:function(e){this.setValue(e.$.rows.length)},commit:a},{type:"text",id:"txtCols",default:2,label:l.lang.table.columns,required:!0,controlStyle:"width:5em",validate:t(l.lang.table.invalidCols),setup:function(t){this.setValue(e(t))},commit:a},{type:"html",html:"&nbsp;"},{type:"select",id:"selHeaders",requiredContent:"th",default:"",label:l.lang.table.headers,items:[[l.lang.table.headersNone,""],[l.lang.table.headersRow,"row"],[l.lang.table.headersColumn,"col"],[l.lang.table.headersBoth,"both"]],setup:function(e){var t=this.getDialog();t.hasColumnHeaders=!0;for(var l=0;l<e.$.rows.length;l++){var n=e.$.rows[l].cells[0];if(n&&"th"!=n.nodeName.toLowerCase()){t.hasColumnHeaders=!1;break}}null!==e.$.tHead?this.setValue(t.hasColumnHeaders?"both":"row"):this.setValue(t.hasColumnHeaders?"col":"")},commit:a},{type:"text",id:"txtBorder",requiredContent:"table[border]",default:l.filter.check("table[border]")?1:0,label:l.lang.table.border,controlStyle:"width:3em",validate:CKEDITOR.dialog.validate.number(l.lang.table.invalidBorder),setup:function(e){this.setValue(e.getAttribute("border")||"")},commit:function(e,t){this.getValue()?t.setAttribute("border",this.getValue()):t.removeAttribute("border")}},{id:"cmbAlign",type:"select",requiredContent:"table[align]",default:"",label:l.lang.common.align,items:[[l.lang.common.notSet,""],[l.lang.common.alignLeft,"left"],[l.lang.common.alignCenter,"center"],[l.lang.common.alignRight,"right"]],setup:function(e){this.setValue(e.getAttribute("align")||"")},commit:function(e,t){this.getValue()?t.setAttribute("align",this.getValue()):t.removeAttribute("align")}}]},{type:"vbox",padding:0,children:[{type:"hbox",widths:["5em"],children:[{type:"text",id:"txtWidth",requiredContent:"table{width}",controlStyle:"width:5em",label:l.lang.common.width,title:l.lang.common.cssLengthTooltip,default:l.filter.check("table{width}")?r.getSize("width")<500?"100%":500:0,getValue:n,validate:CKEDITOR.dialog.validate.cssLength(l.lang.common.invalidCssLength.replace("%1",l.lang.common.width)),onChange:function(){var e=this.getDialog().getContentElement("advanced","advStyles");e&&e.updateStyle("width",this.getValue())},setup:function(e){var t=e.getStyle("width");this.setValue(t)},commit:a}]},{type:"hbox",widths:["5em"],children:[{type:"text",id:"txtHeight",requiredContent:"table{height}",controlStyle:"width:5em",label:l.lang.common.height,title:l.lang.common.cssLengthTooltip,default:"",getValue:n,validate:CKEDITOR.dialog.validate.cssLength(l.lang.common.invalidCssLength.replace("%1",l.lang.common.height)),onChange:function(){var e=this.getDialog().getContentElement("advanced","advStyles");e&&e.updateStyle("height",this.getValue())},setup:function(e){var t=e.getStyle("height");t&&this.setValue(t)},commit:a}]},{type:"html",html:"&nbsp;"},{type:"text",id:"txtCellSpace",requiredContent:"table[cellspacing]",controlStyle:"width:3em",label:l.lang.table.cellSpace,default:l.filter.check("table[cellspacing]")?1:0,validate:CKEDITOR.dialog.validate.number(l.lang.table.invalidCellSpacing),setup:function(e){this.setValue(e.getAttribute("cellSpacing")||"")},commit:function(e,t){this.getValue()?t.setAttribute("cellSpacing",this.getValue()):t.removeAttribute("cellSpacing")}},{type:"text",id:"txtCellPad",requiredContent:"table[cellpadding]",controlStyle:"width:3em",label:l.lang.table.cellPad,default:l.filter.check("table[cellpadding]")?1:0,validate:CKEDITOR.dialog.validate.number(l.lang.table.invalidCellPadding),setup:function(e){this.setValue(e.getAttribute("cellPadding")||"")},commit:function(e,t){this.getValue()?t.setAttribute("cellPadding",this.getValue()):t.removeAttribute("cellPadding")}}]}]},{type:"html",align:"right",html:""},{type:"vbox",padding:0,children:[{type:"text",id:"txtCaption",requiredContent:"caption",label:l.lang.table.caption,setup:function(e){this.enable();var t=e.getElementsByTag("caption");if(t.count()>0){var l=t.getItem(0),n=l.getFirst(CKEDITOR.dom.walker.nodeType(CKEDITOR.NODE_ELEMENT));if(n&&!n.equals(l.getBogus()))return this.disable(),void this.setValue(l.getText());l=CKEDITOR.tools.trim(l.getText()),this.setValue(l)}},commit:function(e,t){if(this.isEnabled()){var n=this.getValue(),a=t.getElementsByTag("caption");if(n)a.count()>0?(a=a.getItem(0)).setHtml(""):(a=new CKEDITOR.dom.element("caption",l.document),t.append(a,!0)),a.append(new CKEDITOR.dom.text(n,l.document));else if(a.count()>0)for(var i=a.count()-1;i>=0;i--)a.getItem(i).remove()}}},{type:"text",id:"txtSummary",bidi:!0,requiredContent:"table[summary]",label:l.lang.table.summary,setup:function(e){this.setValue(e.getAttribute("summary")||"")},commit:function(e,t){this.getValue()?t.setAttribute("summary",this.getValue()):t.removeAttribute("summary")}}]}]},s&&s.createAdvancedTab(l,null,"table")]}}var n=CKEDITOR.tools.cssLength,a=function(e){var t=this.id;e.info||(e.info={}),e.info[t]=this.getValue()};CKEDITOR.dialog.add("table",function(e){return l(e,"table")}),CKEDITOR.dialog.add("tableProperties",function(e){return l(e,"tableProperties")})}();