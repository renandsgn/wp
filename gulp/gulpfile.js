var gulp = require('gulp');
var svgSprite = require('gulp-svg-sprite');
const image = require('gulp-image');
var gp_concat = require('gulp-concat');
var gp_uglify = require('gulp-uglify');
var svgo = require('gulp-svgo');
var postcss = require('gulp-postcss');
const mqpacker = require("css-mqpacker");
var cssmin = require('gulp-cssmin');
const eslint = require('gulp-eslint');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var flatmap = require('gulp-flatmap');
var path = require('path');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
var minify = require('gulp-minify');
var uglify = require('gulp-uglify-es').default;
var jsImport = require('gulp-js-import');

gulp.task('connect', function() {
    return connect.server();
}); 

gulp.task('image', done => {
  return gulp.src('img/**/*.jpg')
    .pipe(image({
        jpegRecompress: ['--strip', '--quality', 'high', '--min', 100, '--max', 100],
        // mozjpeg: ['-progressive'],
        mozjpeg: false,
        jpegoptim: true,
        zopflipng: false,

    }))
    .pipe(gulp.dest('dist/img/'));
});


var config = {
    mode: {
        symbol: {
            dest: '../svg/',
            sprite: 'sprite.svg',
            example: true
        }
    },
    svg: {
        xmlDeclaration: false,
        doctypeDeclaration: false
    }
};

gulp.task('sprites', function(){
    return gulp.src('../svg/particles/*.svg')
        .pipe(svgo({
            removeTitle: true,
            removeComments: true,
            minifyStyles: true,
            convertStyleToAttrs: true,
            convertColors: true,
            removeStyleElement: true,
            removeUnknownsAndDefaults: true,
            removeEmptyContainers: true,
            removeEmptyText: true,
            plugins: [
                { removeAttrs: { attrs: '(fill|stroke)' } },
            ]
        }))
        .pipe(svgSprite(config))
        .pipe(gulp.dest('.'))
});


gulp.task('css-concat', function(){
    return gulp.src([
        "../css/reset.css",
        "!../css/mixins.css",
        "../css/common.css"
        ])
    .pipe(gp_concat('common.css')).pipe(cssmin())
    .pipe(gulp.dest('../dist/css'));
});

gulp.task('js-teste', function() {
    return gulp.src([
            "../js/lib/*",
            "../js/*.js"
        ])
        // .pipe(gp_concat('scripts.js'))
        .pipe(jsImport({hideConsole: false}))
        .pipe(uglify())
        .pipe(gulp.dest('../dist/js'));
});


gulp.task('reload', function() {
    browserSync.reload();
});

gulp.task('assistir', function() {
    connect.server({}, function (){
        browserSync({
            // open: 'external',
            host: 'localhost:8443',
            proxy: 'https://domain.site/site',
            // baseDir: "../",
            online: true,
            ghostMode: false,
            https: true,
            port: 3000,
            files: ['../**/*.php', '!../theme-functions/*.php', '../**/*.css', '../**/*.js',  '../**/*.svg', '../**/*.png', '../**/*.jpg', '../**/*.less'],
            browser: "google chrome",
            https: {
                key: "/Users/renan/localhost+2-key.pem",
		cert: "/Users/renan/localhost+2.pem",
            },
            snippetOptions: {
                ignorePaths: "/wp-admin/**"
            }
        });
    });
    gulp.watch(['../**/*.php', '!../theme-functions/*.php', '../**/*.css', '../**/*.js', '../**/*.svg', '../**/*.png', '../**/*.jpg', '../**/*.less'], browserSync.reload);
    gulp.watch( '../js/**/*.js', gulp.parallel('js-teste') );
	gulp.watch( '../css/**/*', gulp.series('css-concat') );
    gulp.watch( '../svg/particles/*', gulp.parallel('sprites') );
    // gulp.watch(['**/*.php', '**/*.css', '**/*.js'], gulp.parallel('reload'));
});



// gulp.task('clean-css', function() {

//     var plgs = [
//         mqpacker()
//     ];
    
//     return gulp.src('dist/main.css').pipe(postcss(plgs)).pipe(cssmin()).pipe(gulp.dest('./teste/'));
// });
