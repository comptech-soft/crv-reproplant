module.exports = { 
    name: 'animals',
    path: '/animals/:type/:gender', 
    components: {
        page: require('./../../Views/Animals/Animals/Page'),
        header: require('./../../Views/Animals/Animals/Header')
    }
}