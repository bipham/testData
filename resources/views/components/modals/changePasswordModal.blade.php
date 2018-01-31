<?php
/**
 * Created by PhpStorm.
 * User: BiPham
 * Date: 30/11/2017
 * Time: 12:22 PM
 */
?>
<!-- Button Edit Title Lesson-->
<button type="button" class="btn btn-primary btn-change-password" aria-hidden="true"  data-toggle="modal" data-target="#changePasswordModal">
    Change Password
</button>
<!-- Modal Change Password-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readingReviewQuizModalLabel">
                    Change Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{!!url('profile/userChangePassword/' . $user_info->id)!!}" method="POST">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Current password" id="current_password" name="current_password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="New password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-danger">
                        Change
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
