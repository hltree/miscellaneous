const
    browserSync = require('browser-sync'),
    gulp = require('gulp'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    pug = require('gulp-pug'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify-es').default;

gulp.task('compile-scss', () => {
    return (
        gulp
            .src('./dev/scss/style.scss')
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
            .pipe(sass())
            .pipe(gulp.dest('./build/css'))
    );
});

gulp.task('compile-pug', () => {
    return (
        gulp
            .src('./dev/pug/*.pug')
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
            .pipe(pug())
            .pipe(gulp.dest('./'))
    );
});

gulp.task('compile-js', () => {
    return (
        gulp
            .src(['./dev/js/*.js'])
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
            .pipe(uglify())
            .pipe(rename({extname: '.min.js'}))
            .pipe(gulp.dest('./build/js'))
    );
});

gulp.task('browser-sync', () => {
    browserSync({
        server: {
            baseDir: './',
        }
    });
    gulp.watch('./dev/js/*', gulp.series(gulp.parallel('compile-js', 'reload')));
    gulp.watch('./dev/scss/*', gulp.series(gulp.parallel('compile-scss', 'reload')));
    gulp.watch('./dev/pug/*', gulp.series(gulp.parallel('compile-pug', 'reload')));
});
gulp.task('reload', (done) => {
   browserSync.reload();
   done();
});

gulp.task('default', gulp.series(gulp.parallel('browser-sync', 'compile-pug', 'compile-scss', 'compile-js')));