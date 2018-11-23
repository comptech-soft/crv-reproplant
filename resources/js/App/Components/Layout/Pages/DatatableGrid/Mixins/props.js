module.exports = {

    props: {
        caption: {default: 'My Caption'},
        icon: {default: ''},
        model: {required: true},
        id: {required: true},
        has_form: {default: true},
        actions: {type: Array, default: () => []},

        /**
         * comutarea din false in true ==> sa se faca populate
         */
        refresh: {default: false},
        
        /**
         * tabul initial
         */
        initial_current_tab: {default: 'list'}
    },

}