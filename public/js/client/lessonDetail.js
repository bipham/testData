function getAllAnswer(){$("#quiz-test-area .question-quiz").each(function(){var e=$(this).data("qnumber"),s=$(this).attr("name");if(s=s.match(/\d+/),$(this).hasClass("question-radio"))$(this).is(":checked")&&(""!=(t=$(this).val())?list_answer[e]=t:delete list_answer[e]);else if($(this).hasClass("question-checkbox"))$(this).is(":checked")&&(""!=(t=$(this).val())?e in list_answer?list_answer[e]+=" %26 "+t:list_answer[e]=t:delete list_answer[e]);else if($(this).hasClass("question-input"))""!=(t=$(this).val().trim())?list_answer[e]=t:delete list_answer[e];else if($(this).hasClass("question-select")){var t=$(this).val();""!=t?list_answer[e]=t:delete list_answer[e]}})}function submitReadingTest(){list_answer={},getAllAnswer(),0==Object.keys(list_answer).length&&(list_answer="emptyList"),type_lesson_id=$(".lesson-detail-page").data("type-lesson-id");var e=baseUrl+"/reading/"+level_lesson_id+"/getResultReadingLesson/"+type_lesson_id+"-"+lesson_id;$.ajax({type:"GET",url:e,dataType:"json",data:{list_answer:list_answer},success:function(e){location.href=baseUrl+"/reading/"+level_lesson_id+"/readingViewResultLesson/"+type_lesson_id+"-"+lesson_id+"?list_answer="+JSON.stringify(list_answer)+"&correct_answer="+JSON.stringify(e.correct_answer)+"&total_questions="+e.total_questions},error:function(e){console.log("Error:",e),bootbox.alert({message:"Error, please contact admin!",backdrop:!0})}})}function focusQuestion(e){$("#readingReviewQuizModal").modal("hide"),$("#readingReviewQuizModal").on("hidden.bs.modal",function(s){$(".right-panel-custom").animate({scrollTop:$(".question-"+e).offset().top-150},1),$(".question-"+e)[0].focus()})}function getAnsweredQuestionOverview(){var e=0,s=0;return $(".review-question-quiz").each(function(t){e+=1,$(this).find(".answered-question-review").hasClass("answered")&&(s+=1)}),s+"/"+e}$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('[name="_token"]').val()}});var baseUrl=document.location.origin,list_answer={},lesson_id=$("#lesson-content-area").data("lesson-id"),type_lesson_id=$(".lesson-detail-page").data("type-lesson-id"),level_lesson_id=$(".lesson-detail-page").data("level-lesson-id");$(".btn-submit-quiz").click(function(){submitReadingTest()}),$(".question-quiz").on("change",function(){var e=$(this).val(),s=$(this).attr("name").match(/\d+/);$(".answered-question-"+s).val(e),""!=$(".answered-question-"+s).val()?$(".answered-question-"+s).addClass("answered"):$(".answered-question-"+s).removeClass("answered")}),$(".question-quiz").on("keyup",function(){var e=$(this).val(),s=$(this).attr("name").match(/\d+/);$(".answered-question-"+s).val(e),""!=$(".answered-question-"+s).val()?$(".answered-question-"+s).addClass("answered"):$(".answered-question-"+s).removeClass("answered")}),$(".btn-submit-modal").click(function(){var e=getAnsweredQuestionOverview();$(".result-test").html(e)});