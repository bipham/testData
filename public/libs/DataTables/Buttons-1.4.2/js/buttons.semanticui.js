!function(t){"function"==typeof define&&define.amd?define(["jquery","datatables.net-se","datatables.net-buttons"],function(e){return t(e,window,document)}):"object"==typeof exports?module.exports=function(e,n){return e||(e=window),n&&n.fn.dataTable||(n=require("datatables.net-se")(e,n).$),n.fn.dataTable.Buttons||require("datatables.net-buttons")(e,n),t(n,e,e.document)}:t(jQuery,window,document)}(function(t,e,n,a){"use strict";var o=t.fn.dataTable;return t.extend(!0,o.Buttons.defaults,{dom:{container:{className:"dt-buttons ui basic buttons"},button:{tag:"button",className:"ui button"},collection:{tag:"div",className:"dt-button-collection ui basic vertical buttons"}}}),o.Buttons});