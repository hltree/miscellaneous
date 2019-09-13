const
    brower_sync = require('browser-sync'),
    gulp = require('gulp'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    pug = require('gulp-pug'),
    scss = require('gulp-sass');

gulp.task('pug', () => {
    return (
        gulp
            .src('./dev/pug/*.pug')
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message =>")}))
            .pipe(pug())
            .pipe(gulp.dest('./'))
    );
});

gulp.task('scss', () => {
    return (
        gulp
            .src('./dev/scss/style.scss')
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message =>")}))
            .pipe(scss())
            .pipe(gulp.dest('./build/css'))
    );
});

gulp.task('js', () => {
    return (
        gulp
            .src('./dev/js/*.js')
            .pipe(plumber({errorHandler: notify.onError("Error: <% error.message =>")}))
            .pipe(gulp.dest('./build/js'))
    );
});

gulp.task('browser-sync', () => {
    brower_sync({
        server: {
            baseDir: './'
        }
    });
    gulp.watch('./dev/pug/*.pug', gulp.series(gulp.parallel('pug', 'reload')));
    gulp.watch('./dev/scss/style.scss', gulp.series(gulp.parallel('scss', 'reload')));
    gulp.watch('./dev/js/*.js', gulp.series(gulp.parallel('js', 'reload')));
});

gulp.task('reload', (done) => {
    brower_sync.reload();
    done();
});

gulp.task('default', gulp.series('pug', 'scss', 'js', 'browser-sync'));