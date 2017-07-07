// Gulp
var gulp = require('gulp');

// CSS plugins
var sass                    = require('gulp-sass');
var combineMediaQueries     = require('gulp-combine-media-queries');
var autoprefixer            = require('gulp-autoprefixer');
var cssmin                  = require('gulp-cssmin');

// JS plugins
//var browserify 				= require('browserify');

var source 					= require('vinyl-source-stream');
var buffer 					= require('vinyl-buffer');
var uglify 					= require('gulp-uglify');
var gulpUtil                = require('gulp-util');


// Image plugins
// var imagemin                = require('gulp-imagemin');

// General plugins
var browserSync             = require('browser-sync');
var reload                  = browserSync.reload;
var notify                  = require('gulp-notify');

// -------------------------------------------------------------------------
// TASKS
// -------------------------------------------------------------------------

// Compile JS files into one and move to distribution folder
/*
gulp.task('browserify', function() {
  return browserify('./source/js/main.js')
  	// Bundle all JS modules up
    .bundle()
    // Set source file name
    .pipe(source('app.js'))
    // Convert to JS readable format
    .pipe(buffer())
    // Strip whitespace and lines
    .pipe(uglify())
    // Move and save to Dist folder
    .pipe(gulp.dest('./assets/js/'))
    // Notifiy that the task was complete
    .pipe(notify({ message: 'JS task complete' }))
    // Refresh page
    .pipe(browserSync.stream());
});
*/

gulp.task('move_js', function() {
 return gulp.src('./source/js/*.js')
    // Strip whitespace and lines
    .pipe(uglify().on('error', onError))
    // Move and save to Dist folder
    .pipe(gulp.dest('./assets/js/'))
    // Notifiy that the task was complete
    .pipe(notify({ message: 'JS task complete' }))
    // Refresh page
    .pipe(browserSync.stream());
});

// Compile SCSS files and move to distributions folder
gulp.task('sass', function() {
    return gulp.src('./source/scss/*.scss')
        // Compile Sass
        .pipe(sass({ style: 'compressed', noCache: true }).on('error', sass.logError))
        // parse CSS and add vendor-prefixed CSS properties
        .pipe(autoprefixer())
        // Minify CSS
        .pipe(cssmin())
        // Where to store the finalized CSS
        .pipe(gulp.dest('./assets/css/'))
        // Notify us that the task was completed
        .pipe(notify({ message: 'CSS task complete' }))
        // Refresh page
        .pipe(browserSync.stream());
});

// Prevents Node from crashing
function onError(err) {
  console.log(err);
  this.emit('end');
}

// Watch for changes
gulp.task('watch', ['move_js', 'sass'], function (){
	// Sync with server
	browserSync.init({
        proxy: 'http://localhost/carlproject/',
        port: 3010,
        logLevel: 'debug',
        logConnections: true
  });
	// Watch all CSS, JS and HTML files for changes
  	gulp.watch('./source/scss/**/*.scss', ['sass']);
  	gulp.watch('./source/js/**/*.js', ['move_js']);
  	gulp.watch(['*.html', '*.php', './app/views/**/*.php', './admin/*.php'], browserSync.reload);

	// Say Hello
  	console.log('The Watch Has Begun');
})
