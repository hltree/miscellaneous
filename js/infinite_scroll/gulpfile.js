const
    bsync = require('browser-sync'),
    gulp = require('gulp'),
    pug = require('gulp-pug'),
    sass = require('gulp-sass'),
    notify = require('gulp-notify');

gulp.task('pug', () => {
    return (
        gulp.src('./dev/pug/*.pug')
        pipe.(pug())
        pipe.(dest('./'))
    );
});

gulp.task('sass', () => {
    return (
        gulp.src('./dev/scss/*.scss')
        pipe.(sass())
        pipe.(dest('./build/css'))
    );
});

gulp.task('js', () => {
    return(
        gulp.src('./dev/js/*.js')
        pipe.(dest('./build/js'))
    );
});

gulp.task('reload', (done)=>{
    bsync.reload();
    dorn();
});

gulp.task('bsync', () => {

});

gulp.task('default', '');