<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishDownloadFull extends Model
{
    protected $table = 'story_english_download_fulls';

    protected $fillable = ['story_id', 'type', 'host_id', 'link', 'file_type', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function hostDownload()
    {
        return $this->belongsTo('App\Models\HostDownload', 'host_id');
    }

    public function insertNewLinkDownloadFull($story_id, $type, $host_id, $link, $file_type, $admin_responsibility) {
        $new_link_download = new StoryEnglishDownloadFull();
        $new_link_download->story_id = $story_id;
        $new_link_download->type = $type;
        $new_link_download->host_id = $host_id;
        $new_link_download->link = $link;
        $new_link_download->file_type = $file_type;
        $new_link_download->admin_responsibility = $admin_responsibility;
        $new_link_download->save();
        return $new_link_download->id;
    }

    public function getAllLinkFullDownloadOfStory($story_id) {
        return $this->where('status', 1)->where('story_id', $story_id)->select('type', 'host_id', 'link', 'file_type')->get()->all();
    }
}
