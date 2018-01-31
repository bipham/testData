/**
 * Created by BiPham on 18/11/2017.
 */
var type_lesson_id = $('.reading-solution-button-test').data('type-lesson-id');
function showSolutionOverview() {
    $('.solution-detail-page').addClass('hidden');
    $('.btn-show-overview-solution').addClass('hidden');
    $('.overview-solution-detail-section').removeClass('hidden');
    $('.btn-show-detail-solution').removeClass('hidden');
    if (type_lesson_id  == 4) {
        $('.btn-full-test-area').addClass('hidden');
    }
}

function showSolutionDetail() {
    $('.solution-detail-page').removeClass('hidden');
    $('.btn-show-overview-solution').removeClass('hidden');
    $('.overview-solution-detail-section').addClass('hidden');
    $('.btn-show-detail-solution').addClass('hidden');
    if (type_lesson_id  == 4) {
        $('.btn-full-test-area').removeClass('hidden');
    }
}

function showParagraph(order_paragraph) {
    $('.paragraph-detail.paragraph-detail-' + order_paragraph).removeClass('hidden');
    $('.paragraph-detail').not('.paragraph-detail-' + order_paragraph).addClass('hidden');
    $('.explanation-column').addClass('hidden');
    $('.solution-detail').removeClass('transform-scale-width-custom-active');
    $('.explanation-column').removeClass('transform-right-custom-active');
    $('.btn-show-paragraph-' + order_paragraph).attr('disabled', true);
    $('.btn-full-test-section').not('.btn-show-paragraph-' + order_paragraph).attr('disabled', false);
}