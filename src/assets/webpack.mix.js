const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);


//mix.js('vendor/wtolk/crud/src/assets/js/admin.js', 'vendor/wtolk/crud/js/')
mix.scripts([
    'vendor/wtolk/crud/src/assets/lib/cropper/cropper.min.js',
    'vendor/wtolk/crud/src/assets/lib/jquery/jquery-3.5.1.min.js',
    'vendor/wtolk/crud/src/assets/lib/hystmodal/hystmodal.js',
    'vendor/wtolk/crud/src/assets/lib/cropper/cropper.min.js',
    'vendor/wtolk/crud/src/assets/lib/jquery-nestable/jquery.nestable.min.js',
    'vendor/wtolk/crud/src/assets/lib/selectize/selectize.js',
    'vendor/wtolk/crud/src/assets/lib/sortable/Sortable.min.js',
    'vendor/wtolk/crud/src/assets/lib/wtolk-uploader/wtolk-uploader.js',
], 'public/vendor/wtolk/crud/js/admin.js');


//reqire MicroPlugin from '../lib/selectize/microplugin.min';
//import MicroPlugin from '../lib/selectize/microplugin.min';


mix.sass('vendor/wtolk/crud/src/assets/scss/adfm-panel.scss', 'vendor/wtolk/crud/css/');
mix.copy('public/vendor/wtolk/crud/css/adfm-panel.css', 'vendor/wtolk/crud/src/assets/css/adfm-panel.css');

mix.sass('app/Adfm/assets/scss/public.scss', 'vendor/wtolk/adfm/css/');
