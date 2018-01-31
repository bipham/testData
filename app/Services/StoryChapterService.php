<?php namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\StoryEnglishChapter;
use App\Services\StoryEnglishService;

class StoryChapterService {
    private $_storyEnglishChapterModel;
    private $_storyEnglishServiceModel;
    private $_adminId;

    public function __construct()
    {
        $this->_storyEnglishChapterModel = new StoryEnglishChapter();
        $this->_storyEnglishServiceModel = new StoryEnglishService();
        $this->_adminId = Auth::id();
    }

    public function getAllOrderedChapterOfStory($story_id) {
        return $this->_storyEnglishChapterModel->getAllOrderedChapterOfStory($story_id);
    }

    public function insertNewChapter($story_id, $title, $image_cover, $content_chapter, $order_chapter, $link_audio_play) {
        $title_story = $this->_storyEnglishServiceModel->getTitleStory($story_id);
        if ($image_cover != null) {
            $directory_save = public_path('/storage/img/english_stories/') . stripUnicode($title_story->title) . '/';
            $filename = storeImageToLocal($title, $image_cover, $directory_save);
        }
        else {
            $filename = null;
        }
        $link_play = getLinkPlayAudioGoogle($link_audio_play);
        return $this->_storyEnglishChapterModel->insertNewChapter($story_id, $title, $filename, $content_chapter, $order_chapter, $link_play, $this->_adminId);
    }

    public function getAllChapterOfStoryViewDetail($story_id) {
        return $this->_storyEnglishChapterModel->getAllChapterOfStoryViewDetail($story_id);
    }
}
?>