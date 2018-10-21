module.exports = { 
    name: 'breeding',
    path: '/breeding/:type/:gender', 
    components: {
        page: require('./../../Views/Animals/Breeding/Page'),
        header: require('./../../Views/Animals/Breeding/Header')
    }
}