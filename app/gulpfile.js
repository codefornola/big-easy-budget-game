/**
 * 'app' and 'www' assets must be compiled separately via gulp
 */


// Uncomment below for app assets
var elixir = require('laravel-elixir');
elixir(function(mix) {
    mix.sass('auth.scss',  'public/assets/game/css/auth.css');
    mix.sass('game.scss',  'public/assets/game/css/main.css');
    mix.sass('home.scss',  'public/assets/home/css/main.css');
    mix.less('admin.less', 'public/assets/admin/css/main.css');
});

// Uncomment below for www assets
// require('./resources/assets/www/elixir.js');
// elixir(function(mix) {
//     mix.www();// Marketing site
// });