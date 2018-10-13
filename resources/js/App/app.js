try 
{
    window.Popper = require('popper.js').default
    window.$ = window.jQuery = require('jquery')
    require('bootstrap')
    require('jquery-confirm')
    require('block-ui')
    window.PerfectScrollbar = require('perfect-scrollbar').default
} 
catch(e)
{
    console.log('========== index.js ==========')
    console.error(e)
    console.log('==============================')
}

$(document).ready( () => {
    const App = require('comptechsoft-app-starter').App
    window.csApp = new App('my-app')
    csApp
        .setConfig()
        .setLanguages({
            de: require('./Languages/de'),
            en: require('./Languages/en'),
            es: require('./Languages/es'),
            ro: require('./Languages/ro'),
        })
        .setStore(require('./Store/store'))
        .setRoutes(require('./Routes/routes'))
        .setComponents(require('./Components/components'))
        .run()
})