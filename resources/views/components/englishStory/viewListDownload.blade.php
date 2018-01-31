<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 03/12/2017
 * Time: 12:40 PM
 */
?>
<div class="list-download-story-area">
    <div id="accordion" class="accordion-download-story" role="tablist">
        {{--download chapter--}}
        @if(sizeof($chapter_downloads) > 0)
            <div class="card tab-accordion-custom accordion-download-chapter">
                <div class="card-header" role="tab" id="downloadChapter">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#listLinkDownloadChapter" aria-expanded="true" aria-controls="listLinkDownloadChapter">
                            Download chapters
                        </a>
                        <div class="right-arrow inline-class pull-right">-</div>
                    </h5>
                </div>
                <div id="listLinkDownloadChapter" class="collapse show collage-download-story" role="tabpanel" aria-labelledby="downloadChapter" data-parent="#accordion">
                    <div class="card-body list-download-story-body">
                        @foreach($chapter_downloads as $index_chapter => $chapter_download)
                            @if(sizeof($chapter_download['audio']) > 0 || sizeof($chapter_download['ebook']) > 0)
                                <div class="list-download-chapter list-download-{!! $chapter_download['chapter_id'] !!}">
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#downloadChapter{!! $chapter_download['chapter_id'] !!}" aria-expanded="false" aria-controls="downloadChapter{!! $chapter_download['chapter_id'] !!}">
                                        Chapter {!! $chapter_download['chapter_id'] !!}
                                    </button>
                                    <div class="collapse download-chapter" id="downloadChapter{!! $chapter_download['chapter_id'] !!}">
                                        <div class="card card-body">
                                            @if(sizeof($chapter_download['audio']) > 0)
                                                <div class="link-download-audio-area link-download-item-area">
                                                    <h6 class="title-download-chapter title-download-audio">
                                                        Audio
                                                    </h6>
                                                    <div class="list-download-audio-chapter list-download-area">
                                                        @foreach($chapter_download['audio'] as $index_audio_chapter => $audio_chapter)
                                                            <div class="link-download-audio item-link-download">
                                                                <a href="{!! $audio_chapter->link !!}" target="_blank">
                                                                    <div class="logo-host-download-story">
                                                                        <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $audio_chapter->hostDownload->logo)}}" />
                                                                    </div>
                                                                    <div class="info-download-audio info-download-item">
                                                                        <button type="button" href="{!! $audio_chapter->link !!}" target="_blank" class="btn btn-outline-primary btn-download-audio btn-download-item">
                                                                <span class="inline-class icon-download-story">
                                                                   <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                                </span>
                                                                            <span class="inline-class file-type-audio">
                                                                    {!! $audio_chapter->file_type !!}
                                                                </span>
                                                                        </button>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if(sizeof($chapter_download['ebook']) > 0)
                                                <div class="link-download-ebook-area link-download-item-area">
                                                    <h6 class="title-download-chapter title-download-ebook">
                                                        Ebook
                                                    </h6>
                                                    <div class="list-download-ebook-chapter list-download-area">
                                                        @foreach($chapter_download['ebook'] as $index_ebook_chapter => $ebook_chapter)
                                                            <div class="link-download-ebook item-link-download">
                                                                <a href="{!! $ebook_chapter->link !!}" target="_blank">
                                                                    <div class="logo-host-download-story">
                                                                        <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $ebook_chapter->hostDownload->logo)}}" />
                                                                    </div>
                                                                    <div class="info-download-ebook info-download-item">
                                                                        <button type="button" href="{!! $ebook_chapter->link !!}" target="_blank" class="btn btn-outline-success btn-download-ebook btn-download-item">
                                                                <span class="inline-class icon-download-story">
                                                                   <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                                </span>
                                                                            <span class="inline-class file-type-ebook">
                                                                    {!! $ebook_chapter->file_type !!}
                                                                </span>
                                                                        </button>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{--download full--}}
        @if(sizeof($full_downloads) > 0)
            <div class="card tab-accordion-custom accordion-download-full">
                    <div class="card-header" role="tab" id="downloadFull">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#listLinkDownloadFull" aria-expanded="false" aria-controls="listLinkDownloadFull">
                                Download full story
                            </a>
                            <div class="right-arrow inline-class pull-right">+</div>
                        </h5>
                    </div>
                    <div id="listLinkDownloadFull" class="collapse collage-download-story" role="tabpanel" aria-labelledby="downloadFull" data-parent="#accordion">
                        <div class="card-body list-download-story-body">
                            @if(sizeof($full_downloads['full']) > 0)
                                <div class="link-download-full-area link-download-item-area">
                                    <h6 class="title-download-chapter title-download-full">
                                        Full Audio + Ebook
                                    </h6>
                                    <div class="list-download-full list-download-area">
                                        @foreach($full_downloads['full'] as $index_full_download => $full_download)
                                            <div class="link-download-full item-link-download">
                                                <a href="{!! $full_download->link !!}" target="_blank">
                                                    <div class="logo-host-download-story">
                                                        <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $full_download->hostDownload->logo)}}" />
                                                    </div>
                                                    <div class="info-download-full info-download-item">
                                                        <button type="button" href="{!! $full_download->link !!}" target="_blank" class="btn btn-outline-danger btn-download-full btn-download-item">
                                                                <span class="inline-class icon-download-story">
                                                                   <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                                </span>
                                                            <span class="inline-class file-type-full">
                                                                {!! $full_download->file_type !!}
                                                            </span>
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(sizeof($full_downloads['audio']) > 0)
                                <div class="link-download-audio-area link-download-item-area">
                                    <h6 class="title-download-chapter title-download-audio-full">
                                        Audio
                                    </h6>
                                    <div class="list-download-audio-full list-download-area">
                                        @foreach($full_downloads['audio'] as $index_audio_full => $audio_full)
                                            <div class="link-download-audio-full item-link-download">
                                                <a href="{!! $audio_full->link !!}" target="_blank">
                                                    <div class="logo-host-download-story">
                                                        <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $audio_full->hostDownload->logo)}}" />
                                                    </div>
                                                    <div class="info-download-audio-full info-download-item">
                                                        <button type="button" href="{!! $audio_full->link !!}" target="_blank" class="btn btn-outline-primary btn-download-audio-full btn-download-item">
                                                                <span class="inline-class icon-download-story">
                                                                   <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                                </span>
                                                            <span class="inline-class file-type-audio-full">
                                                                {!! $audio_full->file_type !!}
                                                            </span>
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(sizeof($full_downloads['ebook']) > 0)
                                <div class="link-download-ebook-area link-download-item-area">
                                    <h6 class="title-download-chapter title-download-ebook-full">
                                        Ebook
                                    </h6>
                                    <div class="list-download-ebook-chapter list-download-area">
                                        @foreach($full_downloads['ebook'] as $index_ebook_full => $ebook_full)
                                            <div class="link-download-ebook-full item-link-download">
                                                <a href="{!! $ebook_full->link !!}" target="_blank">
                                                    <div class="logo-host-download-story">
                                                        <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $ebook_full->hostDownload->logo)}}" />
                                                    </div>
                                                    <div class="info-download-ebook-full info-download-item">
                                                        <button type="button" href="{!! $ebook_full->link !!}" target="_blank" class="btn btn-outline-success btn-download-ebook-full btn-download-item">
                                                            <span class="inline-class icon-download-story">
                                                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                            </span>
                                                            <span class="inline-class file-type-ebook-full">
                                                                {!! $ebook_full->file_type !!}
                                                            </span>
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        @endif

        {{--get book--}}
        @if(sizeof($link_get_books) > 0)
            <div class="card tab-accordion-custom accordion-get-book">
                <div class="card-header" role="tab" id="getBook">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#listLinkGetBook" aria-expanded="false" aria-controls="listLinkGetBook">
                            Get book now!
                        </a>
                        <div class="right-arrow inline-class pull-right">+</div>
                    </h5>
                </div>
                <div id="listLinkGetBook" class="collapse collage-download-story" role="tabpanel" aria-labelledby="getBook" data-parent="#accordion">
                    <div class="card-body list-download-story-body">
                        <div class="link-download-full-area link-download-item-area">
                            <h6 class="title-download-chapter title-download-full">
                                Link to get book:
                            </h6>
                            <div class="list-download-full list-download-area">
                                @foreach($link_get_books as $index_get_book => $link_get_book)
                                    <div class="link-download-full item-link-download">
                                        <a href="{!! $link_get_book->link !!}" target="_blank">
                                            <div class="logo-host-download-story">
                                                <img class="logo-host-download-thumbnail img-responsive" src="{{url('/storage/img/host_data/' . $link_get_book->hostDownload->logo)}}" />
                                            </div>
                                            <div class="info-download-full info-download-item">
                                                <button type="button" href="{!! $link_get_book->link !!}" target="_blank" class="btn btn-outline-warning btn-download-full btn-download-item">
                                                    <span class="inline-class icon-download-story">
                                                        <i class="fa fa-cloud-download" aria-hidden="true"></i></span>
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
