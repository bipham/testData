CKEDITOR.plugins.add("select_quiz",{icons:"select_quiz",init:function(e){e.on("selectionChange",function(t){0==in_question?e.getCommand("insertSelectQuiz").setState(CKEDITOR.TRISTATE_OFF):e.getCommand("insertSelectQuiz").setState(CKEDITOR.TRISTATE_DISABLED)}),e.addCommand("insertSelectQuiz",new CKEDITOR.dialogCommand("select_quizDialog")),e.ui.addButton("select_quiz",{label:"Select choice",command:"insertSelectQuiz",toolbar:"others,2"}),CKEDITOR.dialog.add("select_quizDialog",this.path+"dialogs/select_quiz.js")}});