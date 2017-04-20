/***************************
 * Gulp Module Imports
 **************************/
import browserSync    from   'browser-sync';
import babel          from   'gulp-babel';
import autoprefixer   from   'gulp-autoprefixer';
import concatCSS      from   'gulp-concat-css';
import concatJS       from   'gulp-concat';
import connectPHP     from   'gulp-connect-php';
import eslint         from   'gulp-eslint';
import gulp           from   'gulp';
import httpProxy      from   'http-proxy';
import imagemin       from   'gulp-imagemin';
import install        from   'install';
import minifyCSS      from   'gulp-clean-css';
import minifyJS       from   'gulp-minify';
import npm            from   'npm';
import plumber        from   'gulp-plumber';
import rename         from   'gulp-rename';
import sass           from   'gulp-sass';
import sourcemaps     from   'gulp-sourcemaps';
import watch          from   'gulp-watch';

/***************************
 * Helpers
 **************************/
class Options {
    constructor (obj, key) {
        this.obj = obj
        this.options(key)
    }
    options (key) {
        return arguments.length <=0 ? this.obj : this.obj[key];
    }
}

const returnFiles  = (root, files) => {
    const arr = [],
          len = files.length;
    for(let file in files) {
        let newfile = root + files[file];
        arr.push(newfile);
    }
    return arr;
}

/***************************
 * Options
 **************************/
const
    connectPHPOptions           =   new Options({ hostname: 'localhost', port: 9000, base: 'src', open: false }),
    browserSyncServerOptions    =   new Options({ baseDir  : 'src', middleware: (req, res, next) => {
        const
            proxy   =   httpProxy.createProxyServer({}),
            url     = req.url;

            !url.match(/^\/(styles|fonts|bower_components)\//) ? proxy.web(req, res, { target: 'http://127.0.0.1:9000' }) : next();
        }
    }),
    browserSyncOptions          =   new Options({ port: 9001, server: browserSyncServerOptions.options() }),
    gulpBabel                   =   new Options({ presets: 'es2015' }),
    gulpRename                  =   new Options({ fileNameCSS: 'main.css', fileNameJS: 'main.js', baseName: 'main', extName: '.js' }),
    gulpImageMinify             =   new Options({ progressive: true, optimizationLevel: 5 });

/***************************
* Variables
**************************/
const
    renameFileNameJS            =   gulpRename.options('fileNameJS'),
    mainCssFile                 =   'main.css',
    imageRoot                   =   './src/assets/img/',
    jsRoot                      =   './src/assets/js/',
    cssRoot                     =   './src/assets/css/',
    cssDevRoot                  =   './src/assets/css/dev/',
    allImages                   =   './src/assets/img/dev/*.*',
    allSassFiles                =   './src/assets/css/dev/sass/**/*.scss',
    allJSFiles                  =   './src/assets/js/dev/**/*.js',
    allPHPFiles                 =   './src/**/*.php',
    devCssDir                   =   './src/assets/css/dev/',
    jsFiles                  =   returnFiles('./src/assets/js/dev/', ['jquery.min.js', 'bootstrap.min.js', 'main.js']),
    cssFiles                 =   returnFiles(devCssDir, ['normalize.min.css', 'bootstrap.min.css', 'font-awesome.min.css', 'mainstyle.css']),
    postCssFiles                =   returnFiles('./src/assets/css/', ['dev/normalize.min.css', 'dev/bootstrap.min.css', 'dev/font-awesome.min.css', 'post/blog-post.css']),
    homeCssFiles                =   returnFiles('./src/assets/css/', ['dev/normalize.min.css', 'dev/bootstrap.min.css', 'dev/font-awesome.min.css', 'home/blog-home.css']),
    adminCssFiles               =   returnFiles('./src/assets/css/', ['dev/normalize.min.css', 'dev/bootstrap.min.css', 'dev/font-awesome.min.css', 'admin/sb-admin.css']);

/***************************
* Development
**************************/

// Scripts
gulp.task('js', () => {
    return gulp.src(jsFiles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(babel(gulpBabel.options()))
        .pipe(concatJS(renameFileNameJS))
        .pipe(minifyJS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(jsRoot))
        .pipe(browserSync.stream());
});

// SASS
gulp.task('sass', () => {
    return gulp.src(allSassFiles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(cssDevRoot))
});

// CSS
gulp.task('css', ['sass'], () => {
    return gulp.src(cssFiles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concatCSS(mainCssFile))
        .pipe(minifyCSS())
        .pipe(gulp.dest(cssRoot))
        .pipe(browserSync.stream());
});

// Images
gulp.task('img', () => {
  return watch(allImages, () => {
    gulp.src(allImages)
      .pipe(plumber())
      .pipe(imagemin(gulpImageMinify.options()))
      .pipe(gulp.dest(imageRoot))
      .pipe(browserSync.stream());
  });
});

// Browser-sync PHP Server
gulp.task('connect', () => {
    connectPHP.server( connectPHPOptions.options() );
    browserSync( browserSyncOptions.options() );
});

/***************************
 * Production
 **************************/
gulp.task('watch', ['connect'], function() {
    gulp.watch(allPHPFiles).on('change', function () {
        browserSync.reload();
    });
    //gulp.watch(allJSFiles, ['js']);
    gulp.watch(allSassFiles, ['css']);
});

/***************************
 * Default
 **************************/
gulp.task('default', ['css', 'img', 'watch']);
