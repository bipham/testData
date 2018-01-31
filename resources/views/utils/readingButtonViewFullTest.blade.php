<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 18/11/2017
 * Time: 12:09 PM
 */
?>
@foreach($paragraphs as $key_paragraph => $paragraph)
    <button type="button" class="btn btn-tool-sidebar btn-footer-lesson btn-full-test-section btn-show-paragraph-{!! $paragraph->order_paragraph !!} btn-custom" {!! ($paragraph->order_paragraph == 1) ? 'disabled' : '' !!} onclick="showParagraph({!! $paragraph->order_paragraph !!})">
        Section {!! $paragraph->order_paragraph !!}
    </button>
@endforeach

