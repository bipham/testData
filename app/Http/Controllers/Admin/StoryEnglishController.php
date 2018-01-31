<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StoryEnglishService;
use Validator;
use App\Http\Requests\NameItemRequest;
use App\Services\StoryAuthorService;
use App\Services\HostDownloadService;
use App\Http\Requests\UploadStoryEnglishRequest;
use App\Services\StoryDownloadService;
use App\Services\StoryChapterService;
use App\Http\Requests\StoryUploadChapterRequest;

class StoryEnglishController extends Controller
{

    public function getCreateNewStory($domain)
    {
        $englishStoryService = new StoryEnglishService();
        $storyAuthorService = new StoryAuthorService();
        $hostDownloadService = new HostDownloadService();
        $authors = $storyAuthorService->getAllAuthorsForUploadStory();
        $story_levels = $englishStoryService->getAllStoryLevelForUploadStory();
        $genres = $englishStoryService->getAllStoryGenreForUploadStory();
        $lengths = $englishStoryService->getAllStoryLengthForUploadStory();
        $host_downloads = $hostDownloadService->getAllHostForUploadStory();
        return view('admin.storyUploadNewStory', compact('authors', 'story_levels', 'genres', 'lengths', 'host_downloads'));
    }

    public function postCreateNewStory($domain, UploadStoryEnglishRequest $request)
    {
        $validator = validator($request->All(), $request->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $englishStoryService = new StoryEnglishService();
            $storyDownloadService = new StoryDownloadService();
            $title = $request->title;
            $image_cover = $request->file('image_cover');
            $description = $request->description;
            $author_id = $request->author;
            $story_level_id = $request->story_level;
            $genre_id = $request->story_genre;
            $length_id = $request->story_length;
            //Insert new story
            $story_id = $englishStoryService->insertNewStory($title, $image_cover, $description, $author_id, $story_level_id, $genre_id, $length_id);

            //insert link download
            if ($request->host_download != null) {
                $type_downloads = $request->type_download;
                $host_downloads = $request->host_download;
                $link_downloads = $request->link_download;
                $file_types = $request->file_type;
                foreach ($host_downloads as $index_host_download => $host_download) {
                    $storyDownloadService->insertNewLinkDownloadFull($story_id, $type_downloads[$index_host_download], $host_download, $link_downloads[$index_host_download], $file_types[$index_host_download]);
                }
            }

            //insert link get book
            if ($request->host_get_book != null) {
                $link_get_books = $request->link_get_book;
                $host_get_books = $request->host_get_book;
                foreach ($host_get_books as $index_host_get_book => $host_get_book) {
                    $storyDownloadService->insertNewLinkGetBook($story_id, $host_get_book, $link_get_books[$index_host_get_book]);
                }
            }
            $message = ['flash_level'=>'success message-custom','flash_message'=>'Upload new english story success!'];
            return redirect()->back()->with($message);
        }
    }

    public function getCreateNewChapterOfStory($domain) {
        $englishStoryService = new StoryEnglishService();
        $hostDownloadService = new HostDownloadService();
        $host_downloads = $hostDownloadService->getAllHostForUploadStory();
        $stories = $englishStoryService->getAllEnglishStoriesForUploadChapter();
        return view('admin.storyUploadNewChapter', compact('stories', 'host_downloads'));
    }

    public function postCreateNewChapterOfStory($domain, StoryUploadChapterRequest $request)
    {
        $validator = validator($request->All(), $request->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $storyChapterService = new StoryChapterService();
            $storyDownloadService = new StoryDownloadService();
            $story_id = $request->story;
            $title = $request->title;
            $image_cover = $request->file('image_cover');
            $content_chapter = $request->content_chapter;
            $order_chapter = $request->order_chapter;
            $link_audio_play = $request->link_audio_play;
            //Insert new story
            $chapter_id = $storyChapterService->insertNewChapter($story_id, $title, $image_cover, $content_chapter, $order_chapter, $link_audio_play);

            if ($chapter_id == 'fail-order-chapter') {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Order chapter is available!'];
            }
            else {
                //insert link download audio
                if ($request->host_download_audio != null) {
                    $audio_host_downloads = $request->host_download_audio;
                    $audio_link_downloads = $request->link_download_audio;
                    $audio_file_types = $request->file_type_audio;
                    foreach ($audio_host_downloads as $index_audio => $audio_host_download) {
                        $storyDownloadService->insertNewLinkDownloadAudio($chapter_id, $audio_host_download, $audio_link_downloads[$index_audio], $audio_file_types[$index_audio]);
                    }
                }

                //insert link download ebook
                if ($request->host_download_ebook != null) {
                    $ebook_host_downloads = $request->host_download_ebook;
                    $ebook_link_downloads = $request->link_download_ebook;
                    $ebook_file_types = $request->file_type_ebook;
                    foreach ($ebook_host_downloads as $index_ebook => $ebook_host_download) {
                        $storyDownloadService->insertNewLinkDownloadEbook($chapter_id, $ebook_host_download, $ebook_link_downloads[$index_ebook], $ebook_file_types[$index_ebook]);
                    }
                }
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Upload new chapter english story success!'];
            }
            return redirect()->back()->with($message);
        }
    }

    public function getCreateNewComponentStory($domain, $type) {
        return view('admin.storyCreateNewComponent', compact('type'));
    }

    public function postCreateNewComponentStory($domain, $type, NameItemRequest $request) {
        $validator = validator($request->All(), $request->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $englishStoryService = new StoryEnglishService();
            $level = $request->level;
            $introduction = $request->introduction;
            $result = $englishStoryService->createNewComponentStory($type, $level, $introduction);
            if ($result == 'success') {
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo ' . $type . ' story thành công!'];
            }
            elseif ($result == 'fail-available') {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>$type . ' story này đã tồn tại!'];
            }
            else {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Component ' . $type . ' story này không có!'];
            }
            return redirect()->back()->with($message);
        }
    }

    public function getAllOrderedChapterOfStory($domain, $story_id) {
        $storyChapterService = new StoryChapterService();
        $chapter_orders = $storyChapterService->getAllOrderedChapterOfStory($story_id);
        $miss_orders = getMissOrderChapter($chapter_orders);
        return json_encode(['chapter_orders' => $chapter_orders, 'miss_orders' => $miss_orders]);
    }
}
