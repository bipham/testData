<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 23/11/2017
 * Time: 9:03 PM
 */
?>
<!-- Button Edit Title Lesson-->
<div class="basic-info limit-time-lesson">
    <h6 class="limit-time-custom limit-time-lesson-{!! $lesson->id !!}">
        {!! $lesson->limit_time !!} mins
    </h6>
    <i class="btn-edit-limit-time fa fa-pencil-square-o" aria-hidden="true" data-id="{!! $lesson->id !!}" data-toggle="modal" data-target="#editLimitTimeModal-{!! $lesson->id !!}"></i>
</div>

<!-- Modal Edit Level User Lesson-->
<div class="modal fade" id="editLimitTimeModal-{!! $lesson->id !!}" tabindex="-1" data-id="{!! $lesson->id !!}" role="dialog" aria-labelledby="editLimitTimeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readingReviewQuizModalLabel">
                    Edit limit time!
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <div class="form-group">
                        <label for="limit-time-lesson-{!! $lesson->id !!}">
                            Limit time
                        </label>
                        <input type="number" min="1" name="limit-time-lesson-{!! $lesson->id !!}" class="form-control" placeholder="Limit time" required id="limitTimeLesson{!! $lesson->id !!}" value="{!! $lesson->limit_time !!}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-update-level-user-lesson btn-warning" onclick="updateLimitTimeLesson({!! $type_lesson_id !!}, {!! $lesson->id !!})">
                    Save
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
