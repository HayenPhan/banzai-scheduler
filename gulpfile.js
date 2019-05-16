const gulp = require('gulp');  // gulp runs on node that's why we use the require function to get access to the modules
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
const reload = browserSync.reload;
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');


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
    .pipe(gulp.dest('app/dist/css'))
});

// Watch task
gulp.task('watch', () => {    // It's better to set this on default, because you'll only have to type in "gulp" to make it work.
  gulp.watch('app/assets/styles/**/*.scss', gulp.series('styles'));      // This watches your styles task too.
  console.log('yo');
});


// gulp.task('scripts', () =>  {
//   return gulp.src(
//   ['node_modules/babel-polyfill/dist/polyfill.js','app/assets/js/*.js']).pipe(babel({
//       presets: ['es2015'],
//       plugins: ["syntax-dynamic-import"]
//   }))
//   .pipe(gulp.dest('app/assets/compiled'));
// });


// babel

gulp.task('babel', () =>
    gulp.src('app/assets/js/**/*.js')
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(gulp.dest('app/dist/js'))
);

// Gulp task to minify JavaScript files
gulp.task('scripts', () => {
  return gulp.src('app/assets/js/**/*.js')
    // Minify the file
    .pipe(uglify())
    // Output
    .pipe(gulp.dest('app/dist/js'))
});

// Find out how let BrowserSync work

gulp.task('default', gulp.series('styles', 'watch', 'babel', 'scripts'));
