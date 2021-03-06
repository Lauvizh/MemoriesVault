var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var fontgen = require('gulp-fontgen');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js, bootstrap.js and all of my custom js files
gulp.task('js', function () {
    return gulp.src(['src/AppBundle/Resources/Public/jquery/dist/jquery.js',
        'src/AppBundle/Resources/Public/jquery-ui/jquery-ui.js',
        'src/AppBundle/Resources/Public/bootstrap/dist/js/bootstrap.js',
        'src/AppBundle/Resources/Public/js/**/*.js'])
        .pipe(concat('memories_vault.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//CSS TASK: write one minified css file out of bootstrap.less and all of my custom less files
gulp.task('css', function () {
    return gulp.src([
        'src/AppBundle/Resources/Public/bootstrap/dist/css/bootstrap.css',
        'src/AppBundle/Resources/Public/jquery-ui/themes/base/jquery-ui.css',
        'src/AppBundle/Resources/Public/jquery-ui/themes/base/theme.css',
        'app/Resources/public/css/**/*.css',
        'app/Resources/public/less/**/*.less'
        ])
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('memories_vault.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/css'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('img', function() {
    return gulp.src('app/Resources/Public/img/**/*.*')
        .pipe(gulp.dest('web/img'));
});

//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('images', function() {
    return gulp.src('src/AppBundle/Resources/Public/jquery-ui/themes/base/images/*')
        .pipe(gulp.dest('web/css/images'));
});

//FONT TASK: convert and copy fonts
gulp.task('fontgen', function() {
  return gulp.src("src/AppBundle/Resources/Public/bootstrap/fonts/*.{ttf,otf}")
    .pipe(fontgen({
      dest: "web/fonts"
    }));
});


//IMAGE TASK: Just pipe images from project folder to public web folder
gulp.task('videojs', function() {
    return gulp.src([
        'src/AppBundle/Resources/Public/video.js/dist/*'
        ])
        .pipe(gulp.dest('web/videojs/'));
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css', 'img', 'images', 'videojs', 'fontgen']);