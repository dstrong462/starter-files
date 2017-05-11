// process.env.DISABLE_NOTIFIER = true;

var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var include = require('gulp-include');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var imageminJpegRecompress = require('imagemin-jpeg-recompress');
var imageminPngQuant = require('imagemin-pngquant');

// Configuration
var config = {
	browsersync: {
		options: {
			proxy: 'localhost:8888/',
			notify: false
		},
		streamOptionsStyles: {
			match: '**/*.css' // supresses page refresh if sourcemaps are used
		}
	},
	styles: {
		src: 'library/sass/**/*.scss',
		dest: './',
		sourcemapDest: '.', // i.e. current directory
		options: {
			sass: {
				outputStyle: 'expanded', // nested, expanded, compact, compressed
				precision: 10 // level of precision on numerical values (i.e. 10.0 vs 10.0000001)
			},
			autoprefixer: {
				browsers: ['last 2 versions', '> 3%', 'Firefox ESR'],
				cascade: false
			}
		}
	},
	scripts: {
		src: 'library/js/*.js',
		dest: 'library/js/min/',
		sourcemapDest: '.', // i.e. current directory
		rename: {
			suffix: '-min'
		}
	},
	img: {
		src: 'library/img-src/**/*.{jpg,jpeg,png,gif,svg}',
		dest: 'library/img/',
		options: {
			use: [
				imageminJpegRecompress({
					accurate: true,
					loops: 3,
					min: 40,
					max: 85
				}),
				imageminPngQuant()
			],
			svgoPlugins: [
				{ removeXMLProcInst: true },
				{ removeDoctype: true },
				{ removeComments: true },
				{ removeDimensions: true }, // removes dimensions in presence of viewBox
				{ removeTitle: true },
				{ removeStyleElement: true },
				{ convertShapeToPath: true },
				{ convertColors: {
					 names2hex: true,
					 rgb2hex: true
				}},
				{ cleanupNumericValues: {
					floatPrecision: 2
				}}
			]
		}
	}
};

// Styles (CSS / Sass)
gulp.task('styles', function() {
	return gulp
		.src(config.styles.src)
		.pipe(sourcemaps.init())
		//.pipe(sass(config.styles.options.sass).on('error', sass.logError))
		.pipe(sass(config.styles.options.sass).on('error', notify.onError({
			title: 'Sass Compilation Error',
			message: '<%= error.message %>'
		})))
		.pipe(autoprefixer(config.styles.options.autoprefixer))
		.pipe(sourcemaps.write(config.styles.sourcemapDest))
		.pipe(gulp.dest(config.styles.dest))
		// .pipe(notify('Sass Compilation Complete'))
		.pipe(browserSync.stream(config.browsersync.streamOptionsStyles));
});

// JavaScript
gulp.task('scripts', function() {
	return gulp
		// .pipe(uglify())
		.src(config.scripts.src)
		.pipe(sourcemaps.init())
		.pipe(include()).on('error', console.log)
		// .pipe(uglify())
		.pipe(rename(config.scripts.rename))
		.pipe(sourcemaps.write(config.scripts.sourcemapDest))
		.pipe(gulp.dest(config.scripts.dest));
		// .pipe(notify('JS Compilation Complete'));
});

// Images
gulp.task('images', function() {
	return gulp
		.src(config.img.src)
		.pipe(imagemin(config.img.options))
		.pipe(gulp.dest(config.img.dest));
});

// Watcher
gulp.task('watch', function() {
	browserSync.init(config.browsersync.options);
	gulp.watch(config.styles.src, ['styles']);
	gulp.watch(config.scripts.src, ['scripts']);
	gulp.watch('**/*.{php,js}').on('change', browserSync.reload);
});

// Default Task
gulp.task('default', [
	'styles',
	'scripts',
	'watch'
]);