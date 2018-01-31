<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 02/12/2017
 * Time: 9:44 PM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Create new story
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/storyUploadNewStory.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-upload page-full-width">
                @include('utils.message')
                <form enctype="multipart/form-data" role="form" action="{!! url('createNewStory') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h1>Create English Story</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Cover Story</label>
                        <input type="file" name="image_cover" onchange="readImagePreview(this);" id="image_cover">
                        <img id="image_preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                    </div>
                    <div class="form-group first-layout-content">
                        <label for="description">
                            Description
                        </label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="list_authors">
                            Select author!
                        </label>
                        <select class="form-control" id="list_authors" name="author" onchange="changeImagePreviewOnOption('author')" required>
                            <option value="">Select author!</option>
                            @foreach($authors as $author):
                            <option value="{!! $author->id !!}" data-avatar="{!! $author->avatar !!}">{!! $author->name !!}</option>
                            @endforeach
                        </select>
                        <img id="image_thumbnail_preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                    </div>
                    <div class="form-group">
                        <label for="list_story_levels">
                            Select story level!
                        </label>
                        <select class="form-control" id="list_story_levels" name="story_level" required>
                            <option value="">Select story level!</option>
                            @foreach($story_levels as $story_level):
                            <option value="{!! $story_level->id !!}">{!! $story_level->level !!}</option>;
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="list_genres">
                            Select genre story!
                        </label>
                        <select class="form-control" id="list_genres" name="story_genre" required>
                            <option value="">Select genre story!</option>
                            @foreach($genres as $genre):
                            <option value="{!! $genre->id !!}">{!! $genre->genre !!}</option>;
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="list_lengths">
                            Select length story!
                        </label>
                        <select class="form-control" id="list_lengths" name="story_length" required>
                            <option value="">Select length story!</option>
                            @foreach($lengths as $length):
                            <option value="{!! $length->id !!}">{!! $length->length !!}</option>;
                            @endforeach
                        </select>
                    </div>
                    <div class="link-download-area">

                    </div>
                    <button type="button" class="btn btn-warning btn-create-more-link-download btn-admin-story" data-index-download="0" onclick="insertFormDownloadStory()">
                        Add link Download
                    </button>
                    <div class="link-get-book-area">

                    </div>
                    <button type="button" class="btn btn-info btn-create-more-link-get-book btn-admin-story" data-index-get-book="0" onclick="insertFormGetBook()">
                        Add link get book
                    </button>
                    <div class="submit-area">
                        <button type="submit" class="btn btn-lg btn-danger btn-upload-new-story">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var option_host_downloads = '';
        var host_downloads ={!! json_encode($host_downloads) !!};
        $.each(host_downloads, function (index, host_download) {
            option_host_downloads += '<option value="' + host_download.id + '">' + host_download.name + '</option>';
        });
    </script>
    <script src="{{asset('js/admin/imagePreviewUpload.js')}}"></script>
    <script src="{{asset('js/admin/storyUploadNewStoryEnglish.js')}}"></script>
@endsection

