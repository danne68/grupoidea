let gulp = require('gulp');
let sass = require('gulp-sass');
let cleanCSS = require('gulp-clean-css');

sass.compiler = require('node-sass');

gulp.task('sass', () => {
  return gulp.src('sass/**/*.scss')
    .pipe(sass())
    .pipe(cleanCSS())
    .pipe(gulp.dest('css'));
});

gulp.task('watch', () => {
  gulp.watch('sass/**/*.scss', gulp.series('sass'));
});

gulp.task('default', gulp.parallel('sass'));