/**
 * Created by BiPham on 02/12/2017.
 */
function readImagePreview(input) {
    var image_name = $('input[type=file]').val().split('\\').pop();
    var image_extension = image_name.substr( (image_name.lastIndexOf('.') + 1) ).toLowerCase();
    var image_name_no_ext = image_name.split('.')[0];
    var allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if( allowedExtensions.indexOf(image_extension) == -1 ) {
        bootbox.alert({
            message: "Img not true format!",
            backdrop: true
        });
        $('#imgFeature').val('');
        image_name = '';
        image_name_no_ext = '';
        $("#image_preview").attr('src', '#');
        $("#image_preview").addClass('hidden-class');
        i++;
        return;
    }
    else {
        image_name = $('input[type=file]').val().split('\\').pop();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image_preview")
                    .attr('src', e.target.result)
                    .width(150);
                var image_url = e.target.result;
                $("#image_preview").removeClass('hidden-class');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

function changeImagePreviewOnOption(type) {
    if (type == 'story') {
        var avatar = $('#list_stories option:selected').data('avatar');
        var path_avatar = baseUrl + '/storage/img/english_stories/' + avatar;
    }
    else if (type == 'author') {
        var avatar = $('#list_authors option:selected').data('avatar');
        var path_avatar = baseUrl + '/storage/img/author_story/' + avatar;
    }
    $("#image_thumbnail_preview")
        .attr('src', path_avatar)
        .width(150);
    $("#image_thumbnail_preview").removeClass('hidden-class');
}