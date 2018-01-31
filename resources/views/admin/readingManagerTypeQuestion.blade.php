<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 15/11/2017
 * Time: 2:47 PM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Reading Manager Type Questions
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin/readingListComment.css')}}">
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/libs/DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="container reading-list-lesson-container">
        @include('utils.message')
        @include('components.tables.typeQuestionTable')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/admin/readingAdminCommentFunctions.js')}}"></script>
    <script type="text/javascript" src="{{asset('/libs/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/admin/readingTables.js')}}"></script>
@endsection

