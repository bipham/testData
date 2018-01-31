/**
 * Created by BiPham on 30/11/2017.
 */
function readAvatarUpload(input) {
    var img_name = $('input[type=file]').val().split('\\').pop();
    var img_extension = img_name.substr( (img_name.lastIndexOf('.') + 1) ).toLowerCase();
    var allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( allowedExtensions.indexOf(img_extension) == -1 ) {
        bootbox.alert({
            message: "Img not true format!",
            backdrop: true
        });
        i++;
        return;
    }
    else {
        if (input.files[0].size <= 8000000) {
            img_name = $('input[type=file]').val().split('\\').pop();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(".img-avatar-profile")
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                $('.btn-update-avatar').removeClass('hidden');
            }
        }
        else {
            bootbox.alert({
                message: "Error, please select your avatar with size < 8MB!",
                backdrop: true
            });
            $('.btn-update-avatar').addClass('hidden');
        }
    }
}