"unloaded"==CKEDITOR.status&&(CKEDITOR.event.implementOn(CKEDITOR),CKEDITOR.loadFullCore=function(){if("basic_ready"==CKEDITOR.status){delete CKEDITOR.loadFullCore;var e=document.createElement("script");e.type="text/javascript",e.src=CKEDITOR.basePath+"ckeditor.js",e.src=CKEDITOR.basePath+"ckeditor_source.js",document.getElementsByTagName("head")[0].appendChild(e)}else CKEDITOR.loadFullCore._load=1},CKEDITOR.loadFullCoreTimeout=0,CKEDITOR.add=function(e){(this._.pending||(this._.pending=[])).push(e)},CKEDITOR.domReady(function(){var e=CKEDITOR.loadFullCore,a=CKEDITOR.loadFullCoreTimeout;e&&(CKEDITOR.status="basic_ready",e&&e._load?e():a&&setTimeout(function(){CKEDITOR.loadFullCore&&CKEDITOR.loadFullCore()},1e3*a))}),CKEDITOR.status="basic_loaded");