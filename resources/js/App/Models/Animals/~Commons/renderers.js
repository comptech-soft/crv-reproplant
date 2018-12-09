module.exports = {

    animalInfo: (animal, field, relation, gender = 'male') => {

        if(! animal[field]) 
        {
            return '-'
        }
        if( gender == 'male')
        {
            return animal[relation].short_name 
                || animal[relation].long_name 
                || animal[relation].interbull_code 
                || animal[relation].matricol_number 
                || animal[relation].cod_ro 
                || animal[relation].naab
        }
        return animal[relation].matricol_number 
            || animal[relation].short_name 
            || animal[relation].long_name 
            || animal[relation].interbull_code 
            || animal[relation].cod_ro 
            || animal[relation].naab
    }, 
    
    animalStatus: record => {

        let statuses = {
            'adaugat-ferma' : {
                caption: 'AF',
                color: 'warning',
            },
            'valid': {
                caption: 'V',
                color: 'success',
            },
            'invalid': {
                caption: 'INV',
                color: 'danger',
            },
            'inactiv': {
                caption: 'I',
                color: 'danger',
            }
        }
        if(record.animal_status)
        {
            if(statuses.hasOwnProperty(record.animal_status))
            {
                return '<span class="m-badge m-badge--' + statuses[record.animal_status].color + '">' + statuses[record.animal_status].caption + '</span>'
            }
            return record.animal_status
        }
        return '?'
    }

}