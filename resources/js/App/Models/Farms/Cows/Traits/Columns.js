import AppCore from 'comptechsoft-app-starter'

const Makers = AppCore.GridMakers, Renderers = require('./../../../Animals/~Commons/renderers')

module.exports = [

    Makers.mkRecnoColumn(),

    Makers.mkColumn('animal_status', {
        caption: 'Stare animal',
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'center'
        },
        render: record => Renderers.animalStatus(record.animal),
    }),

    Makers.mkColumn('status_in_farm', {
        caption: 'Stare in ferma',
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'center'
        },
        render: record => {
            let statuses = {
                'activ': {
                    caption: 'A',
                    color: 'success',
                },
                'inactiv': {
                    caption: 'I',
                    color: 'danger',
                },
            }
            if(record.status_in_farm)
            {
                if(statuses.hasOwnProperty(record.status_in_farm))
                {
                    return '<span class="m-badge m-badge--' + statuses[record.status_in_farm].color + '">' + statuses[record.status_in_farm].caption + '</span>'
                }
                return record.status_in_farm
            }
            return '?'
        }
    }),

    Makers.mkColumn('matricol_number', {
        caption: 'Număr matricol',
        order: {default: true, dir: 'asc', field: 'animals.matricol_number', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.matricol_number
    }),
    
    Makers.mkColumn('short_number', {
        caption: 'Număr scurt',
        order: {default: false, dir: 'asc', field: 'farms_animals.short_number', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.short_number
    }),

    Makers.mkColumn('internal_number', {
        caption: 'Număr intern',
        order: {default: false, dir: 'asc', field: 'farms_animals.internal_number', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.internal_number
    }),

    Makers.mkColumn('birth_date', {
        caption: 'Data nașterii',
        order: {default: false, dir: 'asc', field: 'animals.birth_date', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: (record, v) => {
            if(record.animal.birth_date)
            {
                return v.datetime.setFormat('DD.MM.YYYY', record.animal.birth_date) + ' (' + record.animal.age + ')'
            }
            return null
        }
    }),

    Makers.mkColumn('pedigree', {
        caption: 'Ascendența',
    }, {
        component: 'cell-string',
        render: record => {
            return Renderers.animalInfo(record.animal, 'father_id', 'father') + '<i style="font-size:11px" class="la la-times"></i>' + Renderers.animalInfo(record.animal, 'mother_id', 'mother')
        }
    }),

    Makers.mkColumn('parity', {
        caption: 'Paritate',
        order: {default: true, dir: 'asc', field: 'animals.parity', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.animal.parity
    }),

    Makers.mkColumn('last_calving_date', {
        caption: 'Data ultimei fătări',
        order: {default: false, dir: 'asc', field: 'animals.last_calving_date', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: (record, v) => {
            if(record.animal.last_calving_date)
            {
                return v.datetime.setFormat('DD.MM.YYYY', record.animal.last_calving_date) 
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
            if( record.animal.breed_id )
            {
                r.push(record.animal.rasa.code);
                r.push(record.animal.rasa.breed);
            }
            if(record.breed)
            {
                r.push(record.animal.breed)
            }
            if(record.animal.breed_composition)
            {
                r.push(record.animal.breed_composition)
            }
            return r.join(', ')
        }
    }),

]