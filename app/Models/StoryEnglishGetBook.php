<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishGetBook extends Model
{
    protected $table = 'story_english_get_books';

    protected $fillable = ['story_id', 'host_id', 'link', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function hostDownload()
    {
        return $this->belongsTo('App\Models\HostDownload', 'host_id');
    }

    public function insertNewLinkGetBook($story_id, $host_id, $link, $admin_responsibility) {
        $new_link_get_book = new StoryEnglishGetBook();
        $new_link_get_book->story_id = $story_id;
        $new_link_get_book->host_id = $host_id;
        $new_link_get_book->link = $link;
        $new_link_get_book->admin_responsibility = $admin_responsibility;
        $new_link_get_book->save();
        return $new_link_get_book->id;
    }

    public function getAllLinkGetBookOfStory($story_id) {
        return $this->where('status', 1)->where('story_id', $story_id)->select('host_id', 'link')->get()->all();
    }
}
