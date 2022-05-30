const mix = require('laravel-mix')

require('laravel-mix-tailwind')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js('resources/js/app.js', 'public/js/app.js')
  .sass('resources/sass/app.scss', 'public/css/app.css')
  .tailwind('./tailwind.config.js')
  .sourceMaps()

if (mix.inProduction()) {
  mix.version()
}

mix.browserSync({
  host: '127.0.0.1',
  proxy: 'localhost',
  open: false,
  files: [
    'app/**/*.php',
    'resources/views/**/*.php',
    'packages/mixdinternet/frontend/src/**/*.php',
    'public/js/**/*.js',
    'public/css/**/*.css'
  ],
  watchOptions: {
    usePolling: true,
    interval: 500
  }
})
