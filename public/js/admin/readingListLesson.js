function deleteReadingLesson(e,a){bootbox.confirm({title:"Delete Reading Lesson",message:"Do you want to delete this lesson?",buttons:{cancel:{label:'<i class="fa fa-times"></i> Cancel',className:"btn-danger"},confirm:{label:'<i class="fa fa-check"></i> Confirm',className:"btn-success"}},callback:function(i){if(i){var s=baseUrl+"/deleteLessonReading/"+e+"-"+a;$.ajax({type:"GET",url:s,dataType:"json",success:function(a){bootbox.alert({message:"Delete lesson success!",backdrop:!0,callback:function(){location.href=baseUrl+"/managerReadingLesson/"+e}})},error:function(e){bootbox.alert({message:"Delete lesson fail!",backdrop:!0})}})}}})}function readURL(e){var a=e.dataset.id;if(img_name=$("input#imgFeature"+a+"[type=file]").val().split("\\").pop(),img_extension=img_name.substr(img_name.lastIndexOf(".")+1).toLowerCase(),-1==["png","jpg","jpeg","gif"].indexOf(img_extension))return bootbox.alert({message:"Img not true format!",backdrop:!0}),$("input#imgFeature"+a+"[type=file]").val(""),img_name="",$("#image-main-preview-"+a).attr("src","#"),$("#image-main-preview-"+a).addClass("hidden-class"),void i++;if(img_name=$("input#imgFeature"+a+"[type=file]").val().split("\\").pop(),e.files&&e.files[0]){var s=new FileReader;s.onload=function(e){$("#image-main-preview-"+a).attr("src",e.target.result).width(150),img_url=e.target.result,$("#image-main-preview-"+a).removeClass("hidden-class")},s.readAsDataURL(e.files[0])}}var baseUrl=document.location.origin,ajaxUpdateInfoBasic=baseUrl+"/updateInfoBasicReadingLesson/",img_url="",img_name="",img_extension="";$(document).ready(function(){$(".btn-save-info-basic").click(function(){var e=$(this).parents(".modal").data("id"),a=$("#titleLesson"+e).val(),i=$("#list-level-"+e).val();console.log(i);var s=ajaxUpdateInfoBasic+e;$.ajax({type:"POST",url:s,dataType:"json",data:{img_url:img_url,img_name:img_name,title_lesson:a,level_id:i},success:function(e){bootbox.alert({message:"Update info basic success! "+e.result,backdrop:!0,callback:function(){location.href=baseUrl+"/listReadingLesson"}})},error:function(e){bootbox.alert({message:"Update info basic  fdf",backdrop:!0})}})})});