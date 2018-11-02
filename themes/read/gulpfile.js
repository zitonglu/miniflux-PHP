var gulp = require('gulp');
var less = require('gulp-less');

var paths = {
  src: {
    styles: './less/*.less'
  },
  dest: {
    styles: './css/',
  }
};

gulp.task('less', function () {
  return gulp.src(paths.src.styles)
    .pipe(less())
    .pipe(gulp.dest(paths.dest.styles));
});

// Watch for changes in dev mode
gulp.task('watch', function () {
  gulp.watch('./less/**/*.less', ['less']);
});

// Set the default to be less
gulp.task('default', ['less']);
