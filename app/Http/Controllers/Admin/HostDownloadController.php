<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\HostDownloadService;
use App\Http\Requests\ImageWithNameRequest;
class HostDownloadController extends Controller
{
    public function getCreateNewHostDownload ($domain) {
        return view('admin.hostDownloadCreateNew');
    }

    public function postCreateNewHostDownload($domain, ImageWithNameRequest $request) {
//        dd($request->All());
        $validator = validator($request->All(), $request->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator->errors());
        }
        else {
            $name = $request->name;
            $logo = $request->file('image_feature');
            $hostDownloadService = new HostDownloadService();
            $result = $hostDownloadService->createNewHostDownload($name, $logo);
            if ($result == 'success') {
                $message = ['flash_level'=>'success message-custom','flash_message'=>'Tạo host download thành công!'];
            }
            else {
                $message = ['flash_level'=>'danger message-custom','flash_message'=>'Host download này đã tồn tại!'];
            }
            return redirect()->back()->with($message);
        }
    }
}
