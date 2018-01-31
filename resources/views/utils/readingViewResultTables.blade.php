<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 8/10/2017
 * Time: 5:11 PM
 */
?>

<div class="overview-solution-detail-section">
    <div class="overview-result">
        <h2 class="title-overview-solution-section">
            Your Exam Performance
        </h2>
        <div class="align-center reading-score-overview">
            <div class="progress reading-solution-score-progress">
                <?php
                $number_correct = sizeof($correct_answer);

                $percent_correct = $number_correct/($lesson->total_questions);
                $percent_friendly = number_format( $percent_correct * 100, 0 );
                if ($list_answer == 'emptyList') {
                    $answered_number = 0;
                }
                else {
                    $answered_number = count((array)$list_answer);
                }
                $unanswered_number = $lesson->total_questions - $answered_number;
                $incorrect_number = $lesson->total_questions - $unanswered_number - $number_correct;
                ?>
                <div class="progress-bar bg-success reading-score-progress" style="width: {!! $percent_friendly !!}%" role="progressbar" aria-valuenow="{!! $percent_friendly !!}" aria-valuemin="0" aria-valuemax="100">
                    {!! $percent_friendly !!}% Correct
                </div>
            </div>
        </div>
        <div class="container row reading-score-detail">
            <div class="col-md-4 left-detail-score">
                <div class="stats-block stats-total-question">
                    <span class="stats-value">{!! $lesson->total_questions !!}</span>
                    <span class="stats-title">Total Questions</span>
                </div>
                <div class="stats-block stats-correct">
                    <span class="stats-value">{!! $number_correct !!}</span>
                    <span class="stats-title">Correct</span>
                </div>
            </div>
            <div class="col-md-4 center-detail-score">
                <div class="stats-block stats-unanswered">
                    <span class="stats-value">{!! $unanswered_number !!}</span>
                    <span class="stats-title">Unanswered</span>
                </div>
                <div class="stats-block stats-incorrect">
                    <span class="stats-value">{!! $incorrect_number !!}</span>
                    <span class="stats-title">Incorrect</span>
                </div>
            </div>
            <div class="col-md-4 right-detail-score">
                <canvas id="myChartReadingScore"></canvas>
            </div>
        </div>
    </div>
    <div class="container row answer-table-section">
        <div class="answered-table col-md-8">
            <h4 class="title-col-solution title-answer-table">
                List answered detail
            </h4>
            <div class="list-answered">
                @include('components.tables.resultTable')
            </div>
        </div>
        <div class="score-band-col col-md-4">
            <h4 class="title-col-solution title-mark-board">
                Score Board
            </h4>
            <div class="score-board-area">
                <img src="{{url('/imgs/original/ielt-score-band.PNG')}}" alt="Ielts-score-band" class="img-responsive img-ielts-score-band">
            </div>
        </div>
    </div>
</div>