module.exports = {

    setConfig(state)
    {
        state.mounted = false
        csApp.Http.Post('app-configuration', {},  data => {
            state.user = data.user
            state.config = data.config
            state.role = data.role
            state.mounted = true
        })
       
    },

    getFarm(state, id)
    {
        state.farm.loading = true
        csApp.Http.Post('api/get-record', {
            model: '\\App\\Models\\Farms\\Farms\\Farm',
            id
        },  data => {
            state.farm.record = data.result.payload.record
            state.farm.loading = false
        })
       
    },

    setFarm(state, farm)
    {
        state.farm.record = farm
    }

}
