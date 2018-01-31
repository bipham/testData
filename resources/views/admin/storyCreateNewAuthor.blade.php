<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 02/12/2017
 * Time: 10:44 AM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Create new author story
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/storyUploadNewStory.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-upload page-full-width">
                @include('utils.message')
                <form enctype="multipart/form-data" role="form" action="{!! url('createNewAuthorStory') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h1>Tạo Author Story</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Hình Đại Diện</label>
                        <input type="file" name="image_feature" onchange="readImagePreview(this);" id="image_feature">
                        <img id="image_preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                    </div>
                    <div class="form-group first-layout-content">
                        <label for="introduction">
                            Nội dung
                        </label>
                        <textarea id="introduction" rows="10" cols="80" name="introduction"></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-warning">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/admin/imagePreviewUpload.js')}}"></script>
@endsection
