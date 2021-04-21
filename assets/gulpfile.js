var gulp = require('gulp'),
    cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass');

gulp.task('default', ['sass', 'watch']);

gulp.task('sass', function() {
    return gulp.src('sass/**/*.scss')
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(gulp.dest('css'));
});

//Watch task
gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['sass']);
});