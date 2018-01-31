<?php namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\StoryAuthor;
use Image;
class StoryAuthorService {
    private $_storyAuthorModel;
    private $_adminId;

    public function __construct()
    {
        $this->_storyAuthorModel = new StoryAuthor();
        $this->_adminId = Auth::id();
    }

    public function createNewAuthorStory($name, $avatar, $introduction) {
        if ($avatar != null) {
            $filename = stripUnicode($name) . '.' . $avatar->getClientOriginalExtension();
            $directory_save = public_path('/storage/img/author_story/');
            storeImageToLocal($filename, $avatar, $directory_save);
        }
        else {
            $filename = 'author.jpg';
        }
        return $this->_storyAuthorModel->createNewAuthorStory($name, $filename, $introduction, $this->_adminId);
    }

    public function getAllAuthorsForUploadStory() {
        return $this->_storyAuthorModel->getAllAuthorsForUploadStory();
    }

    public function getDetailOfAuthor($author_id) {
        return $this->_storyAuthorModel->getDetailOfAuthor($author_id);
    }
}
?>