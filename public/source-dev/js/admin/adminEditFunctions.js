/**
 * Created by BiPham on 10/13/2017.
 */
function updateTitleLesson(type_lesson, type_lesson_id, lesson_id) {
    var ajaxUpdateTitleLesson = baseUrl + '/updateTitleLesson/';
    ajaxUpdateTitleLesson += type_lesson_id + '-' + lesson_id;
    var title_lesson = $('#titleLesson' + type_lesson + '-' + lesson_id).val().trim();
    if (title_lesson !== '') {
        $.ajax({
            type: "POST",
            url: ajaxUpdateTitleLesson,
            dataType: "json",
            data: { title_lesson: title_lesson },
            success: function (data) {
                if (data.result === 'title-not-change') {
                    bootbox.alert({
                        message: "Title not change, please check title!",
                        backdrop: true
                    });
                }
                else {
                    $('.title-'  + type_lesson + '-' + lesson_id).html(title_lesson);
                    $('#editInfoTitle' + type_lesson + 'Modal-' + lesson_id).modal('hide');
                }
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update title lesson fail!",
                    backdrop: true
                });
            }
        });
    }
    else {
        bootbox.alert({
            message: "Title lesson not null!",
            backdrop: true
        });
    }
}

function updateBasicInfoLesson(type_lesson, type_lesson_id, lesson_id) {
    var ajaxUpdateBasicInfoLesson = baseUrl + '/updateBasicInfoLesson/';
    ajaxUpdateBasicInfoLesson += type_lesson_id + '-' + lesson_id;
    if (type_lesson_id < 3) {
        var type_question_id = $('#list_type_questions' + lesson_id).val().trim();
    }
    else var type_question_id = 0;
    var level_lesson_selected = $('#list_level' + lesson_id).val().trim();
    var order_lesson = $('#orderLesson' + lesson_id).val().trim();
    if (order_lesson !== '') {
        $.ajax({
            type: "POST",
            url: ajaxUpdateBasicInfoLesson,
            dataType: "json",
            data: { type_question_id: type_question_id, order_lesson: order_lesson, level_lesson_selected: level_lesson_selected },
            success: function (data) {
                console.log('$isChangeTypeQuestion ' + data.isChangeTypeQuestion);
                if (data.result === 'order-fail') {
                    bootbox.alert({
                        message: "Please check again order lesson!",
                        backdrop: true
                    });
                }
                else {
                    if (type_lesson_id < 3) {
                        var type_question = $('#list_type_questions' + lesson_id).find('option:selected').html();
                        $('.type-question-lesson-' + lesson_id).html(type_question);
                    }

                    var level_lesson = $('#list_level' + lesson_id).find('option:selected').html();
                    $('#orderLesson' + lesson_id).val(order_lesson);
                    $('.order-lesson-' + lesson_id).html(order_lesson);
                    $('.level-lesson-' + lesson_id).html(level_lesson);
                    $('#editBasicInfo' + type_lesson + 'Modal-' + lesson_id).modal('hide');
                }
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update fail!",
                    backdrop: true
                });
            }
        });
    }
    else {
        bootbox.alert({
            message: "Order lesson is not available!",
            backdrop: true
        });
    }
}

function updateLevelUserLesson(type_lesson_id, lesson_id) {
    var ajaxUpdateLevelUserLesson = baseUrl + '/updateLevelUserLesson/';
    ajaxUpdateLevelUserLesson += type_lesson_id + '-' + lesson_id;
    var level_user_id = $('#level-user-lesson-' + lesson_id).val().trim();
    if (level_user_id !== '') {
        $.ajax({
            type: "POST",
            url: ajaxUpdateLevelUserLesson,
            dataType: "json",
            data: { level_user_id: level_user_id },
            success: function (data) {
                if (data.result === 'level-user-not-change') {
                    bootbox.alert({
                        message: "Level user not change, please check again!",
                        backdrop: true
                    });
                }
                else {
                    var level_user_lesson = $('#level-user-lesson-' + lesson_id).find('option:selected').html();
                    $('.level-user-lesson-' + lesson_id).html(level_user_lesson);
                    $('#editUpdateLevelUserLessonModal-' + lesson_id).modal('hide');
                }
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update level user lesson fail!",
                    backdrop: true
                });
            }
        });
    }
    else {
        bootbox.alert({
            message: "Level user lesson not null!",
            backdrop: true
        });
    }
}

function updateLimitTimeLesson(type_lesson_id, lesson_id) {
    var ajaxUpdateLimitTimeLesson = baseUrl + '/updateLimitTimeLesson/';
    ajaxUpdateLimitTimeLesson += type_lesson_id + '-' + lesson_id;
    var limit_time = $('#limitTimeLesson' + lesson_id).val().trim();
    if (limit_time !== '') {
        $.ajax({
            type: "GET",
            url: ajaxUpdateLimitTimeLesson,
            dataType: "json",
            data: { limit_time: limit_time },
            success: function (data) {
                if (data.result === 'limit-time-not-change') {
                    bootbox.alert({
                        message: "Limit time not change, please check again!",
                        backdrop: true
                    });
                }
                else {
                    $('.limit-time-lesson-' + lesson_id).html(limit_time);
                    $('#editLimitTimeModal-' + lesson_id).modal('hide');
                }
            },
            error: function (data) {
                bootbox.alert({
                    message: "Update limit time lesson fail!",
                    backdrop: true
                });
            }
        });
    }
    else {
        bootbox.alert({
            message: "Limit time lesson not null!",
            backdrop: true
        });
    }
}