var gulp         = require('gulp');
var less         = require('gulp-less');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');
var minifyCSS    = require('gulp-minify-css');
var rename       = require('gulp-rename');
var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var jquery       = require('gulp-jquery');

var Elixir       = require('laravel-elixir');

Elixir.extend('www', function() {

    var rootPath    = process.cwd();
    var baseLibPath = rootPath + '/resources/assets/www/vendor/bootstrap-marketing';
    var Paths = {
        HERE                 : './',
        DIST                 : rootPath + '/public/assets/www',
        DIST_TOOLKIT_JS      : rootPath + '/public/assets/www/js/main.js',
        LESS_TOOLKIT_SOURCES : baseLibPath + '/less/toolkit-minimal.less',
        LESS                 : baseLibPath + '/less/**/**',
        JS                   : [
            rootPath    + '/resources/assets/www/js/app.js',
            baseLibPath + '/js/bootstrap/transition.js',
            baseLibPath + '/js/bootstrap/alert.js',
            baseLibPath + '/js/bootstrap/affix.js',
            baseLibPath + '/js/bootstrap/button.js',
            baseLibPath + '/js/bootstrap/carousel.js',
            baseLibPath + '/js/bootstrap/collapse.js',
            baseLibPath + '/js/bootstrap/dropdown.js',
            baseLibPath + '/js/bootstrap/modal.js',
            baseLibPath + '/js/bootstrap/tooltip.js',
            baseLibPath + '/js/bootstrap/popover.js',
            baseLibPath + '/js/bootstrap/scrollspy.js',
            baseLibPath + '/js/bootstrap/tab.js',
            baseLibPath + '/js/custom/*'
        ]
    };

    gulp.task('default', ['less-min', 'js-min']);

    gulp.task('watch', function () {
        gulp.watch(Paths.LESS, ['less-min']);
        gulp.watch(Paths.JS,   ['js-min']);
    });

    //gulp.task('jquery', function () {
    //    return jquery.src({
    //            release: 2, //jQuery 2
    //            flags: ['-deprecated', '-event/alias', '-ajax/script', '-ajax/jsonp', '-exports/global']
    //        })
    //        .pipe(uglify())
    //        .pipe(rename({
    //            basename: 'jquery',
    //            suffix: '.min'
    //        }))
    //        .pipe(gulp.dest(Paths.DIST));
    //    // creates ./public/vendor/jquery.custom.js
    //});

    gulp.task('less', function () {
        return gulp.src(Paths.LESS_TOOLKIT_SOURCES)
            .pipe(sourcemaps.init())
            .pipe(less())
            .pipe(autoprefixer())
            .pipe(sourcemaps.write(Paths.HERE))
            .pipe(gulp.dest(Paths.DIST + '/css'))
    });

    gulp.task('less-min', ['less'], function () {
        return gulp.src(Paths.LESS_TOOLKIT_SOURCES)
            .pipe(sourcemaps.init())
            .pipe(less())
            .pipe(minifyCSS())
            .pipe(autoprefixer())
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(sourcemaps.write(Paths.HERE))
            .pipe(gulp.dest(Paths.DIST + '/css'))
    });

    gulp.task('js', function () {
        return gulp.src(Paths.JS)
            .pipe(concat('main.js'))
            .pipe(gulp.dest(Paths.DIST + '/js'))
    });

    gulp.task('js-min', ['js'], function () {
        return gulp.src(Paths.DIST_TOOLKIT_JS)
            .pipe(uglify())
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(gulp.dest(Paths.DIST + '/js'))
    });

});