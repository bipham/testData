/**
 * Created by BiPham on 10/10/2017.
 */
// Include gulp:
var gulp = require('gulp');

// Include plugins:
var sass = require('gulp-sass');
var concat = require('gulp-concat');
// let babel = require('gulp-babel');
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync');
var minifyCss = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
var notify = require("gulp-notify");

// Compile ...:
gulp.task('first-task', function(){
    console.log("Hello world")
});

// Compile Our CSS
gulp.task('css-both', function () {
    return gulp.src('public/source-dev/css/*.css')
        .pipe(minifyCss())
        .pipe(gulp.dest('public/css/'));
});

gulp.task('css-admin', function () {
    return gulp.src('public/source-dev/css/admin/*.css')
        .pipe(minifyCss())
        .pipe(gulp.dest('public/css/admin/'));
});

gulp.task('css-client', function () {
    return gulp.src('public/source-dev/css/client/*.css')
        .pipe(minifyCss())
        .pipe(gulp.dest('public/css/client/'));
});

// Compile Our JS
gulp.task('js-both', function () {
    return gulp.src('public/source-dev/js/*.js')
        .pipe(uglify())
        .on('error', function(err) {
            console.error('Error in compress task', err.toString());
        })
        .pipe(gulp.dest('public/js/'));
});

gulp.task('js-admin', function () {
    return gulp.src('public/source-dev/js/admin/*.js')
        .pipe(uglify())
        .on('error', function(err) {
            console.error('Error in compress task', err.toString());
        })
        .pipe(gulp.dest('public/js/admin/'));
});

gulp.task('js-client', function () {
    return gulp.src('public/source-dev/js/client/*.js')
        .pipe(uglify())
        .on('error', function(err) {
            console.error('Error in compress task', err.toString());
        })
        .pipe(gulp.dest('public/js/client/'));
});

//Compress Our Library JS:
gulp.task('js-libs', function () {
    return gulp.src('public/libs/**/*.js')
        .pipe(uglify())
        .on('error', function(err) {
            console.error('Error in compress task', err.toString());
        })
        .pipe(gulp.dest('public/libs'));
});

//Compress Our Library CSS:
gulp.task('css-libs', function () {
    return gulp.src('public/libs/**/*.css')
        .pipe(minifyCss())
        .on('error', function(err) {
            console.error('Error in compress task', err.toString());
        })
        .pipe(gulp.dest('public/libs'));
});

//Compress img:
gulp.task('images-source', function(){
    return gulp.src('public/source-dev/imgs/**/*.+(png|jpg|jpeg|gif|svg)')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest('public/imgs/'))
});

gulp.task('images-storage', function(){
    return gulp.src('public/storage/**/*.+(png|jpg|jpeg|gif|svg)')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest('public/storage/'))
});

gulp.task('images-upload', function(){
    return gulp.src('public/upload/**/*.+(png|jpg|jpeg|gif|svg)')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest('public/upload/'))
});


//Watch:
gulp.task('watch', function() {
    gulp.watch('public/source-dev/css/*.css', ['css-both']);
    gulp.watch('public/source-dev/css/admin/*.css', ['css-admin']);
    gulp.watch('public/source-dev/css/client/*.css', ['css-client']);
    gulp.watch('public/source-dev/js/*.js', ['js-both']);
    gulp.watch('public/source-dev/js/admin/*.js', ['js-admin']);
    gulp.watch('public/source-dev/js/client/*.js', ['js-client']);
    gulp.watch('public/source-dev/imgs/background-header/*.+(png|jpg|jpeg|gif|svg)', ['images-bg-header']);
    gulp.watch('public/source-dev/imgs/banner-page/*.+(png|jpg|jpeg|gif|svg)', ['images-banner-page']);
    gulp.watch('public/source-dev/imgs/original/*.+(png|jpg|jpeg|gif|svg)', ['images-original']);
    gulp.watch('public/upload/images/*.+(png|jpg|jpeg|gif|svg)', ['images-upload']);
});

// Watch Files For Change:
gulp.task('browser-sync', function () {
    var files = [
        'resources/views/**/*.php',
        'public/source-dev/css/**/*.css',
        'public/source-dev/imgs/**/*.*',
        'public/source-dev/js/**/*.js'
    ];

    browserSync.init(files, {
        server: {
            baseDir: ''
        }
    });
});

gulp.task('cssMinify', ['css-both', 'css-admin', 'css-client']);

gulp.task('compressImages', ['images-source', 'images-storage', 'images-upload']);

gulp.task('jsMinify', ['js-both', 'js-admin', 'js-client']);

gulp.task('jsLibsMinify', ['js-libs']);

gulp.task('cssLibsMinify', ['css-libs']);

gulp.task('libsMinify', ['jsLibsMinify', 'cssLibsMinify']);

// Default Task:
gulp.task('default', ['compressImages', 'cssMinify', 'jsMinify']);
