<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/16/2017
 * Time: 3:47 PM
 */
?>
<div class="row overview-solution-detail-section">
    <div class="tip-col col-md-3">
        <h4 class="title-col-solution title-gip-guide">
            Tips
        </h4>
        <div class="score-board-area">
            Noi dung
        </div>
    </div>
    <div class="answered-table col-md-6">
        <h4 class="title-col-solution title-answer-table">
            List solutions
        </h4>
        <div class="list-answered">
            @include('components.tables.solutionTable')
        </div>
    </div>
    <div class="top-user-score-col col-md-3">
        <h4 class="title-col-solution title-mark-board">
            Top Highest Score
        </h4>
        <div class="top-users-area">
            <ul class="list-top-users">
                @foreach($top_highest_scores as $index_top => $top_user)
                    <li class="top-user-item">
                        <div class="avatar-area inline-class">
                            <img class="img-responsive avatar-top-user img-circle" src="{{url('/storage/img/users/default.jpg')}}" alt="{!! $top_user->User->username !!}">
                        </div>
                        <div class="inline-class info-top-user">
                            <a href="{{url('/profile/' . $top_user->User->id)}}" class="link_to_profile">
                                <h5 class="username-top-user">
                                    {!! $top_user->User->username !!}
                                </h5>
                            </a>
                            <h6 class="level-top-user">
                                {!! $top_user->User->levelUser->level !!}
                            </h6>
                        </div>
                        <div class="show-result-area inline-class pull-right">
                            {!! $top_user->highest_correct !!}/{!! $lesson->total_questions !!}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
