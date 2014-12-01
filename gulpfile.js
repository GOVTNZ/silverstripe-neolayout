'use strict';

var gulp = require('gulp'),
    stylus = require('gulp-stylus'),
    react = require('gulp-react'),
    browserify = require('gulp-browserify'),
    uglify = require('gulp-uglify'),
    del = require('del');

gulp.task('css', function () {
    gulp.src('./styl/main.styl')
        .pipe(stylus())
        .pipe(gulp.dest('./css'));
});

gulp.task('js', function () {
    gulp.src('./jsx/**/*.jsx')
        .pipe(react())
        .pipe(gulp.dest('./javascript/build')).on('end', function () {
            gulp.src('./javascript/build/app.js')
                .pipe(browserify())
                .pipe(gulp.dest('./javascript')).on('end', function () {
                    gulp.src('./javascript/app.js')
                        .pipe(uglify())
                        .pipe(gulp.dest('./javascript'));

                    del('./javascript/build/');
                });
        });
});

gulp.task('default', ['css', 'js']);