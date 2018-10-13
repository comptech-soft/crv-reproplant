module.exports = {

    setConfig(state)
    {
        state.mounted = false;
        csApp.Http.Post('app-configuration', {},  data => {
            state.user = data.user
            state.config = data.config
            state.role = data.role
            state.mounted = true;
        })
       
    },

    // setBrandMenu(state, menu)
	// {
	// 	state.brand_menu = menu
	// },

}
