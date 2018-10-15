const mix = require('laravel-mix');

mix

    /**
     * compons plugins
     */
    // .js('resources/js/~Plugins/plugins.js', 'public/js/plugins.bundle.js')
    // .sass('resources/sass/vendors.scss', 'public/css/reproplant.bundle.css')

    /**
     * Main application
     */
    .js('resources/js/App/app.js', 'public/js/app.bundle.js')
    
    /**
     * Login application
     */
    // .js('resources/js/Login/app.js', 'public/js/login.bundle.js')
    
    
    
    
    
;
