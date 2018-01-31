CKEDITOR.resourceManager=function(e,t){this.basePath=e,this.fileName=t,this.registered={},this.loaded={},this.externals={},this._={waitingList:{}}},CKEDITOR.resourceManager.prototype={add:function(e,t){if(this.registered[e])throw new Error('[CKEDITOR.resourceManager.add] The resource name "'+e+'" is already registered.');var r=this.registered[e]=t||{};return r.name=e,r.path=this.getPath(e),CKEDITOR.fire(e+CKEDITOR.tools.capitalize(this.fileName)+"Ready",r),this.get(e)},get:function(e){return this.registered[e]||null},getPath:function(e){var t=this.externals[e];return CKEDITOR.getUrl(t&&t.dir||this.basePath+e+"/")},getFilePath:function(e){var t=this.externals[e];return CKEDITOR.getUrl(this.getPath(e)+(t?t.file:this.fileName+".js"))},addExternal:function(e,t,r){e=e.split(",");for(var i=0;i<e.length;i++){var a=e[i];r||(t=t.replace(/[^\/]+$/,function(e){return r=e,""})),this.externals[a]={dir:t,file:r||this.fileName+".js"}}},load:function(e,t,r){CKEDITOR.tools.isArray(e)||(e=e?[e]:[]);for(var i=this.loaded,a=this.registered,s=[],n={},h={},o=0;o<e.length;o++){var l=e[o];if(l)if(i[l]||a[l])h[l]=this.get(l);else{var g=this.getFilePath(l);s.push(g),g in n||(n[g]=[]),n[g].push(l)}}CKEDITOR.scriptLoader.load(s,function(e,a){if(a.length)throw new Error('[CKEDITOR.resourceManager.load] Resource name "'+n[a[0]].join(",")+'" was not found at "'+a[0]+'".');for(var s=0;s<e.length;s++)for(var o=n[e[s]],l=0;l<o.length;l++){var g=o[l];h[g]=this.get(g),i[g]=1}t.call(r,h)},this)}};