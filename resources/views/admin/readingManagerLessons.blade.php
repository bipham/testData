<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 10/13/2017
 * Time: 10:32 AM
 */
//dd($lessons['mini_test']);
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Reading List Lesson
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/readingListLesson.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/libs/DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="posts">
                <thead>
                <th>Id</th>
                <th>Title</th>
                <th>Level User ID</th>
                <th>image_feature</th>
                <th>order_lesson</th>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/admin/adminEditFunctions.js')}}"></script>
    <script src="{{asset('/js/admin/adminGetDataFunctions.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/admin/readingListLesson.js')}}"></script>
    <script type="text/javascript" src="{{asset('/libs/DataTables/datatables.min.js')}}"></script>
    <script>
        $('#posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('managerReadingLessonJSON') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "level_user_id" },
                { "data": "image_feature" },
                { "data": "order_lesson" }
            ]

        });
    </script>
@endsection
