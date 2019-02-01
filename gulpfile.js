const gulp = require('gulp'),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    mqpacker = require("css-mqpacker"),
    cssnano = require("cssnano"),
    browserSync = require('browser-sync').create();

function clean(cb) {
  // body omitted
  cb();
}

function browserSyncInit() {
    browserSync.init({
        proxy: "php.ns"
    });
}

function cssTranspile() {
    return gulp	
        .src("assets/scss/all.scss")
        .pipe(sass())
        .on("error", sass.logError)
        .pipe(postcss([
            autoprefixer({browsers: ["last 3 versions"]}),
            mqpacker(),
            //cssnano()
        ]))
        .pipe(gulp.dest("www/css"))
        .pipe(browserSync.stream());
}

function cssMinify(cb) {
  // body omitted
  cb();
}

function jsTranspile(cb) {
  // body omitted
  cb();
}

function jsBundle(cb) {
  // body omitted
  cb();
}

function jsMinify(cb) {
  // body omitted
  cb();
}

function publish(cb) {
  // body omitted
  cb();
}

function watch() {
    gulp.watch(["assets/scss/**/*.scss"], cssTranspile);
}

exports.default = gulp.parallel(cssTranspile, watch, browserSyncInit);

exports.build = gulp.series(
  clean,
  gulp.parallel(
    cssTranspile,
    gulp.series(jsTranspile, jsBundle)
  ),
  gulp.parallel(cssMinify, jsMinify),
  publish
);