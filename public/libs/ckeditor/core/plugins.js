CKEDITOR.plugins=new CKEDITOR.resourceManager("plugins/","plugin"),CKEDITOR.plugins.load=CKEDITOR.tools.override(CKEDITOR.plugins.load,function(n){var i={};return function(l,o,s){var a={},t=function(l){n.call(this,l,function(n){CKEDITOR.tools.extend(a,n);var l=[];for(var e in n){var r=n[e],d=r&&r.requires;if(!i[e]){if(r.icons)for(var p=r.icons.split(","),g=p.length;g--;)CKEDITOR.skin.addIcon(p[g],r.path+"icons/"+(CKEDITOR.env.hidpi&&r.hidpi?"hidpi/":"")+p[g]+".png");i[e]=1}if(d){d.split&&(d=d.split(","));for(var c=0;c<d.length;c++)a[d[c]]||l.push(d[c])}}if(l.length)t.call(this,l);else{for(e in a)(r=a[e]).onLoad&&!r.onLoad._called&&(!1===r.onLoad()&&delete a[e],r.onLoad._called=1);o&&o.call(s||window,a)}},this)};t.call(this,l)}}),CKEDITOR.plugins.setLang=function(n,i,l){var o=this.get(n),s=o.langEntries||(o.langEntries={}),a=o.lang||(o.lang=[]);a.split&&(a=a.split(",")),-1==CKEDITOR.tools.indexOf(a,i)&&a.push(i),s[i]=l};