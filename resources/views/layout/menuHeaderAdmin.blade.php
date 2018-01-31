<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/5/2017
 * Time: 1:56 PM
 */
?>
<div class="menu-fix-custom">
    <div class="container">
        <div class="menu menu-reading">
            <div class="pull-right action-user-center-fixed">
                {{--@include('utils.actionCenterUser')--}}
            </div>
            <ul class="nav nav-tabs" id="myTabReading" role="tablist">
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-primary btn-dropdown-admin dropdown-toggle" type="button" id="dropdownNewLesson" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        New Lesson
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-create-new" aria-labelledby="dropdownNewLesson">
                        <a class="nav-link" href="{{url('/createNewLearningTypeQuestion')}}">New_Learning</a>
                        <a class="nav-link" href="{{url('/createNewReadingLesson/1practice')}}">New_practice_lesson</a>
                        <a class="nav-link" href="{{url('/createNewReadingLesson/2miniTest')}}">New_mini_test</a>
                        <a class="nav-link" href="{{url('/createNewReadingLesson/3mixTest')}}">New_mix_test</a>
                        <a class="nav-link" href="{{url('/createNewReadingLesson/4fullTest')}}">New_full_test</a>
                        <a class="nav-link" href="{{url('/createNewLevelLesson')}}">New_level_lesson</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-success btn-dropdown-admin dropdown-toggle" type="button" id="dropdownManagerLesson" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manager Lesson
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-manager-lesson" aria-labelledby="dropdownManagerLesson">
                        <a class="nav-link" href="{{url('/managerReadingLesson/1-practice')}}">Manager_practice</a>
                        <a class="nav-link" href="{{url('/managerReadingLesson/2-miniTest')}}">Manager_mini_test</a>
                        <a class="nav-link" href="{{url('/managerReadingLesson/3-mixTest')}}">Manager_mix_test</a>
                        <a class="nav-link" href="{{url('/managerReadingLesson/4-fullTest')}}">Manager_full_test</a>
                        <a class="nav-link" href="{{url('/updateTotalLessons')}}">Update_total_lessons</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-default btn-dropdown-admin dropdown-toggle" type="button" id="dropdownTypeQuestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Type Question
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-type-question" aria-labelledby="dropdownTypeQuestion">
                        <a class="nav-link" href="{{url('/managerTypeQuestion')}}">Manager_type_question</a>
                        <a class="nav-link" href="{{url('/createNewTypeQuestion')}}">New_type_question</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-secondary btn-dropdown-admin dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-user" aria-labelledby="dropdownUser">
                        <a class="nav-link" href="{{url('/createNewUser')}}">New_User</a>
                        <a class="nav-link" href="{{url('/createNewLevelUser')}}">New_level_user</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-warning btn-dropdown-admin dropdown-toggle" type="button" id="dropdownComment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Comment
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-comment" aria-labelledby="dropdownComment">
                        <a class="nav-link" href="{{url('/managerCommentReading')}}">Manager_comment</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-info btn-dropdown-admin dropdown-toggle" type="button" id="dropdownNewStoryEnglish" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        New Story English
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-new-story-english" aria-labelledby="dropdownNewStoryEnglish">
                        <a class="nav-link" href="{{url('/createNewComponentStory/level')}}">New Level Story</a>
                        <a class="nav-link" href="{{url('/createNewComponentStory/genre')}}">New Genre Story</a>
                        <a class="nav-link" href="{{url('/createNewComponentStory/length')}}">New Length Story</a>
                        <a class="nav-link" href="{{url('/createNewStory')}}">New English Story</a>
                        <a class="nav-link" href="{{url('/createNewChapterOfStory')}}">New Chapter</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-danger btn-dropdown-admin dropdown-toggle" type="button" id="dropdownAuthorStoryEnglish" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Author Story English
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-author-story-english" aria-labelledby="dropdownAuthorStoryEnglish">
                        <a class="nav-link" href="{{url('/createNewAuthorStory')}}">New Author Story</a>
                    </div>
                </div>
                <div class="dropdown dropdown-admin">
                    <button class="btn btn-outline-success btn-dropdown-admin dropdown-toggle" type="button" id="dropdownHostData" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Host Data
                    </button>
                    <div class="dropdown-menu dropdown-menu-admin dropdown-host-data" aria-labelledby="dropdownHostData">
                        <a class="nav-link" href="{{url('/createNewHostDownload')}}">New Host Data</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>
