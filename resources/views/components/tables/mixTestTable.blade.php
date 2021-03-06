<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 22/11/2017
 * Time: 2:31 PM
 */
?>
<table id="reading-list-lesson" class="table datatable display manager-lesson-table">
    <thead>
    <tr>
        <th><label><input class="select-all-lessons" name="all-lessons" type="checkbox" value="all"></label></th>
        <th>ID </th>
        <th>Title </th>
        <th>Level lesson </th>
        <th>Order lesson </th>
        <th>Limit Time </th>
        <th>Level user </th>
        <th>Created At </th>
        <th>Admin </th>
        <th>Action </th>
    </tr>
    </thead>
    <tbody>
    @foreach($lessons as $key => $lesson)
        <?php
        $type_lesson_id = config('constants.type_lesson.mix_test');
        $readingLessonService = new App\Services\ReadingLessonService();
        $all_type_questions = $lesson->levelLesson->typeQuestions()->get();
        $all_orders = $readingLessonService->getAllOrderLesson($type_lesson_id, $lesson->level_lesson_id);
        $created_at = timeFormat($lesson->created_at);
        $type_lesson = 'MixTest';
        ?>
        <tr class="item_row item-lesson-{!! $lesson->id !!}">
            <td><input type="checkbox" name="item-lesson" value="{!! $lesson->id !!}"></td>
            <td>{!! $lesson->id !!}</td>
            <td>
                @include('components.modals.editTitleLessonModal', ['lesson' => $lesson, 'type_lesson_id' => $type_lesson_id, 'type_lesson' => $type_lesson])
            </td>
            <td>
                @include('components.modals.editLevelMixTestModal', ['lesson' => $lesson, 'all_level_lessons' => $all_level_lessons, 'type_lesson_id' => $type_lesson_id, 'all_orders' => $all_orders,  'type_lesson' => $type_lesson])
            </td>
            <td>
                @include('components.modals.editOrderLessonModal', ['lesson' => $lesson, 'type_lesson' => $type_lesson])
            </td>
            <td>
                @include('components.modals.editLimitTimeModal', ['lesson' => $lesson, 'type_lesson' => $type_lesson])
            </td>
            <td>
                @include('components.modals.editLevelUserLessonModal', ['$lesson' => $lesson, 'all_level_users' => $all_level_users, 'type_lesson_id' => $type_lesson_id, 'type_lesson' => $type_lesson])
            </td>
            <td>
                {!! $created_at !!}
            </td>
            <td>
                {!! $lesson->User->username !!}
            </td>
            <td>
                <a href="{{url('editLessonReading/' . $type_lesson_id . '/' . $lesson->id)}}">
                    <button type="button" class="btn btn-info btn-admin-custom btn-edit-lesson" data-id="{!! $lesson->id !!}">Edit</button>
                </a>
                <button class="btn btn-danger btn-admin-custom btn-del-lesson" data-id="{!! $lesson->id !!}" onclick="deleteReadingLesson({!! $type_lesson_id !!},{!! $lesson->id !!})">Del</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
