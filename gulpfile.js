const gulp = require('gulp'),
    babel = require("gulp-babel"),
    concat = require("gulp-concat"),
    uglify = require("gulp-uglify"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    mqpacker = require("css-mqpacker"),
    cssnano = require("cssnano"),
    touch = require("gulp-touch-fd"),
    browserSync = require('browser-sync').create();

function browserSyncInit() {
    browserSync.init({
        proxy: "php.ns"
    });
}

function cssBundle() {
    return gulp	
        .src("assets/scss/all.scss")
        .pipe(sass())
        .on("error", sass.logError)
        .pipe(postcss([
            autoprefixer({browsers: ["last 3 versions"]}),
            mqpacker()
        ]))
        .pipe(gulp.dest("www/css"))
        .pipe(touch())
        .pipe(browserSync.stream());
}

function cssMinify() {
    return gulp.src("www/css/all.css")
        .pipe(postcss([
            cssnano()
        ]))
        .pipe(gulp.dest("www/css"))
        .pipe(touch());
}

function jsBundle() {
    var vendor = [
        "assets/js/vendor/jquery-3.3.1.js",
        "assets/js/vendor/jquery.validate.js",
        "assets/js/vendor/bootstrap/bootstrap.bundle.js",
        "assets/js/vendor/page.js"
    ];

    var app = [
        "assets/js/app/core.js",
        "assets/js/app/pages/**/*.js",
        "assets/js/app/index.js"
    ];

    return gulp.src(vendor.concat(app))
        .pipe(babel())
        .pipe(concat("all.js"))
        .pipe(gulp.dest("www/js"))
        .pipe(touch())
        .pipe(browserSync.stream());
}

function jsMinify() {
    return gulp.src("www/js/all.js")
        .pipe(uglify())
        .pipe(gulp.dest("www/js"))
        .pipe(touch());
}

function watch() {
    gulp.watch(["assets/scss/**/*.scss"], cssBundle);
    gulp.watch(["assets/js/app/**/*.js"], jsBundle);
}

exports.default = gulp.parallel(cssBundle, jsBundle, watch, browserSyncInit);

exports.build = gulp.series(
  gulp.parallel(cssBundle, jsBundle),
  gulp.parallel(cssMinify, jsMinify)
);