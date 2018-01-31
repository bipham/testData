<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishDownloadAudio extends Model
{
    protected $table = 'story_english_download_audios';

    protected $fillable = ['chap_id', 'host_id', 'link', 'file_type', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function hostDownload()
    {
        return $this->belongsTo('App\Models\HostDownload', 'host_id');
    }

    public function insertNewLinkDownloadAudio($chap_id, $host_id, $link, $file_type, $admin_responsibility) {
        $new_link_download_audio = new StoryEnglishDownloadAudio();
        $new_link_download_audio->chap_id = $chap_id;
        $new_link_download_audio->host_id = $host_id;
        $new_link_download_audio->link = $link;
        $new_link_download_audio->file_type = $file_type;
        $new_link_download_audio->admin_responsibility = $admin_responsibility;
        $new_link_download_audio->save();
        return $new_link_download_audio->id;
    }

    public function getAllLinkDownloadAudioOfChapter($chapter_id) {
        return $this->where('status', 1)->where('chap_id', $chapter_id)->select('host_id', 'link', 'file_type')->get()->all();
    }
}
