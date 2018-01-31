<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostDownload extends Model
{
    protected $table = 'host_downloads';

    protected $fillable = ['name', 'logo', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function storyAudioDownloads()
    {
        return $this->hasMany('App\Models\StoryEnglishDownloadAudio', 'host_id');
    }

    public function storyEbookDownloads()
    {
        return $this->hasMany('App\Models\StoryEnglishDownloadAudio', 'host_id');
    }

    public function storyDownloadFulls()
    {
        return $this->hasMany('App\Models\StoryEnglishDownloadFull', 'host_id');
    }

    public function storyGetBooks()
    {
        return $this->hasMany('App\Models\StoryEnglishGetBook', 'host_id');
    }

    public function createNewHostDownload($name, $logo, $admin_responsibility) {
        if ($this->where('name', $name)->exists()) {
            // query found
            return 'fail-available';
        }
        else {
            $new_genre_story = new HostDownload();
            $new_genre_story->name = $name;
            $new_genre_story->logo = $logo;
            $new_genre_story->admin_responsibility = $admin_responsibility;
            $new_genre_story->save();
            return 'success';
        }
    }

    public function getAllHostForUploadStory() {
        return $this->where('status', 1)->select('id', 'name')->get()->all();
    }
}
