<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishLevel extends Model
{
    protected $table = 'story_english_levels';

    protected $fillable = ['level', 'introduction', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function englishStories()
    {
        return $this->hasMany('App\Models\StoryEnglish', 'level_story_id');
    }

    public function createNewLevelStory($level, $introduction, $admin_responsibility) {
        if ($this->where('level', $level)->exists()) {
            // level found
            return 'fail-available';
        }
        else {
            $new_level_story = new StoryEnglishLevel();
            $new_level_story->level = $level;
            $new_level_story->introduction = $introduction;
            $new_level_story->admin_responsibility = $admin_responsibility;
            $new_level_story->save();
            return 'success';
        }
    }

    public function getAllStoryLevelForUploadStory() {
        return $this->where('status', 1)->select('id', 'level')->get()->all();
    }
}
