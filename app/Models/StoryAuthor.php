<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryAuthor extends Model
{
    protected $table = 'story_authors';

    protected $fillable = ['name', 'avatar', 'introduction', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function englishStories()
    {
        return $this->hasMany('App\Models\StoryEnglish', 'author_id');
    }

    public function createNewAuthorStory($name, $avatar, $introduction, $admin_responsibility) {
        if ($this->where('name', $name)->exists()) {
            // query found
            return 'fail-available';
        }
        else {
            $new_genre_story = new StoryAuthor();
            $new_genre_story->name = $name;
            $new_genre_story->avatar = $avatar;
            $new_genre_story->introduction = $introduction;
            $new_genre_story->admin_responsibility = $admin_responsibility;
            $new_genre_story->save();
            return 'success';
        }
    }

    public function getAllAuthorsForUploadStory() {
        return $this->where('status', 1)->select('id', 'name', 'avatar')->orderBy('name', 'asc')->get()->all();
    }

    public function getDetailOfAuthor($author_id) {
        return $this->where('status', 1)->where('id', $author_id)->select('id', 'name', 'avatar', 'introduction')->get()->first();
    }
}
