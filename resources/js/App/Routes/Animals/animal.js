module.exports = { 
    name: 'animal',
    path: '/animal/:id/:current?', 
    components: {
        page: require('./../../Views/Animals/Animal/Page'),
    },
}