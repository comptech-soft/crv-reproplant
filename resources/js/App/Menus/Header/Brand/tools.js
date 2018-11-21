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
                icon: '/img/icons/farm.png',
                caption: 'Lista fermelor',
                click: v => {
                    v.$router.push({name: 'farms'})
                    FackeClick()
                }
            },
        ],

        animale: [
            {
                icon: '/img/icons/bull.png',
                caption: 'Lista generală de tauri',
                click: v => {
                    v.$router.push({name: 'animals', params: {type: 'sire', gender: 'male'}})
                    FackeClick()
                }
            },

            {
                icon: '/img/icons/bull.png',
                caption: 'Valori de ameliorare',
                click: v => {
                    v.$router.push({name: 'breeding', params: {type: 'sire', gender: 'male'}})
                    FackeClick()
                }
            },
        ],
    }
}