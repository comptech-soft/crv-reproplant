import AppCore from 'comptechsoft-app-starter'

$(document).ready( () => {

    window.csApp = new AppCore.App('crv-reproplant-login')

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