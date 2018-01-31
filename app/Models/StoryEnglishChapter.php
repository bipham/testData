<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishChapter extends Model
{
    protected $table = 'story_english_chapters';

    protected $fillable = ['story_id', 'title_chapter', 'chapter_cover', 'order_chapter', 'content_chapter', 'audio_link', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function getAllOrderedChapterOfStory($story_id) {
        return $this->where('status', 1)->where('story_id', $story_id)->select('order_chapter')->orderBy('order_chapter', 'asc')->get()->all();
    }

    public function insertNewChapter($story_id, $title, $image_cover, $content_chapter, $order_chapter, $link_audio_play, $admin_responsibility) {
        if ($this->where('story_id', $story_id)->where('order_chapter', $order_chapter)->exists()) {
            // query found
            return 'fail-order-chapter';
        }
        else {
            $new_chapter = new StoryEnglishChapter();
            $new_chapter->story_id = $story_id;
            $new_chapter->title_chapter = $title;
            $new_chapter->chapter_cover = $image_cover;
            $new_chapter->content_chapter = $content_chapter;
            $new_chapter->order_chapter = $order_chapter;
            $new_chapter->audio_link = $link_audio_play;
            $new_chapter->admin_responsibility = $admin_responsibility;
            $new_chapter->save();
            return $new_chapter->id;
        }
    }

    public function getAllChapterOfStoryViewDetail($story_id) {
        return $this->where('status', 1)->where('story_id', $story_id)->select('id', 'title_chapter', 'chapter_cover', 'order_chapter', 'content_chapter', 'audio_link')->orderBy('order_chapter', 'asc')->get()->all();
    }
}
