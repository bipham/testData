!function(){function e(){return CKEDITOR.skinName.split(",")[0]}function t(){return CKEDITOR.getUrl(CKEDITOR.skinName.split(",")[1]||"skins/"+e()+"/")}function n(e){var n=CKEDITOR.skin["ua_"+e],i=CKEDITOR.env;if(n){n=n.split(",").sort(function(e,t){return e>t?-1:1});for(var o,r=0;r<n.length;r++)if(o=n[r],i.ie&&(o.replace(/^ie/,"")==i.version||i.quirks&&"iequirks"==o)&&(o="ie"),i[o]){e+="_"+n[r];break}}return CKEDITOR.getUrl(t()+e+".css")}function i(e,t){s[e]||(CKEDITOR.document.appendStyleSheet(n(e)),s[e]=1),t&&t()}function o(e){var t=e.getById(a);return t||((t=e.getHead().append("style")).setAttribute("id",a),t.setAttribute("type","text/css")),t}function r(e,t,n){var i,o,r;if(CKEDITOR.env.webkit)for(t=t.split("}").slice(0,-1),o=0;o<t.length;o++)t[o]=t[o].split("{");for(var s=0;s<e.length;s++)if(CKEDITOR.env.webkit)for(o=0;o<t.length;o++){for(r=t[o][1],i=0;i<n.length;i++)r=r.replace(n[i][0],n[i][1]);e[s].$.sheet.addRule(t[o][0],r)}else{for(r=t,i=0;i<n.length;i++)r=r.replace(n[i][0],n[i][1]);CKEDITOR.env.ie&&CKEDITOR.env.version<11?e[s].$.styleSheet.cssText+=r:e[s].$.innerHTML+=r}}var s={};CKEDITOR.skin={path:t,loadPart:function(n,o){CKEDITOR.skin.name!=e()?CKEDITOR.scriptLoader.load(CKEDITOR.getUrl(t()+"skin.js"),function(){i(n,o)}):i(n,o)},getPath:function(e){return CKEDITOR.getUrl(n(e))},icons:{},addIcon:function(e,t,n,i){e=e.toLowerCase(),this.icons[e]||(this.icons[e]={path:t,offset:n||0,bgsize:i||"16px"})},getIconStyle:function(e,t,n,i,o){var r,s,a,l;return e&&(e=e.toLowerCase(),t&&(r=this.icons[e+"-rtl"]),r||(r=this.icons[e])),s=n||r&&r.path||"",a=i||r&&r.offset,l=o||r&&r.bgsize||"16px",s&&(s=s.replace(/'/g,"\\'")),s&&"background-image:url('"+CKEDITOR.getUrl(s)+"');background-position:0 "+a+"px;background-size:"+l+";"}},CKEDITOR.tools.extend(CKEDITOR.editor.prototype,{getUiColor:function(){return this.uiColor},setUiColor:function(e){var t=o(CKEDITOR.document);return(this.setUiColor=function(e){this.uiColor=e;var n=CKEDITOR.skin.chameleon,i="",o="";"function"==typeof n&&(i=n(this,"editor"),o=n(this,"panel"));var s=[[c,e]];r([t],i,s),r(l,o,s)}).call(this,e)}});var a="cke_ui_color",l=[],c=/\$color/g;CKEDITOR.on("instanceLoaded",function(e){if(!CKEDITOR.env.ie||!CKEDITOR.env.quirks){var t=e.editor,n=function(e){var n=(e.data[0]||e.data).element.getElementsByTag("iframe").getItem(0).getFrameDocument();if(!n.getById("cke_ui_color")){var i=o(n);l.push(i);var s=t.getUiColor();s&&r([i],CKEDITOR.skin.chameleon(t,"panel"),[[c,s]])}};t.on("panelShow",n),t.on("menuShow",n),t.config.uiColor&&t.setUiColor(t.config.uiColor)}})}();