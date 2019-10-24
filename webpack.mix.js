const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

    .sass('resources/assets/sunsun/common/scss/reset.scss', 'public/common/css')
    .sass('resources/assets/sunsun/front/scss/base.scss', 'public/sunsun/front/css')

    .js('resources/assets/sunsun/front/js/base.js', 'public/sunsun/front/js')
    .js('resources/assets/sunsun/front/js/booking.js', 'public/sunsun/front/js')
    .js('resources/assets/sunsun/front/js/add_user_booking.js', 'public/sunsun/front/js')
    .sass('resources/assets/sunsun/front/scss/booking.scss', 'public/sunsun/front/css')
    .sass('resources/assets/sunsun/front/scss/booking-mobile.scss', 'public/sunsun/front/css')



    .copyDirectory('resources/assets/sunsun/imgs', 'public/sunsun/imgs')
    .copyDirectory('resources/assets/sunsun/lib', 'public/sunsun/lib');
