CKEDITOR.dialog.add("input_quizDialog",function(t){return{title:"Input Quiz Properties",minWidth:400,minHeight:200,contents:[{id:"tab-basic",label:"Basic Settings",elements:[{type:"text",id:"question",label:"Question number",validate:CKEDITOR.dialog.validate.notEmpty("Question number field cannot be empty.")}]}],onShow:function(){this.setValueOf("tab-basic","question",question_number_input)},onOk:function(){var e=this,n=$(".upload-page-custom").data("idquestion"),i=e.getValueOf("tab-basic","question");question_number_input=parseInt(i)+1;var a='<span class="label-input key-label"><strong>'+i+'</strong></span> <input type="text" class="question-quiz question-input question-'+i+' last-option" name="question-'+i+'" data-qnumber="'+n+'"/>';n++,$(".upload-page-custom").data("idquestion",n),t.insertHtml(a)}}});