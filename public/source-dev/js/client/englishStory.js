/**
 * Created by nobikun1412 on 04/12/2017.
 */
$(document).ready(function(){
    $('.slider-top-view-story').slick({
        dots: true,
        infinite: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 500
    });

    // On after slide change
    $('.slider-top-view-story').on('beforeChange', function(event, slick, currentSlide, nextSlide){
        var current_image = $('.slider-top-view-story-outer').data('image-number');
        var random = Math.floor(Math.random() * 3) + 1;
        if (current_image == random) {
            if (random == 3) {
                random--;
            }
            else {
                random++;
            }
        }
        $('.slider-top-view-story-outer').data('image-number', random);
        var random_image = 'url(/imgs/story/' + random + '.jpg) center no-repeat fixed';
        console.log(random);
        $('.slider-top-view-story-outer').css('background', random_image);
        $('.slider-top-view-story-outer').css('background-size', 'cover');
    });

    $('.slider-author-of-week').slick({
        dots: true,
        infinite: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        speed: 500
    });

    $('.slider-newest-stories').slick({
        centerMode: true,
        centerPadding: '60px',
        infinite: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
});