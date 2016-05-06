// ## Globals
var argv         = require('minimist')(process.argv.slice(2));
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create();
var changed      = require('gulp-changed');
var concat       = require('gulp-concat');
var flatten      = require('gulp-flatten');
var gulp         = require('gulp');
var gulpif       = require('gulp-if');
var imagemin     = require('gulp-imagemin');
var jshint       = require('gulp-jshint');
var lazypipe     = require('lazypipe');
var less         = require('gulp-less');
var merge        = require('merge-stream');
var cssNano      = require('gulp-cssnano');
var plumber      = require('gulp-plumber');
var rev          = require('gulp-rev');
var runSequence  = require('run-sequence');
var sass         = require('gulp-sass');
var sourcemaps   = require('gulp-sourcemaps');
var uglify       = require('gulp-uglify');
var iconfont     = require('gulp-iconfont');
var consolidate  = require('gulp-consolidate');

var slug = require('slug');
var _ = require('underscore');
var fs = require('fs');
var request = require('request')
// See https://github.com/austinpray/asset-builder
var manifest = require('asset-builder')('./assets/manifest.json');

// `path` - Paths to base asset directories. With trailing slashes.
// - `path.source` - Path to the source files. Default: `assets/`
// - `path.dist` - Path to the build directory. Default: `dist/`
var path = manifest.paths;

// `config` - Store arbitrary configuration values here.
var config = manifest.config || {};

// `globs` - These ultimately end up in their respective `gulp.src`.
// - `globs.js` - Array of asset-builder JS dependency objects. Example:
//   ```
//   {type: 'js', name: 'main.js', globs: []}
//   ```
// - `globs.css` - Array of asset-builder CSS dependency objects. Example:
//   ```
//   {type: 'css', name: 'main.css', globs: []}
//   ```
// - `globs.fonts` - Array of font path globs.
// - `globs.images` - Array of image path globs.
// - `globs.bower` - Array of all the main Bower files.
var globs = manifest.globs;

// `project` - paths to first-party assets.
// - `project.js` - Array of first-party JS assets.
// - `project.css` - Array of first-party CSS assets.
var project = manifest.getProjectGlobs();

// CLI options
var enabled = {
  // Enable static asset revisioning when `--production`
  rev: argv.production,
  // Disable source maps when `--production`
  maps: !argv.production,
  // Fail styles task on error when `--production`
  failStyleTask: argv.production,
  // Fail due to JSHint warnings only when `--production`
  failJSHint: argv.production,
  // Strip debug statments from javascript when `--production`
  stripJSDebug: argv.production
};

// Path to the compiled assets manifest in the dist directory
var revManifest = path.dist + 'assets.json';

// ## Reusable Pipelines
// See https://github.com/OverZealous/lazypipe

// ### CSS processing pipeline
// Example
// ```
// gulp.src(cssFiles)
//   .pipe(cssTasks('main.css')
//   .pipe(gulp.dest(path.dist + 'styles'))
// ```
var cssTasks = function(filename) {
  return lazypipe()
    .pipe(function() {
      return gulpif(!enabled.failStyleTask, plumber());
    })
    .pipe(function() {
      return gulpif(enabled.maps, sourcemaps.init());
    })
    .pipe(function() {
      return gulpif('*.less', less());
    })
    .pipe(function() {
      return gulpif('*.scss', sass({
        outputStyle: 'nested', // libsass doesn't support expanded yet
        precision: 10,
        includePaths: ['.'],
        errLogToConsole: !enabled.failStyleTask
      }));
    })
    .pipe(concat, filename)
    .pipe(autoprefixer, {
      browsers: [
        'last 2 versions',
        'android 4',
        'opera 12'
      ]
    })
    .pipe(cssNano, {
      safe: true
    })
    .pipe(function() {
      return gulpif(enabled.rev, rev());
    })
    .pipe(function() {
      return gulpif(enabled.maps, sourcemaps.write('.', {
        sourceRoot: 'assets/styles/'
      }));
    })();
};

// ### JS processing pipeline
// Example
// ```
// gulp.src(jsFiles)
//   .pipe(jsTasks('main.js')
//   .pipe(gulp.dest(path.dist + 'scripts'))
// ```
var jsTasks = function(filename) {
  return lazypipe()
    .pipe(function() {
      return gulpif(enabled.maps, sourcemaps.init());
    })
    .pipe(concat, filename)
    .pipe(uglify, {
      compress: {
        'drop_debugger': enabled.stripJSDebug
      }
    })
    .pipe(function() {
      return gulpif(enabled.rev, rev());
    })
    .pipe(function() {
      return gulpif(enabled.maps, sourcemaps.write('.', {
        sourceRoot: 'assets/scripts/'
      }));
    })();
};

// ### Write to rev manifest
// If there are any revved files then write them to the rev manifest.
// See https://github.com/sindresorhus/gulp-rev
var writeToManifest = function(directory) {
  return lazypipe()
    .pipe(gulp.dest, path.dist + directory)
    .pipe(browserSync.stream, {match: '**/*.{js,css}'})
    .pipe(rev.manifest, revManifest, {
      base: path.dist,
      merge: true
    })
    .pipe(gulp.dest, path.dist)();
};

// ## Gulp tasks
// Run `gulp -T` for a task summary

// ### Styles
// `gulp styles` - Compiles, combines, and optimizes Bower CSS and project CSS.
// By default this task will only log a warning if a precompiler error is
// raised. If the `--production` flag is set: this task will fail outright.
gulp.task('styles', ['wiredep'], function() {
  var merged = merge();
  manifest.forEachDependency('css', function(dep) {
    var cssTasksInstance = cssTasks(dep.name);
    if (!enabled.failStyleTask) {
      cssTasksInstance.on('error', function(err) {
        console.error(err.message);
        this.emit('end');
      });
    }
    merged.add(gulp.src(dep.globs, {base: 'styles'})
      .pipe(cssTasksInstance));
  });
  return merged
    .pipe(writeToManifest('styles'));
});

// ### Scripts
// `gulp scripts` - Runs JSHint then compiles, combines, and optimizes Bower JS
// and project JS.
gulp.task('scripts', ['jshint'], function() {
  var merged = merge();
  manifest.forEachDependency('js', function(dep) {
    merged.add(
      gulp.src(dep.globs, {base: 'scripts'})
        .pipe(jsTasks(dep.name))
    );
  });
  return merged
    .pipe(writeToManifest('scripts'));
});

gulp.task('font-socialIcons', function(){
  var fontName = 'socialIcons';
  return gulp.src([path.source + 'socialIcons/*.svg'])
    .pipe(iconfont({
       formats: ['ttf', 'eot', 'woff', 'woff2'],
       fontName: fontName,
       normalize:true
    }))
    .on('glyphs', function(glyphs, options) {
        gulp.src('assets/socialIcons/_fonts.scss')
          .pipe(consolidate('lodash', {
            glyphs: glyphs,
            fontName: fontName,
            fontPath: '../fonts/',
            cssClass: 'ic'
          }))
          .pipe(gulp.dest('assets/styles/common/'));
    })
   .pipe(gulp.dest(path.dist + 'fonts'))
   .pipe(browserSync.stream());
});
// ### Fonts
// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
gulp.task('fonts', function() {
  return gulp.src(globs.fonts)
    .pipe(flatten())
    .pipe(gulp.dest(path.dist + 'fonts'))
    .pipe(browserSync.stream());
});

// ### Images
// `gulp images` - Run lossless compression on all the images.
gulp.task('images', function() {
  return gulp.src(globs.images)
    .pipe(imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{removeUnknownsAndDefaults: false}, {cleanupIDs: false}]
    }))
    .pipe(gulp.dest(path.dist + 'images'))
    .pipe(browserSync.stream());
});

// ### JSHint
// `gulp jshint` - Lints configuration JSON and project JS.
gulp.task('jshint', function() {
  return gulp.src([
    'bower.json', 'gulpfile.js'
  ].concat(project.js))
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(gulpif(enabled.failJSHint, jshint.reporter('fail')));
});

// ### Clean
// `gulp clean` - Deletes the build folder entirely.
gulp.task('clean', require('del').bind(null, [path.dist]));

// ### Watch
// `gulp watch` - Use BrowserSync to proxy your dev server and synchronize code
// changes across devices. Specify the hostname of your dev server at
// `manifest.config.devUrl`. When a modification is made to an asset, run the
// build step for that asset and inject the changes into the page.
// See: http://www.browsersync.io
gulp.task('watch', ['build'], function() {
  browserSync.init({
    files: ['{lib,templates}/**/*.php', '*.php'],
    proxy: config.devUrl,
    snippetOptions: {
      whitelist: ['/wp-admin/admin-ajax.php'],
      blacklist: ['/wp-admin/**']
    }
  });
  gulp.watch([path.source + 'styles/**/*'], ['styles']);
  gulp.watch([path.source + 'scripts/**/*'], ['jshint', 'scripts']);
  gulp.watch([path.source + 'fonts/**/**'], ['fonts']);
  gulp.watch([path.source + 'socialIcons/*.svg'], ['font-socialIcons']);
  gulp.watch([path.source + 'images/**/*'], ['images']);
  gulp.watch(['bower.json', 'assets/manifest.json'], ['build']);
});

// ### Build
// `gulp build` - Run all the build tasks but don't clean up beforehand.
// Generally you should be running `gulp` instead of `gulp build`.
gulp.task('build', function(callback) {
  runSequence(['fonts', 'font-socialIcons'],
              'styles',
              'scripts',
              'images',
              callback);
});

// ### Wiredep
// `gulp wiredep` - Automatically inject Less and Sass Bower dependencies. See
// https://github.com/taptapship/wiredep
gulp.task('wiredep', function() {
  var wiredep = require('wiredep').stream;
  return gulp.src(project.css)
    .pipe(wiredep())
    .pipe(changed(path.source + 'styles', {
      hasChanged: changed.compareSha1Digest
    }))
    .pipe(gulp.dest(path.source + 'styles'));
});



var cities = [];
function getCities(callback){

  request.get('https://wiki.nuitdebout.fr/api.php?action=query&generator=categorymembers&gcmtitle=Cat%C3%A9gorie:Ville_NuitDebout&prop=pagecllimit=max&gcmlimit=max&format=json', function(err,res, body) {
     var info = JSON.parse(body);
     _.each(info.query.pages, function(page) {
            var pt = page.title;
            if(pt !=='Villes/en' && pt !=='Villes' && pt !=='Villes/fr' && pt.match(/Villes/g)){
               var name = pt.replace('Villes/', '')
               var nicename = slug(name, {lower: true})
               var wiki_uri = page.title
               cities.push({
                  wiki_uri: wiki_uri,
                  wiki_url: 'https://wiki.nuitdebout.fr/wiki/'+wiki_uri,
                  uri: '/ville/' + nicename,
                  slug: nicename,
                  raw : '',
                  name: name,
                  links : [],
                  linksFacebook : [],
                  linksTwitter : '',
                  linksChat : [],
                  linksContact : [],
                  map : '',
                  sections : [],
                  categories : [],
                  images : [],
              })
             }
     })

  function getCityDetails(city, cb) {

      request.get('https://wiki.nuitdebout.fr/api.php?action=parse&page='+city.wiki_uri+'&contentmodel=wikitext&format=json', function(err,res, body) {
          var data = JSON.parse(body);
          //console.log(data.parse)
          _.each(data.parse.externallinks, function(link_){
            //console.log(link_)
            link = link_;
            if(link !== 'https://twitter.com/NOM_DU_COMPTE_TWITTER'){

              if (matches = /(twitter.com)/g.exec(link)) {
                  city.linksTwitter = link;
              }
              if (matches = /(chat.nuitdebout.fr)/g.exec(link)) {
                  city.linksChat.push(link);
              }
              if (matches = /(openstreetmap.org)/g.exec(link)) {
                  city.map = link;
              }
              if (matches = /(facebook.com)/g.exec(link)) {
                  city.linksFacebook.push(link);
              }
               if (matches = /(@)/g.exec(link)) {
                  city.linksContact.push(link);
              }
              // add any in array
              city.links.push(link);
            }
          })
          _.each(data.parse.sections, function(section){
            //console.log(section)
          });
          _.each(data.parse.categories, function(categorie){
            //console.log(categorie)
            city.categories.push(categorie['*'])
          });
          _.each(data.parse.images, function(image){
            if(image !=='Twitter.svg' && image !=='F_icon.svg' && image !=='At_sign.svg' ){
              console.log('img: '+image)
              // seems there is a way to get image url but need extra api call..
              //https://wiki.nuitdebout.fr/api.php?action=query&titles=File:Arras_beffroi.jpg&prop=imageinfo&iilimit=50&iiend=2007-12-31T23:59:59Z&iiprop=timestamp|user|url
              city.images.push(image)
            }
          });

          var content = data.parse.text['*']
          var regex_comments = /(<!--)[^]*(-->)/gi;
          var regex_break = /(<div style="clear:both;"><\/div>)/g
          //respan = /<span class=\"mw-editsection-bracket\">[^<>]*<\/span>/g;
          content = content.replace(regex_comments, "");
          //content = content.replace(respan, "----");
          content = content.replace(regex_break, "");
          regex_form = /<div class=\"mw-inputbox-centered\" [^]*>[^]*<\/div>/g;
          regex_e = /modifier le wikicode/g;
          regex_f = /modifier/g;
          regex_i = /\/images\/thumb/g;
          regex_brack_open = /(<span class=\"mw-editsection-bracket\">\[<\/span>)/gi;
          regex_brack_close = /(<span class=\"mw-editsection-bracket\">\]<\/span>)/gi;
          regex_k = /<span class=\"mw-editsection-divider\"> \| <\/span>/gi;
          regex_wikiword = /href=\"\/wiki\//g;
          regex_notice= /(<p><br \/><br \/>[^]*<\/p>)/gi;
          regex_div_float = /<div style=\"float:left;\">/gi;
          regex_o = /&#160;;/gi;
          regex_wikilink = /\/index.php\?title/gi;
          regex_toc = /(<div id=\"toc\" class=\"toc\">[^]*<\/div>)/gi;

          content = content.replace(regex_e, "");
          content = content.replace(regex_f, "");
          content = content.replace(regex_i, "https://wiki.nuitdebout.fr/images/thumb");
          content = content.replace(regex_brack_open, "");
          content = content.replace(regex_brack_close, "");
          content = content.replace(regex_k, "");
          content = content.replace(regex_wikiword, ' href="https://wiki.nuitdebout.fr/wiki/');
          content = content.replace(regex_form, "");
          content = content.replace(regex_notice, "");
          content = content.replace(regex_div_float, "");
          content = content.replace(regex_o, "");
          content = content.replace(regex_wikilink, "https://wiki.nuitdebout.fr/index.php?title");
          content = content.replace(regex_toc, "");

          city.raw = content
          cb(city);
      })
  };

  function eachAsync(arr, func, cb) {
      var doneCounter = 0,
        results = [];
      arr.forEach(function (item) {
        func(item, function (res) {
          doneCounter += 1;
          results.push(res);
          if (doneCounter === arr.length) {
            //
            cb(results);
          }
        });
      });
    }

    eachAsync(cities, getCityDetails, function(results) {
      callback.apply(undefined, [results]);
    });

  })
}

/**
 * Retrieves the list of cities from the wiki and creates a JSON file.
 */
gulp.task('import:cities', function(cb) {
  getCities(function(newCities) {
    fs.writeFile('data/cities.json', JSON.stringify(newCities, null, 2), function(err) {
      if (err) {
        return console.log(err);
      }
      cb();
    });
 });
});




// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.
gulp.task('default', ['clean'], function() {
  gulp.start('build');
});
