/**
 * Created by BiPham on 03/12/2017.
 */
function updateOrderChapterStory(story_id_current, new_order_chapter, all_orders) {
    story_id_current = story_id_current || '';
    var list_order = '';
    $('.list-ordered-' + story_id_current).empty();
    $.each(all_orders, function (index, order) {
        list_order += '<li>' + order.order_lesson + '</li>';
    });
    $('.list-ordered-' + story_id_current).append(list_order);
    $('#order_chapter' + story_id_current).val(new_order_chapter);
}