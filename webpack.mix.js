const mix = require('laravel-mix');

mix

    /**
     * commons plugins
     */
    .js('resources/js/~Plugins/plugins.js', 'public/js/plugins.bundle.js')
    .sass('resources/sass/Vendors.scss', 'public/css/reproplant.bundle.css')
    .sass('resources/sass/Custom.scss', 'public/css/custom.bundle.css')

    /**
     * Main application
     */
    .js('resources/js/App/app.js', 'public/js/app.bundle.js')
    
    /**
     * Login application
     */
    .js('resources/js/Login/app.js', 'public/js/login.bundle.js')
    
;
