<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishLength extends Model
{
    protected $table = 'story_english_lengths';

    protected $fillable = ['length', 'introduction', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function englishStories()
    {
        return $this->hasMany('App\Models\StoryEnglish', 'length_id');
    }

    public function createNewLengthStory($length, $introduction, $admin_responsibility) {
        if ($this->where('length', $length)->exists()) {
            // level found
            return 'fail-available';
        }
        else {
            $new_genre_story = new StoryEnglishLength();
            $new_genre_story->length = $length;
            $new_genre_story->introduction = $introduction;
            $new_genre_story->admin_responsibility = $admin_responsibility;
            $new_genre_story->save();
            return 'success';
        }
    }

    public function getAllStoryLengthForUploadStory() {
        return $this->where('status', 1)->select('id', 'length')->get()->all();
    }
}
