var gulp = require('gulp');
var sass = require('gulp-sass');
var webserver = require('gulp-webserver');


//Var styles para que funcione con el watch
var Styles_f = function(done) {
    gulp.src('src/assets/scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('src/assets/css/'));
    done();
};

gulp.task('styles', Styles_f);

gulp.task('default', Styles_f);

//Watch task
gulp.task('watch', function() {
    gulp.watch('src/assets/scss/**/*.scss', Styles_f);
});

//pendiente
gulp.task('webserver', function() {
    gulp.src('app')
        .pipe(webserver({
            fallback: './dist/index.html',
            livereload: true,
            directoryListing: true,
            open: true
        }));
});