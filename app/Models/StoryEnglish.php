<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoryEnglish extends Model
{
    protected $table = 'story_englishes';

    protected $fillable = ['title', 'image_cover', 'description', 'author_id', 'level_story_id', 'genre_id', 'length_id', 'viewed', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function levelStory()
    {
        return $this->belongsTo('App\Models\StoryEnglishLevel', 'level_story_id');
    }

    public function genreStory()
    {
        return $this->belongsTo('App\Models\StoryEnglishGenre', 'genre_id');
    }

    public function lengthStory()
    {
        return $this->belongsTo('App\Models\StoryEnglishLength', 'length_id');
    }

    public function authorStory()
    {
        return $this->belongsTo('App\Models\StoryAuthor', 'author_id');
    }

    public function insertNewStory($title, $image_cover, $description, $author_id, $story_level_id, $genre_id, $length_id, $admin_responsibility) {
        $random_view = rand(99,999);
        $new_english_story = new StoryEnglish();
        $new_english_story->title = $title;
        $new_english_story->image_cover = $image_cover;
        $new_english_story->description = $description;
        $new_english_story->author_id = $author_id;
        $new_english_story->level_story_id = $story_level_id;
        $new_english_story->genre_id = $genre_id;
        $new_english_story->length_id = $length_id;
        $new_english_story->viewed = $random_view;
        $new_english_story->admin_responsibility = $admin_responsibility;
        $new_english_story->save();
        return $new_english_story->id;
    }

    public function getAllEnglishStoriesForUploadChapter() {
        return $this->where('status', 1)->select('id', 'title', 'image_cover')->get()->all();
    }

    public function getTitleStory($story_id) {
        return $this->where('status', 1)->where('id', $story_id)->select('title')->get()->first();
    }

    public function getTopViewedStories($number) {
        return $this->where('status', 1)->select('id', 'title', 'image_cover', 'description', 'author_id', 'level_story_id', 'genre_id', 'length_id', 'viewed')->orderBy('viewed', 'desc')->take($number)->get()->all();
    }

    public function getNewestStories($number) {
        return $this->where('status', 1)->select('id', 'title', 'image_cover', 'description', 'author_id', 'level_story_id', 'genre_id', 'length_id', 'viewed')->orderBy('created_at', 'desc')->take($number)->get()->all();
    }

    public function getAuthorStoryOfWeek($number) {
        $authors = DB::table('story_englishes')
            ->where('status', 1)
            ->select('author_id', DB::raw('SUM(viewed) as total_viewed'))
            ->groupBy('author_id')
            ->take($number)
            ->get();
        return $authors;
    }

    public function getAllGenresOfAuthor($author_id) {
        $genres = DB::table('story_englishes')
            ->where('status', 1)
            ->select('genre_id', DB::raw('SUM(viewed) as total_viewed_in_genre'))
            ->groupBy('genre_id')
            ->get();
        return $genres;
    }

    public function getStoryViewDetail($story_id) {
        return $this->where('status', 1)->where('id', $story_id)->select('title', 'image_cover', 'description', 'author_id', 'level_story_id', 'genre_id', 'length_id', 'viewed')->get()->first();
    }

    public function updateOneClickViewStory($story_id) {
        $viewed = $this->where('status', 1)->where('id', $story_id)->select('viewed')->get()->first();
        $update_viewed = $viewed->viewed + 1;
        return $this->where('status', 1)->where('id', $story_id)->update(['viewed' => $update_viewed, 'updated_at' => Carbon::now()]);
    }
}
