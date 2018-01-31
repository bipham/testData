<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishGenre extends Model
{
    protected $table = 'story_english_genres';

    protected $fillable = ['genre', 'introduction', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function englishStories()
    {
        return $this->hasMany('App\Models\StoryEnglish', 'genre_id');
    }

    public function createNewGenreStory($genre, $introduction, $admin_responsibility) {
        if ($this->where('genre', $genre)->exists()) {
            // level found
            return 'fail-available';
        }
        else {
            $new_genre_story = new StoryEnglishGenre();
            $new_genre_story->genre = $genre;
            $new_genre_story->introduction = $introduction;
            $new_genre_story->admin_responsibility = $admin_responsibility;
            $new_genre_story->save();
            return 'success';
        }
    }

    public function getAllStoryGenreForUploadStory() {
        return $this->where('status', 1)->select('id', 'genre')->get()->all();
    }

    public function getNameOfGenres($genre_id) {
        return $this->where('status', 1)->where('id', $genre_id)->select('genre')->get()->first();
    }
}
