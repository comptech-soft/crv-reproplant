module.exports = { 
    name: 'farm',
    path: '/farm/:id/:current?', 
    components: {
        page: require('./../../Views/Farms/Farm/Page'),
    },
}