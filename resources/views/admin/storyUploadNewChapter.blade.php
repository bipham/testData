<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 03/12/2017
 * Time: 8:46 AM
 */
?>
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
    Create new chapter
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/storyUploadNewStory.css')}}">
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-upload page-full-width">
                @include('utils.message')
                <form enctype="multipart/form-data" role="form" action="{!! url('createNewChapterOfStory') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h1>Create English Chapter</h1>
                    <div class="form-group">
                        <label for="list_story_levels">
                            Select story!
                        </label>
                        <select class="form-control" id="list_stories" name="story" onchange="changeImagePreviewOnOption('story')" required>
                            <option value="">Select story!</option>
                            @foreach($stories as $story):
                            <option value="{!! $story->id !!}" data-avatar="{!! stripUnicode($story->title) !!}/{!! $story->image_cover !!}">{!! $story->title !!}</option>;
                            @endforeach
                        </select>
                        <img id="image_thumbnail_preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Cover Chapter</label>
                        <input type="file" name="image_cover" onchange="readImagePreview(this);" id="image_cover">
                        <img id="image_preview" class="img-upload-product hidden-class" src="#" alt="Ảnh" />
                    </div>
                    <div class="form-group first-layout-content">
                        <label for="content_chapter">
                            Content chapter
                        </label>
                        <textarea id="content_chapter" rows="10" cols="80" name="content_chapter" required></textarea>
                        <script>
                            CKEDITOR.replace( 'content_chapter' );
                        </script>
                    </div>
                    <div class="form-group">
                        <div class="show-order">
                            <div class="title-list-order">List ordered</div>
                            <ul class="list-ordered-">

                            </ul>
                        </div>
                        <label for="order_chapter">
                            Order Chapter
                        </label>
                        <input type="number" class="form-control" min="1" value="" placeholder="Order Chapter" id="order_chapter" name="order_chapter" required>
                    </div>
                    <div class="form-group">
                        <label for="order_lesson">
                            Link audio play
                        </label>
                        <input type="text" class="form-control" placeholder="Link audio play" id="link_audio_play" name="link_audio_play" required>
                    </div>
                    <div class="link-download-audio-area">

                    </div>
                    <button type="button" class="btn btn-warning btn-create-more-link-download btn-admin-story" data-index-download="0" onclick="insertFormDownloadAudioChapter()">
                        Add link Download Audio
                    </button>
                    <div class="link-download-ebook-area">

                    </div>
                    <button type="button" class="btn btn-info btn-create-more-link-get-book btn-admin-story" data-index-get-book="0" onclick="insertFormDownloadEbookChapter()">
                        Add link Download Ebook
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
    <script src="{{asset('js/admin/storyAdminFunctions.js')}}"></script>
    <script src="{{asset('js/admin/imagePreviewUpload.js')}}"></script>
    <script src="{{asset('js/admin/storyUploadNewChapter.js')}}"></script>
@endsection


