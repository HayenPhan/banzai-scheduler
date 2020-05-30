const gulp = require('gulp');  // gulp runs on node that's why we use the require function to get access to the modules
const sass = require('gulp-sass');

// Compiling scss to css files
gulp.task('styles', () => {
  return gulp.src('app/assets/styles/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('app/dist/css'))
});

// Watch task
gulp.task('watch', () => {    // It's better to set this on default, because you'll only have to type in "gulp" to make it work.
  gulp.watch('app/assets/styles/**/*.scss', gulp.series('styles'));      // This watches your styles task too.
});


gulp.task('default', gulp.series('styles', 'watch'));
