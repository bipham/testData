function addMessageDemo(i){var e=$("<li class='list-group-item'></li>");console.log(i),e.html(i.message),$("#messages").append(e)}function notifyMe(i){if("Notification"in window)if("granted"===Notification.permission){var e={body:i.message,icon:"/imgs/original/logo.jpg",dir:"ltr"};new Notification(i.title,e)}else"denied"!==Notification.permission&&Notification.requestPermission(function(e){if("permission"in Notification||(Notification.permission=e),"granted"===e){var o={body:i.message,icon:"/imgs/original/logo.jpg",dir:"ltr"};new Notification(i.title,o)}});else alert("This browser does not support desktop notification")}var baseUrl=document.location.origin,user_id=current_user_id,public_connect=baseUrl+":8890?user_id="+user_id,socket_public=io.connect(public_connect);socket_public.emit("updateSocket",user_id),socket_public.on("insert-new-comment",function(i){insertNewComment(current_user_id,current_level_user,i.comment.id,i.comment.private,i.avatar,i.comment.content_cmt,"Just now",i.comment.question_custom_id,i.username,i.comment.reply_comment_id,i.comment.user_id)}),socket_public.on("comment-notication",function(i){notifyMe(i)});