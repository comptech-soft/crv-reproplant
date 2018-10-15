import AppCore from 'comptechsoft-app-starter'

$(document).ready( () => {

    window.csApp = new AppCore.App('crv-reproplant')

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