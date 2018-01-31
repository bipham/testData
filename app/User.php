<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'level_user_id', 'fullname', 'address', 'city', 'district', 'phone', 'dob', 'avatar','activated', 'admin_responsibility', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function practiceLessons()
    {
        return $this->hasMany('App\Models\ReadingPracticeLesson', 'admin_responsibility');
    }

    public function mixTests()
    {
        return $this->hasMany('App\Models\ReadingMixTestLesson', 'admin_responsibility');
    }

    public function typeQuestions()
    {
        return $this->hasMany('App\Models\ReadingTypeQuestion', 'admin_responsibility');
    }

    public function lessonQuestionAnswers()
    {
        return $this->hasMany('App\Models\ReadingQuestionAndAnswerLesson', 'user_id');
    }

    public function resultLessons()
    {
        return $this->hasMany('App\Models\ReadingResultLesson', 'user_id');
    }

    public function levelUser()
    {
        return $this->belongsTo('App\Models\ReadingLevelUser', 'level_user_id');
    }

    public function createNewUser($username, $email, $password, $level_user_id, $avatar, $remember_token, $admin_responsibility) {
        $new_user = new User();
        $new_user->username = $username;
        $new_user->email = $email;
        $new_user->password = $password;
        $new_user->level_user_id = $level_user_id;
        $new_user->avatar = $avatar;
        $new_user->remember_token = $remember_token;
        $new_user->admin_responsibility = $admin_responsibility;
//        $new_user->activated = 1;
        $new_user->save();
        return true;
    }

    public function updateNewPasswordOfUser($new_password, $user_id) {
        $this->where('id', $user_id)->where('status', 1)->update(['password' => Hash::make($new_password), 'activated' => 1, 'updated_at' => Carbon::now()]);
        return 'success';
    }

    public function checkPasswordCurrent($current_password, $user_id) {
        $your_password = Auth::user()->password;
        if (Hash::check($current_password, $your_password)) {
            return true;
        }
        else return false;
    }

    public function getLevelCurrentUser($user_id) {
        return $this->where('id', $user_id)->where('status', 1)->select('id', 'level_user_id')->get()->first();
    }

    public function getAllAdmins() {
        return $this->where('status', 1)->where('level_user_id', 1)->select('id')->get()->all();
    }

    public function getUserInfo($user_id) {
        return $this->where('status', 1)->where('id', $user_id)->select('id', 'username', 'email', 'level_user_id', 'fullname', 'avatar', 'phone', 'dob')->get()->first();
    }

    public function checkStatusUser($user_id) {
        if ($this->where('id', $user_id)->where('status', 1)->exists()) {
            // Record found
            return true;
        }
        else return false;
    }

    public function updateAvatarUser($user_id, $filename) {
        return $this->where('id', $user_id)->update(['avatar' => $filename, 'updated_at' => Carbon::now()]);
    }
}
