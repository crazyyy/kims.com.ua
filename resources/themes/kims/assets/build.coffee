###
Base imports and vars
###
path = require 'path'
gulp = require 'gulp'
sass = require 'gulp-sass'
util = require 'gulp-util'
concat = require 'gulp-concat'
uglify = require 'gulp-uglify'
coffee = require 'gulp-coffee'
imagemin = require 'gulp-imagemin'
minifyCSS = require 'gulp-minify-css'
plumber = require 'gulp-plumber'
gulpLoadPlugins = require 'gulp-load-plugins'
browserify = require('browserify')
babelify = require('babelify')
source = require('vinyl-source-stream')

# get the theme name
theme = path.basename(path.dirname(__dirname))

projectRoot = __dirname.slice(0, __dirname.indexOf('/resources/'))

$_ = gulpLoadPlugins();

dev_path =
  fonts: __dirname.concat('/fonts/**')
  vendor: __dirname.concat('/vendor/**')
  images: __dirname.concat('/images/**')
  coffee: __dirname.concat('/coffee/**.coffee')
  js: __dirname.concat('/js/**')
  scss: __dirname.concat('/scss/')
  css: __dirname.concat('/css/')
  react: __dirname.concat('/react/**')

prod_path =
  fonts: projectRoot.concat('/public/assets/themes/' + theme + '/fonts/')
  vendor: projectRoot.concat('/public/assets/themes/' + theme + '/vendor/')
  images: projectRoot.concat('/public/assets/themes/' + theme + '/images/')
  js: projectRoot.concat('/public/assets/themes/' + theme + '/js/')
  css: projectRoot.concat('/public/assets/themes/' + theme + '/css/')
  react: projectRoot.concat('/public/assets/themes/' + theme + '/js/')


# Export tasks #
module.exports =
  default: [theme.concat('::css'), theme.concat('::coffee'), theme.concat('::react'), theme.concat('::purejs'),
    theme.concat('::images'), theme.concat('::fonts'), theme.concat('::vendor')]
  dev: [theme.concat('::css:dev'), theme.concat('::coffee:dev'), theme.concat('::react'), theme.concat('::purejs'),
    theme.concat('::images'), theme.concat('::fonts'), theme.concat('::vendor')]
  watch: [theme.concat('::css:watch'), theme.concat('::coffee:watch'), theme.concat('::react:watch'),
    theme.concat('::purejs:watch'), theme.concat('::images:watch'), theme.concat('::fonts:watch'),
    theme.concat('::vendor:watch')]

# SCSS #
gulp.task theme.concat("::css"), ->
  gulp.src(dev_path.scss.concat("*.scss"))
  .pipe($_.plumber())
  .pipe($_.sourcemaps.init())
  .pipe($_.sass.sync(
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    )
  )
  .pipe(minifyCSS(removeEmpty: true))
  .pipe($_.autoprefixer({browsers: ['ie > 8', '> 1%', 'last 2 versions', 'Firefox ESR']}))
  .pipe($_.sourcemaps.write())
  .pipe(concat("styles.css"))
  .pipe(gulp.dest(prod_path.css))
  .on('error', plumber)

  gulp.src(dev_path.css.concat("*.css"))
  .pipe(plumber())
  .pipe(minifyCSS(removeEmpty: true))
  .pipe(gulp.dest(prod_path.css))
  .on('error', plumber)

gulp.task theme.concat('::css:dev'), ->
  gulp.src(dev_path.scss.concat("*.scss"))
  .pipe($_.plumber())
  .pipe($_.sourcemaps.init())
  .pipe($_.sass.sync(
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    )
  )
  .pipe($_.autoprefixer({browsers: ['ie > 8', '> 1%', 'last 2 versions', 'Firefox ESR']}))
  .pipe($_.sourcemaps.write())
  .pipe(concat("styles.css"))
  .pipe(gulp.dest(prod_path.css))
  .on('error', plumber)

  gulp.src(dev_path.css.concat("*.css"))
  .pipe(plumber())
  .pipe(gulp.dest(prod_path.css))
  .on('error', plumber)

gulp.task theme.concat('::css:watch'), ->
  gulp.watch dev_path.scss.concat('**/*.scss'), [theme.concat('::css:dev')]
  gulp.watch dev_path.css.concat('**/*.css'), [theme.concat('::css:dev')]


# REACT #
gulp.task theme.concat('::react'), ->
  browserify(
    entries: __dirname.concat('/react/') + 'game/index.js'
    extensions: ['.js']
    debug: true).transform('babelify')
  .bundle()
  .pipe(plumber())
  .pipe(source('app.js'))
  .pipe(gulp.dest(prod_path.react))
  .on('error', plumber)

gulp.task theme.concat('::react:watch'), ->
  gulp.watch dev_path.react, [theme.concat('::react')]


# COFFEE #
gulp.task theme.concat('::coffee'), ->
  gulp.src(dev_path.coffee)
  .pipe(plumber())
  .pipe concat 'local.js'
  .pipe(coffee({bare: true}))
  .pipe($_.babel())
  # .pipe(uglify({outSourceMap: true}))
  .pipe(gulp.dest(prod_path.js))
  .on('error', plumber)

gulp.task theme.concat('::coffee:dev'), ->
  gulp.src(dev_path.coffee)
  .pipe(plumber())
  .pipe concat 'local.js'
  .pipe(coffee({bare: true}))
  .pipe($_.babel())
  .pipe(gulp.dest(prod_path.js))
  .on('error', plumber)

gulp.task theme.concat('::coffee:watch'), ->
  gulp.watch dev_path.coffee, [theme.concat('::coffee:dev')]


# PUREJS #
gulp.task theme.concat('::purejs'), ->
  gulp.src(dev_path.js)
  .pipe(plumber())
  .pipe($_.babel())
  # .pipe(uglify({outSourceMap: true}))
  .pipe concat('main.js')
  .pipe(gulp.dest(prod_path.js))
  .on('error', plumber)

gulp.task theme.concat('::purejs:watch'), ->
  gulp.watch dev_path.js.concat('/*.js'), [theme.concat('::purejs')]


# IMAGES #
gulp.task theme.concat('::images'), ->
  gulp.src(dev_path.images)
  .pipe(plumber())
  .pipe(gulp.dest(prod_path.images))
  .on('error', plumber)

gulp.task theme.concat('::images:watch'), ->
  gulp.watch dev_path.images, [theme.concat('::images')]


# FONTS #
gulp.task theme.concat('::fonts'), ->
  gulp.src(dev_path.fonts)
  .pipe(plumber())
  .pipe(gulp.dest(prod_path.fonts))
  .on('error', plumber)

gulp.task theme.concat('::fonts:watch'), ->
  gulp.watch dev_path.fonts, [theme.concat('::fonts')]


# VENDOR #
gulp.task theme.concat('::vendor'), ->
  gulp.src(dev_path.vendor)
  .pipe(plumber())
  .pipe(gulp.dest(prod_path.vendor))
  .on('error', plumber)

gulp.task theme.concat('::vendor:watch'), ->
  gulp.watch dev_path.vendor, [theme.concat('::vendor')]