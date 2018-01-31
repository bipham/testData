<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 7/18/2017
 * Time: 4:42 PM
 */
//var_dump($practice_lessons);
?>
@extends('layout.master')
@section('meta-title')
    Home
@endsection

@section('css')
    <?php
    $bg = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg');
    $i = rand(0, count($bg)-1); // generate random number size of the array
    $i2 = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
    $selectedBg2 = "$bg[$i2]"; // set variable equal to which random filename was chosen
    ?>
    <style type="text/css">
        .outer-banner-custom {
            background: url(/imgs/background-header/<?php echo $selectedBg2; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .header-product {
            background: url(/imgs/background-header/<?php echo $selectedBg; ?>);
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('banner-page')
    <div class="row-fluid outer-banner-custom">
        <div class="breadcrumb-header middle-banner-custom">
            <div class="content-breadcrumb-header content-banner-custom">
                <h2 class="title-post">READING IELTS</h2>
                {{--<ol class="breadcrumb" id="path">--}}
                    {{--<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>--}}
                    {{--<li class="breadcrumb-item"><a href="{{url('/')}}">Tin tìm mua</a></li>--}}
                    {{--<li class="breadcrumb-item"><a href="{{url('/')}}">asd</a></li>--}}
                {{--</ol>--}}
            </div>
        </div>
    </div>
@endsection
{{--@include('utils.toolbarReadingLesson')--}}

@section('titleTypeLesson')
    READING IELTS
@endsection

@section('content')
    <div class="container reading-page">
        <h5 class="title-guide-reading">
            Please select level:
        </h5>
        <div class="row list-level-lesson">
            <div class="col-md-4 level-lesson">
                <div class="card level-lesson-custom basic-lesson text-white bg-primary mb-3">
                    <div class="card-header">BASIC</div>
                    <div class="card-body">
                        <h4 class="card-title">Level Basic</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('/reading/1-level/')}}">
                            <button type="button" class="btn btn-my-style btn-go-to-level pull-right">
                                Let's Go!
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 level-lesson">
                <div class="card level-lesson-custom inter-lesson text-white bg-success mb-3">
                    <div class="card-header">INTERMEDIATE</div>
                    <div class="card-body">
                        <h4 class="card-title">Level Intermediate</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('/reading/2-level/')}}">
                            <button type="button" class="btn btn-my-style btn-go-to-level pull-right">
                                Let's Go!
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 level-lesson">
                <div class="card level-lesson-custom advanced-lesson text-white bg-danger mb-3">
                    <div class="card-header">ADVANCED</div>
                    <div class="card-body">
                        <h4 class="card-title">Level Advanced</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('/reading/3-level/')}}">
                            <button type="button" class="btn btn-my-style btn-go-to-level pull-right">
                                Let's Go!
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection