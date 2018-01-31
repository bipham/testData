<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryEnglishDownloadEbook extends Model
{
    protected $table = 'story_english_download_ebooks';

    protected $fillable = ['chap_id', 'host_id', 'link', 'file_type', 'admin_responsibility', 'status'];

    public $timestamps = true;

    public function hostDownload()
    {
        return $this->belongsTo('App\Models\HostDownload', 'host_id');
    }

    public function insertNewLinkDownloadEbook($chap_id, $host_id, $link, $file_type, $admin_responsibility) {
        $new_link_download_ebook = new StoryEnglishDownloadEbook();
        $new_link_download_ebook->chap_id = $chap_id;
        $new_link_download_ebook->host_id = $host_id;
        $new_link_download_ebook->link = $link;
        $new_link_download_ebook->file_type = $file_type;
        $new_link_download_ebook->admin_responsibility = $admin_responsibility;
        $new_link_download_ebook->save();
        return $new_link_download_ebook->id;
    }

    public function getAllLinkDownloadEbookOfChapter($chapter_id) {
        return $this->where('status', 1)->where('chap_id', $chapter_id)->select('host_id', 'link', 'file_type')->get()->all();
    }
}
