module.exports = {

    data() {
        return {
            record: {
                id: null,
                farm: '',
                cod_exploatatie: '',
                cif: '',
                status: 'activ',
                address: '',
                email: '',
                country_id: null,
                region_id: null,
                judet_id: null,
                locality_id: null,
            },

            region_load: 0,
            
            judet_load: 0,
            
            locality_load: 0,
        }
    },
    
}