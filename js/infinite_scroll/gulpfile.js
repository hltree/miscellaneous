const
    bsync = require('browser-sync'),
    gulp = require('gulp'),
    pug = require('gulp-pug'),
    sass = require('gulp-sass');

gulp.task('pug', () => {
    return (
        gulp.src('./dev/pug/*.pug')
            .pipe(pug())
            .pipe(gulp.dest('./'))
    );
});

gulp.task('sass', () => {
    return (
        gulp.src('./dev/scss/*.scss')
            .pipe(sass())
            .pipe(gulp.dest('./build/css'))
    );
});

gulp.task('js', () => {
    return (
        gulp.src('./dev/js/*.js')
            .pipe(gulp.dest('./build/js'))
    );
});

gulp.task('reload', (done) => {
    bsync.reload();
    done();
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

gulp.task('default', gulp.series('pug', 'sass', 'js', 'bsync'));