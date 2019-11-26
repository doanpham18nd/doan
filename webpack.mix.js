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

// mix.react('resources/js/app.js', 'public/js');
mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/medicine.js', 'public/js');
mix.react('resources/js/scheduleContent.js', 'public/js');
mix.react('resources/js/header.js', 'public/js');
mix.react('resources/js/newChat.js', 'public/js');
mix.react('resources/js/frontend.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
// mix.react('resources/js/chat.js', 'public/js');
