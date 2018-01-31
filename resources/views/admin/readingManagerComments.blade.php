<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 11/7/2017
 * Time: 3:37 PM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Reading Manager Comments
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin/readingListComment.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/libs/DataTables/datatables.min.css')}}"/>
@endsection
@section('content')
    <div class="container reading-list-lesson-container">
        @include('utils.message')
        @include('components.tables.commentTable')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/admin/readingAdminCommentFunctions.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/admin/readingTables.js')}}"></script>
@endsection
