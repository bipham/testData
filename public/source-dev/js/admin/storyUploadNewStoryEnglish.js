/**
 * Created by BiPham on 03/12/2017.
 */
var index_download = 0;
var index_get_book = 0;

function insertFormDownloadStory() {
    $('.link-download-area').append(
        '<div class="link-download-container link-download-container-' + index_download + '">' +
        '<h6 class="title-link-download">Link Download</h6>' +
        '<div class="form-group">' +
        '<label for="type_download_' + index_download + '">' +
        'Select Type: ' +
        '</label>' +
        '<select class="form-control" id="type_download_' + index_download + '" name="type_download[' + index_download + ']">' +
        '<option value="1">Full Audio + Ebook</option>' +
        '<option value="2">Ebook</option>' +
        '<option value="3">Audio</option>' +
        '</select>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="host_download_' + index_download + '">' +
        'Select Host: ' +
        '</label>' +
        '<select class="form-control" id="host_download_' + index_download + '" name="host_download[' + index_download + ']">' +
        option_host_downloads +
        '</select>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="link_download_' + index_download + '">' +
        'Enter link download: ' +
        '</label>' +
        '<input type="text" class="form-control" placeholder="Link download" id="link_download_' + index_download + '" name="link_download[' + index_download + ']" required>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="file_type_' + index_download + '">' +
        'Enter file type (extension): ' +
        '</label>' +
        '<input type="text" class="form-control" placeholder="File type" id="file_type_' + index_download + '" name="file_type[' + index_download + ']" required>' +
        '</div>' +
        '<button type="button" class="btn btn-danger btn-delete-form-download" onclick="deleteFormDownloadStory(' + index_download + ')">' +
        'Delete Link Download' +
        '</button>' +
        '</div>'
    );
    index_download++;
}

function insertFormGetBook() {
    $('.link-get-book-area').append(
        '<div class="link-download-container link-get-book-container-' + index_get_book + '">' +
        '<h6 class="title-link-get-book">Link Get Book</h6>' +
        '<div class="form-group">' +
        '<label for="host_get_book_' + index_get_book + '">' +
        'Select Host: ' +
        '</label>' +
        '<select class="form-control" id="host_get_book_' + index_get_book + '" name="host_get_book[' + index_get_book + ']">' +
        option_host_downloads +
        '</select>' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="link_get_book_' + index_get_book + '">' +
        'Enter link get book: ' +
        '</label>' +
        '<input type="text" class="form-control" placeholder="Link get book" id="link_get_book_' + index_get_book + '" name="link_get_book[' + index_get_book + ']" required>' +
        '</div>' +
        '<button type="button" class="btn btn-danger btn-delete-form-get-book" onclick="deleteFormGetBook(' + index_get_book + ')">' +
        'Delete Link Get Book' +
        '</button>' +
        '</div>'
    );
    index_get_book++;
}

function deleteFormDownloadStory(i) {
    $('.link-download-container-' + i).remove();
}

function deleteFormGetBook(i) {
    $('.link-get-book-container-' + i).remove();
}