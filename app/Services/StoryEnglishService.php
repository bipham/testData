<?php namespace App\Services;

use App\Models\StoryEnglish;
use Illuminate\Support\Facades\Auth;
use App\Models\StoryEnglishLevel;
use App\Models\StoryEnglishGenre;
use App\Models\StoryEnglishLength;
use App\Models\StoryEnglishTotalByLevel;
use Image;

class StoryEnglishService {
    private $_storyEnglishModel;
    private $_storyEnglishLevelModel;
    private $_storyEnglishGenreModel;
    private $_storyEnglishLengthModel;
    private $_storyEnglishTotalByLevelModel;
    private $_adminId;

    public function __construct()
    {
        $this->_storyEnglishModel = new StoryEnglish();
        $this->_storyEnglishLevelModel = new StoryEnglishLevel();
        $this->_storyEnglishGenreModel = new StoryEnglishGenre();
        $this->_storyEnglishLengthModel = new StoryEnglishLength();
        $this->_storyEnglishTotalByLevelModel = new StoryEnglishTotalByLevel();
        $this->_adminId = Auth::id();
    }

    public function createNewComponentStory($type, $level, $introduction) {
        if ($type == 'level') {
            return $this->_storyEnglishLevelModel->createNewLevelStory($level, $introduction, $this->_adminId);
        }
        elseif ($type == 'genre') {
            return $this->_storyEnglishGenreModel->createNewGenreStory($level, $introduction, $this->_adminId);
        }
        elseif ($type == 'length') {
            return $this->_storyEnglishLengthModel->createNewLengthStory($level, $introduction, $this->_adminId);
        }
        else return 'fail-type';
    }

    public function getAllStoryLevelForUploadStory() {
        return $this->_storyEnglishLevelModel->getAllStoryLevelForUploadStory();
    }

    public function getAllStoryGenreForUploadStory() {
        return $this->_storyEnglishGenreModel->getAllStoryGenreForUploadStory();
    }

    public function getAllStoryLengthForUploadStory() {
        return $this->_storyEnglishLengthModel->getAllStoryLengthForUploadStory();
    }

    public function getAllEnglishStoriesForUploadChapter() {
        return $this->_storyEnglishModel->getAllEnglishStoriesForUploadChapter();
    }

    public function insertNewStory($title, $image_cover, $description, $author_id, $story_level_id, $genre_id, $length_id) {
        if ($image_cover != null) {
            $filename = stripUnicode($title) . '.' . $image_cover->getClientOriginalExtension();
        }
        else {
            $filename = 'english_story.jpg';
        }
        $story_id = $this->_storyEnglishModel->insertNewStory($title, $filename, $description, $author_id, $story_level_id, $genre_id, $length_id, $this->_adminId);
        $this->_storyEnglishTotalByLevelModel->updateNewTotalStoryWhenInsertNew($story_level_id);
        if ($image_cover != null) {
            $directory_save = public_path('/storage/img/english_stories/story-') . $story_id . '/';
            storeImageToLocal($filename, $image_cover, $directory_save);
        }
        return $story_id;
    }

    public function getTitleStory($story_id) {
        return $this->_storyEnglishModel->getTitleStory($story_id);
    }

    public function getStoryViewDetail($story_id) {
        return $this->_storyEnglishModel->getStoryViewDetail($story_id);
    }

    public function updateOneClickViewStory($story_id) {
        return $this->_storyEnglishModel->updateOneClickViewStory($story_id);
    }

    public function getTopViewedStories($number) {
        return $this->_storyEnglishModel->getTopViewedStories($number);
    }

    public function getNewestStories($number) {
        return $this->_storyEnglishModel->getNewestStories($number);
    }

    public function getAllGenresOfAuthor($author_id) {
        return $this->_storyEnglishModel->getAllGenresOfAuthor($author_id);
    }

    public function getNameOfGenres($genre_id) {
        return $this->_storyEnglishGenreModel->getNameOfGenres($genre_id);
    }

    public function getAuthorStoryOfWeek($number) {
        return $this->_storyEnglishModel->getAuthorStoryOfWeek($number);
    }

    public function getNumberStoriesEachTypeLevel() {
        return $this->_storyEnglishTotalByLevelModel->getNumberStoriesEachTypeLevel();
    }
}
?>