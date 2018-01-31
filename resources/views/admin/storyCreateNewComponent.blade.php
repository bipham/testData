<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 9/14/2017
 * Time: 10:18 PM
 */
?>
@extends('layout.masterNoMenuAdmin')
@section('meta-title')
    Create new {!! $type !!} story
@endsection
@section('css')
    <script src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-upload page-full-width">
                @include('utils.message')
                <form role="form" action="{!! url('createNewComponentStory/' . $type) !!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <h1>Tạo {!! $type !!} Story</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Level" id="level" name="level" required>
                    </div>
                    <div class="form-group first-layout-content">
                        <label for="introduction">
                            Nội dung
                        </label>
                        <textarea id="introduction" rows="10" cols="80" name="introduction"></textarea>
                        <script>
                            CKEDITOR.replace( 'introduction' );
                        </script>
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

@endsection
