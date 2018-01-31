<?php namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\HostDownload;
use Image;
class HostDownloadService {
    private $_hostDownloadModel;
    private $_adminId;

    public function __construct()
    {
        $this->_hostDownloadModel = new HostDownload();
        $this->_adminId = Auth::id();
    }

    public function createNewHostDownload($name, $logo) {
        if ($logo != null) {
            $author_name = stripUnicode($name);
            $filename = $author_name . '.' . $logo->getClientOriginalExtension();
            $directory_save = public_path('/storage/img/host_data/');
            makeDirectory($directory_save);
            $destination = $directory_save . $filename;
            Image::make($logo)->save( $destination );
            compressImage($destination, $destination);
        }
        else {
            $filename = 'host.jpg';
        }
        return $this->_hostDownloadModel->createNewHostDownload($name, $filename, $this->_adminId);
    }

    public function getAllHostForUploadStory() {
        return $this->_hostDownloadModel->getAllHostForUploadStory();
    }
}
?>