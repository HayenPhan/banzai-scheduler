const gulp = require('gulp');  // gulp runs on node that's why we use the require function to get access to the modules
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
const reload = browserSync.reload;


// Start BrowserSync // Not working yet
gulp.task('browser-sync', () => {
    browserSync.init({
        proxy: 'http://localhost:8080/cle/banzai-scheduler/app'
    });
});

// Compiling scss to css files
gulp.task('styles', () => {
  return gulp.src('app/assets/styles/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('app/assets/styles/css'))
});

// Watch task
gulp.task('watch', () => {    // It's better to set this on default, because you'll only have to type in "gulp" to make it work.
  gulp.watch('app/assets/styles/**/*.scss', gulp.series('styles'));      // This watches your styles task too.
});

// Find out how to minify files

// Find out how let BrowserSync work

gulp.task('default', gulp.series('styles', 'watch'));
