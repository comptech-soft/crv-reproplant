const FackeClick = () => {
    let t = setTimeout( () => {
        $('body').trigger('click')
    }, 250)
}

module.exports = {
    caption: 'Instrumente',
    options: {
        
        ferme:  [
            {
                icon: 'share',
                caption: 'Lista fermelor',
                click: v => {
                    v.$router.push({name: 'farms'})
                    FackeClick()
                }
            },
        ],

        animale: [
            {
                icon: 'share',
                caption: 'Lista generală de tauri',
                click: v => {
                    v.$router.push({name: 'animals', params: {type: 'sire', gender: 'male'}})
                    FackeClick()
                }
            },

            {
                icon: 'share',
                caption: 'Valori de ameliorare',
                click: v => {
                    v.$router.push({name: 'breeding', params: {type: 'sire', gender: 'male'}})
                    FackeClick()
                }
            },
        ],
    }
}