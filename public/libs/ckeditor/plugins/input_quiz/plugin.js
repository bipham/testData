CKEDITOR.plugins.add("input_quiz",{icons:"input_quiz",init:function(i){i.on("selectionChange",function(t){0==in_question?i.getCommand("insertInputQuiz").setState(CKEDITOR.TRISTATE_OFF):i.getCommand("insertInputQuiz").setState(CKEDITOR.TRISTATE_DISABLED)}),i.addCommand("insertInputQuiz",new CKEDITOR.dialogCommand("input_quizDialog")),i.ui.addButton("input_quiz",{label:"Input text",command:"insertInputQuiz",toolbar:"others,3"}),CKEDITOR.dialog.add("input_quizDialog",this.path+"dialogs/input_quiz.js")}});