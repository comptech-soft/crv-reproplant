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
        animale: 
        [
            {
                icon: 'share',
                caption: 'Lista generală de tauri',
                click: v => v.$router.push({name: 'animals', params: {type: 'sire', gender: 'male'}})
            },

            {
                icon: 'share',
                caption: 'Valori de ameliorare',
                click: v => v.$router.push({name: 'breeding', params: {type: 'sire', gender: 'male'}})
            },
        ],
    }
}