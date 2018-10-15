module.exports = {
    caption: 'Instrumente',
    options: {
        ferme: 
        [
            {
                icon: 'share',
                caption: 'Lista fermelor',
                click: v => v.$router.push({name: 'farms'})
            },
        ],
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