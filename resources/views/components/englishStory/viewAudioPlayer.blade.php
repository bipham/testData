<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 03/12/2017
 * Time: 12:41 PM
 */
?>
<div class="players" id="player-container">
    <div class="media-wrapper">
        <audio id="player-story" preload="auto" controls="controls" style="max-width:100%;">
            @foreach($chapters as $chapter)
                <source src="{!! $chapter->audio_link !!}" type="audio/mp3" title="{!! $chapter->order_chapter !!}. {!! $chapter->title_chapter !!}" >
            @endforeach
        </audio>
    </div>
</div>
