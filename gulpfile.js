'use strict';

var gulp         = require('gulp');
var watch        = require('gulp-watch');
var concat       = require('gulp-concat');
var sass         = require('gulp-sass')(require('sass'));
var rename       = require('gulp-rename');
var uglify       = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var lec          = require('gulp-line-ending-corrector');

var paths = {
	js: ['core/asset/js/init.js', '**/*.backend.js'],
	scss:[ 'core/asset/css/scss/**/*.scss', 'core/asset/css/' ]
};

/** SCSS */
gulp.task( 'build_scss', function() {
	return gulp.src( paths.scss[0] )
		.pipe( sass( { 'outputStyle': 'expanded' } ).on( 'error', sass.logError ) )
		.pipe( autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}) )
		.pipe(lec({verbose:true, eolc: 'CRLF', encoding:'utf8'}))
		.pipe( gulp.dest( paths.scss[1] ) )
		.pipe( sass({outputStyle: 'compressed'}).on( 'error', sass.logError ) )
		.pipe( rename( './style.min.css' ) )
		.pipe(lec({verbose:true, eolc: 'CRLF', encoding:'utf8'}))
		.pipe( gulp.dest( paths.scss[1] ) );
});

/** JS */
gulp.task( 'build_js', function() {
	return gulp.src( paths.js )
		.pipe( concat( 'backend.min.js' ) )
		.pipe( uglify() )
		.pipe( gulp.dest( 'core/asset/js/' ) )
});

/** Watch */
gulp.task( 'default', function() {
	gulp.watch( paths.scss[0], gulp.series('build_scss') );
	gulp.watch( paths.js, gulp.series('build_js') );
});
