<?php namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Image;

class UcenduUserService
{
    private $_readingUserModel;
    private $_adminId;

    public function __construct()
    {
        $this->_readingUserModel = new User();
        $this->_adminId = Auth::id();
    }

    public function createNewUser($username, $email, $password, $level_user_id, $avatar, $remember_token)
    {
        return $this->_readingUserModel->createNewUser($username, $email, $password, $level_user_id, $avatar, $remember_token, $this->_adminId);
    }

    public function updateNewPasswordOfUser($new_password) {
        return $this->_readingUserModel->updateNewPasswordOfUser($new_password, $this->_adminId);
    }

    public function checkPasswordCurrent($user_id, $current_password) {
        if ($user_id == $this->_adminId) {
            return $this->_readingUserModel->checkPasswordCurrent($current_password, $this->_adminId);
        }
        else return false;
    }

    public function getLevelCurrentUser() {
        return $this->_readingUserModel->getLevelCurrentUser($this->_adminId);
    }

    public function getAllAdmins() {
        $all_admins = $this->_readingUserModel->getAllAdmins();
        foreach ($all_admins as $index => $admin) {
            $all_admins[$index]->user_id = $admin->id;
        }
        return $all_admins;
    }

    public function getUserInfo($user_id) {
        return $this->_readingUserModel->getUserInfo($user_id);
    }

    public function checkStatusUser($user_id) {
        return $this->_readingUserModel->checkStatusUser($user_id);
    }

    public function updateAvatar($user_id, $request){
        if ((int)$user_id == $this->_adminId) {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $user_name = Auth::user()->username;
                $user_name = stripUnicode($user_name);
                $filename = $this->_adminId . '_' . $user_name . '.' . $avatar->getClientOriginalExtension();
                $destination = public_path('/storage/img/users/' . $filename );
                Image::make($avatar)->save( $destination );
                compressImage($destination, $destination);
                $this->_readingUserModel->updateAvatarUser($this->_adminId, $filename);
                return $this->_adminId;
            }
            else return 'update-fail';
        }
        else return 'not-permission';
    }
}
?>