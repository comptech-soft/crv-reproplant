const mix = require('laravel-mix');

mix

    .js('resources/js/App/app.js', 'public/js/app.bundle.js')
    
    .js('resources/js/Login/app.js', 'public/js/login.bundle.js')
    
    
    // .sass('resources/sass/vendors.scss', 'public/css/reproplant.bundle.css')
    
    
;
