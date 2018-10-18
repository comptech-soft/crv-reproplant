module.exports = {
    title: (type, gender) => {
        if( (type == 'sire') && (gender == 'male') )
        {
            return 'Lista generală de tauri'
        }
        return '?'
    },
    breadcrumbs: [],
    actions: {
        caption: 'Acțiuni',
        options: {
            // a: 
            // [
            //     {
            //         icon: 'share',
            //         caption: 'Option #1'
            //     },
            // ],
            // b: 
            // [
            //     {
            //         icon: 'lifebuoy',
            //         caption: 'Option #2',
            //     },

            //     {
            //         icon: 'info',
            //         caption: 'Option #3',
            //     }
            // ] 
        }
    }
}