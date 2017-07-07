/*
 * Dependencies.
 */
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var browserSync = require('browser-sync').create();
var svgmin = require('gulp-svgmin');

/*
 * SASS Compiling Task.
 */
gulp.task('sass', function() {
  return gulp.src('_dev/css/**/*.scss')
  .pipe(sass().on('error', sass.logError))
  .pipe(autoprefixer())
  .pipe(minify({
    keepSpecialComments: 1
  }))
  .pipe(gulp.dest('./'))
  .pipe(browserSync.stream());
});

/*
 * Browser-Sync Initialize Task.
 */
gulp.task('serve', ['sass'], function() {
	browserSync.init({
		proxy: "http://vagrant.local",
		port: 8080
	});
	gulp.watch('_dev/css/**/*.scss', ['sass']);
	gulp.watch('**/*.php').on('change', browserSync.reload);
});

/*
 * SVGOMG Minification.
 */
gulp.task('svgmin', function() {
	return gulp.src('assets/**/*.svg')
	.pipe(svgmin())
	.pipe(gulp.dest(function(file) {
			return file.base;
	}));
});

/*
 * Watch the assets folder for SVG changes.
 */
gulp.task('svg-watch', function() {
	gulp.watch('assets/**/*.svg', ['svgmin'])
});

/*
 * Default Task.
 */
gulp.task('default', ['serve', 'svg-watch']);
