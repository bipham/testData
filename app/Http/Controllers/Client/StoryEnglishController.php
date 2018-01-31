<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StoryEnglishService;
use App\Services\StoryChapterService;
use App\Services\StoryDownloadService;
use App\Services\StoryAuthorService;
use Illuminate\Support\Facades\Redis;

class StoryEnglishController extends Controller
{
    public function viewStoryDetail($domain, $link_story) {
        $story_id = getIdFromLink($link_story);
//        $storage = Redis::Connection();
//        $views = $storage->incr('story:' . $story_id . ':views');
//        $storage->zIncrBy('storyViews', 1, 'story:' . $story_id);
//        dd($views);
        $storyEnglishService = new StoryEnglishService();
        $storyChapterService = new StoryChapterService();
        $storyDownloadService = new StoryDownloadService();
        $story = $storyEnglishService->getStoryViewDetail($story_id);
        $chapters = $storyChapterService->getAllChapterOfStoryViewDetail($story_id);
        $full_downloads = $storyDownloadService->getAllLinkFullDownloadOfStory($story_id);
        $link_get_books = $storyDownloadService->getAllLinkGetBookOfStory($story_id);
        $chapter_downloads = $storyDownloadService->getAllDownloadChapterOfStory($story_id, $chapters);
        $storyEnglishService->updateOneClickViewStory($story_id);
        return view('client.storyEnglishViewDetail', compact('story', 'chapters', 'full_downloads', 'link_get_books', 'chapter_downloads'));
    }

    public function getHomeStory($domain) {
        $storyEnglishService = new StoryEnglishService();
        $storyAuthorService = new StoryAuthorService();
        $top_viewed_stories = $storyEnglishService->getTopViewedStories(3);
        $number_stories = $storyEnglishService->getNumberStoriesEachTypeLevel();
        dd($top_viewed_stories);
        $new_stories = $storyEnglishService->getNewestStories(8);
        $authors = $storyEnglishService->getAuthorStoryOfWeek(3);
        $author_of_weeks = [];
        foreach ($authors as $author) {
            $author_of_week = $storyAuthorService->getDetailOfAuthor($author->author_id);
            $author_of_week['total_viewed'] = $author->total_viewed;
            array_push($author_of_weeks, $author_of_week);
        }
        $author_of_weeks[0]->englishStories()->select('id', 'title', 'image_cover')->orderBy('viewed', 'desc')->take(4)->get()->all();
        return view('client.storyEnglish', compact('top_viewed_stories', 'number_stories', 'new_stories', 'author_of_weeks'));
    }
}
