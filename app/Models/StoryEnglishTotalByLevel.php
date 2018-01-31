<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StoryEnglishTotalByLevel extends Model
{
    protected $table = 'story_english_total_by_levels';

    protected $fillable = ['level_story_id', 'total_stories'];

    public $timestamps = true;

    public function updateNewTotalStoryWhenInsertNew($level_story_id) {
        $query_total_stories = $this->where('level_story_id', $level_story_id)->select('total_stories')->get()->first();
        if ($query_total_stories != null) {
            // Record found
            $total_stories = $query_total_stories->total_stories + 1;
            $this->where('level_story_id', $level_story_id)->update(['total_stories' => $total_stories, 'updated_at' => Carbon::now()]);
            return $total_stories;
        }
        else {
            $new_total_stories = new StoryEnglishTotalByLevel();
            $new_total_stories->level_story_id = $level_story_id;
            $new_total_stories->total_stories = 1;
            $new_total_stories->save();
            return $new_total_stories->total_stories;
        }
    }

    public function getNumberStoriesEachTypeLevel() {
        return $this->select('level_story_id', 'total_stories')->get()->all();
    }
}
