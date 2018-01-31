<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 29/11/2017
 * Time: 10:55 AM
 */
?>
@extends('layout.master')
@section('meta-title')
    Profile
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/client/profileUser.css')}}"/>
@endsection

@section('content')
    <div class="container reading-page page-custom">
        <div class="row row-info-user-custom info-user-area">
            <div class="col-md-3 left-info-user pull-left user-info-col">
                <div class="top-left-info cell-left-info">
                    <h6 class="username-info">
                        {!! $user_info->username !!}
                    </h6>
                </div>
                <hr class="hr-custom hr-user-info" />
                <div class="bottom-left-info cell-left-info">
                    <h6 class="level-user-info">
                        {!! $user_info->levelUser->level !!}
                    </h6>
                </div>
                @if(Auth::id() == $user_info->id)
                <div class="edit-profile-area">
                    @include('components.modals.changePasswordModal')
                </div>
                @endif
            </div>
            <div class="col-md-6 middle-info-user user-info-col">
                <div class="avatar-profile">
                    <img class="img-responsive img-avatar-profile" src="{{url('/storage/img/users/' . $user_info->avatar)}}">
                </div>
                @if(Auth::id() == $user_info->id)
                    <div class="form-update-avatar">
                        <form enctype="multipart/form-data" action="{!! url('profile/updateAvatar/' . $user_info->id) !!}" method="POST">
                            <label class="label-update-avatar">Update Profile Image</label>
                            <input type="file" name="avatar" class="file-upload-avatar" onchange="readAvatarUpload(this)">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="pull-right btn btn-sm btn-primary hidden btn-update-avatar">
                        </form>
                    </div>
                @endif
            </div>
            @if(Auth::id() == $user_info->id)
                <div class="col-md-3 right-info-user user-info-col pull-right">
                <div class="first-top-right-user-info cell-right-info">
                    <h6 class="title-info-cell">
                        Email
                    </h6>
                    <h6 class="info-user-detail">
                        {!! $user_info->email !!}
                    </h6>
                </div>
                <hr class="hr-custom hr-right-info hr-user-info" />
                <div class="second-top-right-user-info cell-right-info">
                    <h6 class="title-info-cell">
                        Phone
                    </h6>
                    <h6 class="info-user-detail">
                        {!! $user_info->phone !!}
                    </h6>
                </div>
                <hr class="hr-custom hr-right-info hr-user-info" />
                <div class="third-top-right-user-info cell-right-info">
                    <h6 class="title-info-cell">
                        Full name
                    </h6>
                    <h6 class="info-user-detail">
                        {!! $user_info->fullname !!}
                    </h6>
                </div>
                <hr class="hr-custom hr-right-info hr-user-info" />
                <div class="fourth-top-right-user-info cell-right-info">
                    <h6 class="title-info-cell">
                        Day of birth
                    </h6>
                    <h6 class="info-user-detail">
                        {!! $user_info->dob !!}
                    </h6>
                </div>
                <hr class="hr-custom hr-right-info hr-user-info" />
            </div>
            @endif
        </div>
        <div class="row row-info-user-custom info-result-user-area">
            <div class="col-md-4 overview-level-reading">
                <div id="overview_basic" class="overview-level"></div>
            </div>
            <div class="col-md-4 overview-level-reading">
                <div id="overview_inter" class="overview-level"></div>
            </div>
            <div class="col-md-4 overview-level-reading">
                <div id="overview_advanced" class="overview-level"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('libs/progress-bar/progressbar.min.js')}}"></script>
    <script src="{{asset('js/client/profileUser.js')}}"></script>
    <script type="text/javascript">
        var all_level_lessons = {!! json_encode($all_level_lessons) !!};
        //Basic
        var bar_basic = new ProgressBar.Circle(overview_basic, {
            color: '#aaa',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 3,
            easing: 'easeInOut',
            duration: 1400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#ef9393', width: 3 },
            to: { color: '#f84545', width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);
                var value = '<h6 class="total-overview">' + Math.round(circle.value() * 100) + '%</h6>' +
                    '<hr class="hr-custom hr-progress-info" />' +
                    '<h6 class="name-level">Basic</h6>';
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value);
                }

            }
        });
        bar_basic.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar_basic.text.style.fontSize = '2rem';
        bar_basic.animate(all_level_lessons[0]['percent_finished']/100);  // Number from 0.0 to 1.0

        //Inter
        var bar_inter = new ProgressBar.Circle(overview_inter, {
            color: '#aaa',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 3,
            easing: 'easeInOut',
            duration: 1400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#15b876', width: 3 },
            to: { color: '#5cb85c', width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                var value = '<h6 class="total-overview">' + Math.round(circle.value() * 100) + '%</h6>' +
                    '<hr class="hr-custom hr-progress-info" />' +
                    '<h6 class="name-level">Intermediate</h6>';
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value);
                }

            }
        });
        bar_inter.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar_inter.text.style.fontSize = '2rem';
        bar_inter.animate(all_level_lessons[1]['percent_finished']/100);  // Number from 0.0 to 1.0

        //Advanced
        var bar_advanced = new ProgressBar.Circle(overview_advanced, {
            color: '#aaa',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 3,
            easing: 'easeInOut',
            duration: 1400,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#3aa8d8', width: 3 },
            to: { color: '#0275d8', width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                var value = '<h6 class="total-overview">' + Math.round(circle.value() * 100) + '%</h6>' +
                    '<hr class="hr-custom hr-progress-info" />' +
                    '<h6 class="name-level">Advanced</h6>';
                if (value === 0) {
                    circle.setText('');
                } else {
                    circle.setText(value);
                }

            }
        });
        bar_advanced.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar_advanced.text.style.fontSize = '2rem';

        bar_advanced.animate(all_level_lessons[2]['percent_finished']/100);  // Number from 0.0 to 1.0
    </script>
@endsection
