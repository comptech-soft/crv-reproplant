module.exports = { 
    name: 'farm',
    path: '/farm/:id', 
    components: {
        page: require('./../../Views/Farms/Farm/Page'),
    },
    // children: [
    //     {
    //         name: 'farm-dashboard',
    //         path: 'dashboard',
    //         component: require('./../../Views/Farms/Farm/Children/Dashboard/Dashboard')
    //     },
    // ]
}