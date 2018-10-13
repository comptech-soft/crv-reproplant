module.exports = {

    user: state => state.user,

    config: state => state.config,

    role: state => state.role,

    mounted: state => {
        if( state.config === null)
        {
            return false
        }
        return state.mounted
    },

    url: state => {
        if( state.config == null)
        {
            return null
        }
        return state.config.base_url + '/'
    },

    // brand_menu: state => state.brand_menu,

}
