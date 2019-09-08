const
    browserSync = require('browser-sync'),
    gulp = require('gulp'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    pug = require('gulp-pug'),
    sass = require('gulp-sass');

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
            .pipe(gulp.dest('./build/view'))
    );
});

gulp.task('browser-sync', () => {
    browserSync({
        server: {
            baseDir: './build/view',
            startPath: 'index.html'
        }
    });
    gulp.watch('./dev/scss/*', gulp.series(gulp.parallel('compile-scss', 'reload')));
    gulp.watch('./dev/pug/*', gulp.series(gulp.parallel('compile-pug', 'reload')));
});
gulp.task('reload', (done) => {
   browserSync.reload();
   done();
});

gulp.task('default', gulp.series(gulp.parallel('browser-sync', 'compile-pug', 'compile-scss')));