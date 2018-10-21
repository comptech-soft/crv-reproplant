module.exports = { 
    name: 'animal',
    path: '/animal/:id', 
    components: {
        page: require('./../../Views/Animals/Animal/Page'),
    },
}