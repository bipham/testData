<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 17/11/2017
 * Time: 1:21 PM
 */
?>
<table id="reading-solution-table" class="table table-striped table-bordered table-hover table-sm table-inverse">
    <thead>
    <tr class="header-table-row">
        <th>Question</th>
        <th>You answer</th>
        <th>Solution</th>
        <th>Correct</th>
    </tr>
    </thead>
    <tbody>
    @for($i=1; $i < $lesson->total_questions + 1; $i++)
        <tr class="item-row item-question-{!! $i !!}">
            <td scope="row" class="question-table-name">
                {!! $i !!}
            </td>
            <td scope="row" class="your-choice-key-area view-key-answer view-your-choice-{!! $i !!}">
            </td>
            <td class="view-key-answer view-solution-question-{!! $i !!}">
            </td>
            <td class="icon-result">
                <i class="fa selected-false-icon fa-times-circle-o" aria-hidden="true"></i>
                <i class="fa selected-true-icon fa-check-circle-o hidden" aria-hidden="true"></i>
            </td>
        </tr>
    @endfor
    </tbody>
</table>
