module.exports = {

    data() {
        return {
            record: {
                id: null,
                type: 'sire',
                gender: 'male',
                animal_status: null,
                short_name: '',
                long_name: '',
                interbull_code: '',
                matricol_number: '',
                naab: '',
                cod_ro: '',
                birth_date: null,
                breed_id: null,
                color_id: null,
                company_id: null,
                father_id: null,
                mother_id: null,

                names: '',
                codes: '',

                short_number: '',
                internal_number: '',
                status_in_farm: '',
                farm_id: null,
            },

            add_company: {
                visible: false,
                reload: 0,
            },

            father: null,
            
            mother: null,
            
            quick_add_form: {
                visible: false,
                type: null,
                gender: null,
            },
        }
    },
    
}