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
            de: require('./../App/Languages/de'),
            en: require('./../App/Languages/en'),
            es: require('./../App/Languages/es'),
            ro: require('./../App/Languages/ro'),
        })
        .setStore(require('./../App/Store/store'))
        .setComponents(require('./Components/components'))
        .run()
})