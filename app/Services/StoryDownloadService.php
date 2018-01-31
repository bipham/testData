<?php namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\StoryEnglishDownloadAudio;
use App\Models\StoryEnglishDownloadEbook;
use App\Models\StoryEnglishDownloadFull;
use App\Models\StoryEnglishGetBook;
class StoryDownloadService {
    private $_storyEnglishDownloadAudioModel;
    private $_storyEnglishDownloadEbookModel;
    private $_storyEnglishDownloadFullModel;
    private $_storyEnglishGetBookFullModel;
    private $_adminId;

    public function __construct()
    {
        $this->_storyEnglishDownloadAudioModel = new StoryEnglishDownloadAudio();
        $this->_storyEnglishDownloadEbookModel = new StoryEnglishDownloadEbook();
        $this->_storyEnglishDownloadFullModel = new StoryEnglishDownloadFull();
        $this->_storyEnglishGetBookFullModel = new StoryEnglishGetBook();
        $this->_adminId = Auth::id();
    }

    public function insertNewLinkDownloadFull($story_id, $type, $host_id, $link, $file_type) {
        return $this->_storyEnglishDownloadFullModel->insertNewLinkDownloadFull($story_id, $type, $host_id, $link, $file_type, $this->_adminId);
    }

    public function insertNewLinkGetBook($story_id, $host_id, $link) {
        return $this->_storyEnglishGetBookFullModel->insertNewLinkGetBook($story_id, $host_id, $link, $this->_adminId);
    }

    public function insertNewLinkDownloadAudio($chapter_id, $host_id, $link, $file_type) {
        return $this->_storyEnglishDownloadAudioModel->insertNewLinkDownloadAudio($chapter_id, $host_id, $link, $file_type, $this->_adminId);
    }

    public function insertNewLinkDownloadEbook($chapter_id, $host_id, $link, $file_type) {
        return $this->_storyEnglishDownloadEbookModel->insertNewLinkDownloadEbook($chapter_id, $host_id, $link, $file_type, $this->_adminId);
    }

    public function getAllLinkFullDownloadOfStory($story_id) {
        $full_downloads = $this->_storyEnglishDownloadFullModel->getAllLinkFullDownloadOfStory($story_id);
        if (sizeof($full_downloads) > 0) {
            $link_full_downloads['full'] = [];
            $link_full_downloads['ebook'] = [];
            $link_full_downloads['audio'] = [];
            foreach ($full_downloads as $index => $full_download) {
                if ($full_download->type == 1) {
                    array_push($link_full_downloads['full'], $full_download);
                }
                else if ($full_download->type == 1) {
                    array_push($link_full_downloads['ebook'], $full_download);
                }
                else {
                    array_push($link_full_downloads['audio'], $full_download);
                }
            }
            return $link_full_downloads;
        }
        else return $full_downloads;
    }

    public function getAllLinkGetBookOfStory($story_id) {
        return $this->_storyEnglishGetBookFullModel->getAllLinkGetBookOfStory($story_id);
    }

    public function getAllDownloadChapterOfStory($story_id, $chapters) {
        $chapter_downloads = [];
        foreach ($chapters as $index => $chapter) {
            $array_chapter_download['audio'] = $this->_storyEnglishDownloadAudioModel->getAllLinkDownloadAudioOfChapter($chapter->id);
            $array_chapter_download['ebook'] = $this->_storyEnglishDownloadEbookModel->getAllLinkDownloadEbookOfChapter($chapter->id);
            if (sizeof($array_chapter_download['audio']) > 0 || sizeof($array_chapter_download['ebook']) > 0) {
                $array_chapter_download['title'] = $chapter->title_chapter;
                $array_chapter_download['chapter_id'] = $chapter->id;
                array_push($chapter_downloads, $array_chapter_download);
            }
        }
        return $chapter_downloads;
    }
}
?>