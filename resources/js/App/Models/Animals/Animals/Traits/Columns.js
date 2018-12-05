import AppCore from 'comptechsoft-app-starter'

const Makers = AppCore.GridMakers, Renderers = require('./../../~Commons/renderers')

module.exports = [

    Makers.mkRecnoColumn(),
    
    Makers.mkColumn('animal_status', {
        caption: 'Stare animal',
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'center'
        },
        render: record => Renderers.animalStatus(record),
    }),

    Makers.mkColumn('interbull_code', {
        caption: 'International ID',
        order: {default: true, dir: 'asc', field: 'animals.interbull_code', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.interbull_code || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.id}})
    }),

    Makers.mkColumn('short_name', {
        caption: 'Nume scurt',
        order: {default: false, dir: 'asc', field: 'animals.short_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.short_name || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.id}})
    }),

    Makers.mkColumn('long_name', {
        caption: 'Nume',
        order: {default: false, dir: 'asc', field: 'animals.long_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.long_name || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.id}})
    }),

    Makers.mkColumn('pedigree', {
        caption: 'Ascendența',
    }, {
        component: 'cell-string',
        render: record => {
            let fatherInfos = Renderers.animalInfo(record, 'father_id', 'father')
            let separator = '<i style="font-size:11px" class="la la-times"></i>'
            return fatherInfos + separator + (
                record.mother_id 
                ? Renderers.animalInfo(record.mother, 'father_id', 'father')
                : '-'
            )
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
        Makers.actUpdate(true, 'la la-pencil'),
        Makers.actDelete(true, 'la la-trash'),
        {
            icon: 'la la-folder-o',
            caption: 'Deschide',
            click: v => v.$router.push({
                name: 'animal', 
                params: {
                    id: v.record.id
                }
            })
        }
    ]),

]