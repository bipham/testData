/**
 * Created by BiPham on 03/12/2017.
 */
var index_download_audio = 0;
var index_download_ebook = 0;

function insertFormDownloadAudioChapter() {
    $('.link-download-audio-area').append(
        '<div class="link-download-container link-download-audio-container-' + index_download_audio + '">' +
            '<h6 class="title-link-download">Link Download Audio</h6>' +
            '<div class="form-group">' +
                '<label for="host_download_audio_' + index_download_audio + '">' +
                    'Select Host: ' +
                '</label>' +
                '<select class="form-control" id="host_download_audio_' + index_download_audio + '" name="host_download_audio[' + index_download_audio + ']">' +
                    option_host_downloads +
                '</select>' +
            '</div>' +
            '<div class="form-group">' +
                '<label for="link_download_audio_' + index_download_audio + '">' +
                    'Enter link download audio: ' +
                '</label>' +
                '<input type="text" class="form-control" placeholder="Link download audio" id="link_download_audio_' + index_download_audio + '" name="link_download_audio[' + index_download_audio + ']" required>' +
            '</div>' +
            '<div class="form-group">' +
                '<label for="file_type_audio_' + index_download_audio + '">' +
                    'Enter file type audio (extension): ' +
                '</label>' +
                '<input type="text" class="form-control" placeholder="File type audio" id="file_type_audio_' + index_download_audio + '" name="file_type_audio[' + index_download_audio + ']" required>' +
            '</div>' +
            '<button type="button" class="btn btn-danger btn-delete-form-download" onclick="deleteFormDownloadAudioChapter(' + index_download_audio + ')">' +
                'Delete Link Download Audio' +
            '</button>' +
        '</div>'
    );
    index_download_audio++;
}

function insertFormDownloadEbookChapter() {
    $('.link-download-ebook-area').append(
        '<div class="link-download-container link-download-ebook-container-' + index_download_ebook + '">' +
            '<h6 class="title-link-download">Link Download Ebook</h6>' +
            '<div class="form-group">' +
                '<label for="host_download_ebook_' + index_download_ebook + '">' +
                    'Select Host: ' +
                '</label>' +
                '<select class="form-control" id="host_download_ebook_' + index_download_ebook + '" name="host_download_ebook[' + index_download_ebook + ']">' +
                    option_host_downloads +
                '</select>' +
            '</div>' +
            '<div class="form-group">' +
                '<label for="link_download_ebook_' + index_download_ebook + '">' +
                    'Enter link download ebook: ' +
                '</label>' +
                '<input type="text" class="form-control" placeholder="Link download ebook" id="link_download_ebook_' + index_download_ebook + '" name="link_download_ebook[' + index_download_ebook + ']" required>' +
            '</div>' +
            '<div class="form-group">' +
                '<label for="file_type_ebook_' + index_download_ebook + '">' +
                    'Enter file type ebook (extension): ' +
                '</label>' +
                '<input type="text" class="form-control" placeholder="File type ebook" id="file_type_ebook_' + index_download_ebook + '" name="file_type_ebook[' + index_download_ebook + ']" required>' +
            '</div>' +
            '<button type="button" class="btn btn-danger btn-delete-form-download" onclick="deleteFormDownloadEbookChapter(' + index_download_ebook + ')">' +
                'Delete Link Download Ebook' +
            '</button>' +
        '</div>'
    );
    index_download_ebook++;
}

function deleteFormDownloadAudioChapter(i) {
    $('.link-download-audio-container-' + i).remove();
}

function deleteFormDownloadEbookChapter(i) {
    $('.link-download-ebook-container-' + i).remove();
}

$('#list_stories').on('change', function () {
    var story_id = $(this).val().trim();
    var ajaxGetOrderedChapterOfStory = baseUrl + '/getAllOrderedChapterOfStory/' + story_id;
    $.ajax({
        type: "GET",
        url: ajaxGetOrderedChapterOfStory,
        dataType: "json",
        success: function (data) {
            console.log('chapter: ' + JSON.stringify(data));
            updateOrderChapterStory('', data.miss_orders[0], data.all_orders)
        },
        error: function (data) {
            bootbox.alert({
                message: "FAIL GET ALL TYPE QUESTION!",
                backdrop: true
            });
        }
    });
});