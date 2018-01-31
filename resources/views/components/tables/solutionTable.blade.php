<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 17/11/2017
 * Time: 10:34 AM
 */
?>
<table id="reading-solution-table" class="table table-striped table-bordered table-hover table-sm table-inverse">
    <thead>
        <tr class="header-table-row">
            <th>Question</th>
            <th>Solution</th>
        </tr>
    </thead>
    <tbody>
    @for($i=1; $i < $lesson->total_questions + 1; $i++)
        <tr class="item-row item-question-{!! $i !!}">
            <td scope="row" class="question-table-name">
                {!! $i !!}
            </td>
            <td class="view-key-answer view-solution-question-{!! $i !!}">
            </td>
        </tr>
    @endfor
    </tbody>
</table>
