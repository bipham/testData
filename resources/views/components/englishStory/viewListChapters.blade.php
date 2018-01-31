<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 03/12/2017
 * Time: 12:40 PM
 */
?>
<div class="title-list-chapters">
    <a class="cover-story-link" href="#cover-story">
        {!! $story->title !!}
    </a>
</div>
<div class="inner-content-list-chapters">
    @foreach($chapters as $chapter)
        <div class="link-to-chapter">
            <a class="chapter-story-link" href="#chapter-{!! $chapter->order_chapter !!}" data-chapter-id="{!! $chapter->order_chapter !!}" onclick="playChapter({!! $chapter->order_chapter !!});">
                {!! $chapter->order_chapter !!}. {!! $chapter->title_chapter !!}
            </a>
        </div>
    @endforeach
</div>
