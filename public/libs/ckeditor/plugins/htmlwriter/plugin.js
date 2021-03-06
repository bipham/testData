CKEDITOR.plugins.add("htmlwriter",{init:function(t){var e=new CKEDITOR.htmlWriter;e.forceSimpleAmpersand=t.config.forceSimpleAmpersand,e.indentationChars=t.config.dataIndentationChars||"\t",t.dataProcessor.writer=e}}),CKEDITOR.htmlWriter=CKEDITOR.tools.createClass({base:CKEDITOR.htmlParser.basicWriter,$:function(){this.base(),this.indentationChars="\t",this.selfClosingEnd=" />",this.lineBreakChars="\n",this.sortAttributes=1,this._.indent=0,this._.indentation="",this._.inPre=0,this._.rules={};var t=CKEDITOR.dtd;for(var e in CKEDITOR.tools.extend({},t.$nonBodyContent,t.$block,t.$listItem,t.$tableContent))this.setRules(e,{indent:!t[e]["#"],breakBeforeOpen:1,breakBeforeClose:!t[e]["#"],breakAfterClose:1,needsSpace:e in t.$block&&!(e in{li:1,dt:1,dd:1})});this.setRules("br",{breakAfterOpen:1}),this.setRules("title",{indent:0,breakAfterOpen:0}),this.setRules("style",{indent:0,breakBeforeClose:1}),this.setRules("pre",{breakAfterOpen:1,indent:0})},proto:{openTag:function(t){var e=this._.rules[t];this._.afterCloser&&e&&e.needsSpace&&this._.needsSpace&&this._.output.push("\n"),this._.indent?this.indentation():e&&e.breakBeforeOpen&&(this.lineBreak(),this.indentation()),this._.output.push("<",t),this._.afterCloser=0},openTagClose:function(t,e){var i=this._.rules[t];e?(this._.output.push(this.selfClosingEnd),i&&i.breakAfterClose&&(this._.needsSpace=i.needsSpace)):(this._.output.push(">"),i&&i.indent&&(this._.indentation+=this.indentationChars)),i&&i.breakAfterOpen&&this.lineBreak(),"pre"==t&&(this._.inPre=1)},attribute:function(t,e){"string"==typeof e&&(this.forceSimpleAmpersand&&(e=e.replace(/&amp;/g,"&")),e=CKEDITOR.tools.htmlEncodeAttr(e)),this._.output.push(" ",t,'="',e,'"')},closeTag:function(t){var e=this._.rules[t];e&&e.indent&&(this._.indentation=this._.indentation.substr(this.indentationChars.length)),this._.indent?this.indentation():e&&e.breakBeforeClose&&(this.lineBreak(),this.indentation()),this._.output.push("</",t,">"),"pre"==t&&(this._.inPre=0),e&&e.breakAfterClose&&(this.lineBreak(),this._.needsSpace=e.needsSpace),this._.afterCloser=1},text:function(t){this._.indent&&(this.indentation(),!this._.inPre&&(t=CKEDITOR.tools.ltrim(t))),this._.output.push(t)},comment:function(t){this._.indent&&this.indentation(),this._.output.push("\x3c!--",t,"--\x3e")},lineBreak:function(){!this._.inPre&&this._.output.length>0&&this._.output.push(this.lineBreakChars),this._.indent=1},indentation:function(){!this._.inPre&&this._.indentation&&this._.output.push(this._.indentation),this._.indent=0},reset:function(){this._.output=[],this._.indent=0,this._.indentation="",this._.afterCloser=0,this._.inPre=0,this._.needsSpace=0},setRules:function(t,e){var i=this._.rules[t];i?CKEDITOR.tools.extend(i,e,!0):this._.rules[t]=e}}});