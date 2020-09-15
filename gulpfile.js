var gulp = require('gulp');
var sass = require('gulp-sass');
// var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var cssnano = require('gulp-cssnano');
var rename = require('gulp-rename');
//var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
// var del = require('del');


function style() {
  return gulp.src('./src/scss/style.scss')
    .pipe(sass().on('error', sass.logError))
	.pipe(autoprefixer('last 2 versions'))
//	.pipe(cleanCSS({ compatibility: '*' }))
    .pipe(cssnano({ discardComments: { removeAll : true } }))
	.pipe(rename({suffix: '.min' }))
    .pipe(gulp.dest('./assets/css'));
}

function script() {
	var scripts = [
		'./src/vendor/jquery.js',
//		'./src/vendor/popper.js/dist/umd/popper.js',
		'./src/vendor/bootstrap/dist/js/bootstrap.bundle.js',
		'./src/vendor/select2/dist/js/select2.js',
		'./src/js/**/*.js'
	];

	return gulp.src(scripts, {allowEmpty: true})
//		.pipe(babel({ presets: [ '@babel/preset-env' ] }))
		.pipe(concat('script.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./assets/js'));
}

function watchAll() {
	gulp.watch('./src/scss/**/*.scss', gulp.series('style'));
	gulp.watch('./src/js/**/*.js', gulp.series('script'));
}

function copy_assets() {
	gulp.src('./node_modules/font-awesome/fonts/**/*.{ttf,woff,woff2,eot,svg}')
		.pipe(gulp.dest('./assets/fonts/FontAwesome'));

	gulp.src('./node_modules/font-awesome/scss/*.scss')
		.pipe(gulp.dest('./src/vendor/font-awesome'));

	gulp.src('./node_modules/jquery/dist/jquery.js')
		.pipe(gulp.dest('./src/vendor'));

	gulp.src('./node_modules/popper.js/**/*')
		.pipe(gulp.dest('./src/vendor/popper.js'));

	gulp.src('./node_modules/select2/**/*')
		.pipe(gulp.dest('./src/vendor/select2'));

	gulp.src('./node_modules/@ttskch/**/*')
		.pipe(gulp.dest('./src/vendor/@ttskch'));

	return gulp.src('./node_modules/bootstrap/**/*')
		.pipe(gulp.dest('./src/vendor/bootstrap'));
}

exports.style = style;
exports.script = script;
exports.watchAll = watchAll;
exports.copy_assets = copy_assets;

exports.watch = gulp.series(
	gulp.parallel(style, script),
	watchAll
);

exports.default = gulp.series(
	gulp.parallel(style, script),
	watchAll
);
