var gulp = require('gulp');
var sass = require('gulp-sass');
var webserver = require('gulp-webserver');

//Var styles para que funcione con el watch
var Styles_f = function(done) {
    gulp.src('sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('app/css/'));
    done();
};

gulp.task('styles', Styles_f);

//Watch task
gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', Styles_f);
});

gulp.task('webserver', function() {
    gulp.src('app')
        .pipe(webserver({
            fallback: './dist/index.html',
            livereload: true,
            directoryListing: true,
            open: true
        }));
});