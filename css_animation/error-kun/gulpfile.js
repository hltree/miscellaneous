const gulp = require('gulp'),
    sass = require('gulp-sass'),
    pug = require('gulp-pug'),
    connect = require('gulp-connect');

gulp.task('compile-scss', function () {
    return (
        gulp
            .src('./dev/scss/style.scss')
            .pipe(sass())
            .pipe(gulp.dest('./build/css'))
    );
});
gulp.watch('./dev/scss/*', gulp.task('compile-scss'));

gulp.task('compile-pug', function () {
    return (
        gulp
            .src('./dev/pug/*.pug')
            .pipe(pug())
            .pipe(gulp.dest('./build/view'))
    );
});
gulp.watch('./dev/pug/*', gulp.task('compile-pug'));

gulp.task('connect', function(){
    connect.server({
        root: './build/view'
    });
});

gulp.task('default', gulp.series(gulp.parallel('compile-pug', 'compile-scss', 'connect')));