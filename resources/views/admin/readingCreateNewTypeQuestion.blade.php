<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/11/2017
 * Time: 11:24 AM
 */
?>

@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Reading - Create New Type Question
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/admin-style.css')}}">
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="upload-new-type-question">
                @include('utils.message')
                {{--@include('errors.input')--}}
                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                <h1>Create Type Question</h1>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="level_lesson">
                        Chọn Danh Mục
                    </label>
                    <select class="form-control" id="level-lesson" name="level_lesson" >
                        @foreach($all_level_lessons as $level_lesson)
                            <option value="{!! $level_lesson->id !!}">{!! $level_lesson->level !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group introduction">
                    <label for="tip_guide">
                        Nội dung
                    </label>
                    <textarea id="tip_guide" rows="10" cols="80" name="tip_guide"></textarea>
                    <script>
                        CKEDITOR.replace( 'tip_guide' );
                    </script>
                </div>
                <button type="submit" class="btn btn-lg btn-warning" onclick="submitNewTypeQuestion()">
                    Create
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/admin/readingNewTypeQuestion.js')}}"></script>
@endsection