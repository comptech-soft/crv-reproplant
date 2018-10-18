import AppCore from 'comptechsoft-app-starter'

const Makers = AppCore.GridMakers
const animalInfo = (animal, field, relation) => {

    if(! animal[field]) 
    {
        return '-'
    }
    return animal[relation].short_name 
        || animal[relation].long_name 
        || animal[relation].interbull_code 
        || animal[relation].matricol_number 
        || animal[relation].cod_ro 
        || animal[relation].naab
} 

module.exports = [

    Makers.mkRecnoColumn(),
    
    Makers.mkColumn('animal_status', {
        caption: 'Stare animal',
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'center'
        },
        render: record => {

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
                    caption: 'IV',
                    color: 'danger',
                },
                'inactiv': {
                    caption: 'IA',
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
    }),

    Makers.mkColumn('interbull_code', {
        caption: 'International ID',
        order: {default: true, dir: 'asc', field: 'animals.interbull_code', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.interbull_code,
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                // color: record.status == 'inactiv' ? '#f4516c' : '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.id}})
    }),

    Makers.mkColumn('short_name', {
        caption: 'Nume scurt',
        order: {default: false, dir: 'asc', field: 'animals.short_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.short_name
    }),

    Makers.mkColumn('long_name', {
        caption: 'Nume',
        order: {default: false, dir: 'asc', field: 'animals.long_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.long_name
    }),

    Makers.mkColumn('pedigree', {
        caption: 'Ascendența',
    }, {
        component: 'cell-string',
        render: record => {
            return animalInfo(record, 'father_id', 'father') + '<i style="font-size:11px" class="la la-times"></i>' + animalInfo(record, 'mother_id', 'mother')
        }
    }),

    Makers.mkColumn('naab', {
        caption: 'NAAB',
        order: {default: false, dir: 'asc', field: 'animals.naab', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.naab
    }),

    Makers.mkColumn('matricol_number', {
        caption: 'ID',
        order: {default: false, dir: 'asc', field: 'animals.matricol_number', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.matricol_number
    }),

    Makers.mkColumn('cod_ro', {
        caption: 'Cod Ro',
        order: {default: false, dir: 'asc', field: 'animals.cod_ro', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.cod_ro
    }),

    Makers.mkColumn('birth_date', {
        caption: 'Data nașterii',
        order: {default: false, dir: 'asc', field: 'animals.birth_date', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: (record, v) => {
            if(record.birth_date)
            {
                return v.datetime.setFormat('DD.MM.YYYY', record.birth_date) + ' (' + record.age + ')'
            }
            return null
        }
    }),

    Makers.mkColumn('breed', {
        caption: 'Rasa',
    }, {
        component: 'cell-string',
        render: record => {
            let r = []
            if( record.breed_id )
            {
                r.push(record.rasa.code);
                r.push(record.rasa.breed);
            }
            if(record.breed)
            {
                r.push(record.breed)
            }
            if(record.breed_composition)
            {
                r.push(record.breed_composition)
            }
            return r.join(', ')
        }
    }),

    Makers.mkColumn('company', {
        caption: 'Firma',
    }, {
        component: 'cell-string',
        render: record => {
            if( ! record.company_id )
            {
                return null
            }
            if(record.company.logo)
            {
                return '<img class="cs-cell-image img-fluid" src="' + record.company.logo + '" />'
            }
            return record.company.name
        }
    }),


    Makers.mkActionsColumn([
        Makers.actUpdate('la la-pencil'),
        Makers.actDelete('la la-trash'),
        // {
        //     icon: 'la la-folder-o',
        //     caption: 'Deschide',
        //     click: v => v.$router.push({
        //         name: 'farm', 
        //         params: {
        //             id: v.record.id
        //         }
        //     })
        // }
    ]),

]