const
    bsync = require('browser-sync'),
    gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    pug = require('gulp-pug'),
    notify = require('gulp-notify');

gulp.task('pug', () => {
    return (
        gulp.src('./dev/pug/*.pug')
            .pipe(plumber({errorHandler: notify.onError("Error: <=% error.message %>")}))
            .pipe(pug())
            .pipe(gulp.dest('./'))
    );
});

gulp.task('sass', () => {
    return (
        gulp.src('./dev/scss/*.scss')
            .pipe(plumber({errorHandler: notify.onError("Error: <=% error.message %>")}))
            .pipe(sass())
            .pipe(gulp.dest('./build/css'))
    );
});

gulp.task('js', () => {
    return (
        gulp.src('./dev/js/*.js')
            .pipe(plumber({errorHandler: notify.onError("Error: <=% error.message %>")}))
            .pipe(gulp.dest('./build/js'))
    );
});

gulp.task('bsync', () => {
    bsync({
        server: {
            baseDir: './'
        }
    });
    gulp.watch('./dev/pug/*.pug', gulp.series('pug', 'reload'));
    gulp.watch('./dev/scss/*.scss', gulp.series('sass', 'reload'));
    gulp.watch('./dev/js/*.js', gulp.series('js', 'reload'));
});

gulp.task('reload', (done) => {
    bsync.reload();
    done();
});

gulp.task('default', gulp.series('pug', 'sass', 'js', 'bsync'));