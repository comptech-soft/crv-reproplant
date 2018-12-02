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
        caption: 'Stare în fermă',
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

    Makers.mkColumn('interbull_code', {
        caption: 'International ID',
        order: {default: true, dir: 'asc', field: 'animals.interbull_code', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.interbull_code || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.animal.id}})
    }),

    Makers.mkColumn('short_name', {
        caption: 'Nume scurt',
        order: {default: false, dir: 'asc', field: 'animals.short_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.short_name || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.animal.id}})
    }),

    Makers.mkColumn('long_name', {
        caption: 'Nume',
        order: {default: false, dir: 'asc', field: 'animals.long_name', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.long_name || '-',
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'animal', params: {id: record.animal.id}})
    }),

    Makers.mkColumn('pedigree', {
        caption: 'Ascendența',
    }, {
        component: 'cell-string',
        render: record => {
            return Renderers.animalInfo(record.animal, 'father_id', 'father') + '<i style="font-size:11px" class="la la-times"></i>' + Renderers.animalInfo(record.animal, 'mother_id', 'mother')
        }
    }),

    Makers.mkColumn('naab', {
        caption: 'NAAB',
        order: {default: false, dir: 'asc', field: 'animals.naab', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.naab
    }),

    Makers.mkColumn('matricol_number', {
        caption: 'ID',
        order: {default: false, dir: 'asc', field: 'animals.matricol_number', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.matricol_number
    }),

    Makers.mkColumn('cod_ro', {
        caption: 'Cod Ro',
        order: {default: false, dir: 'asc', field: 'animals.cod_ro', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.animal.cod_ro
    }),

    Makers.mkColumn('birth_date', {
        caption: 'Data nașterii',
        order: {default: false, dir: 'asc', field: 'animals.birth_date', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: (record, v) => {
            if(record.birth_date)
            {
                return v.datetime.setFormat('DD.MM.YYYY', record.animal.birth_date) + ' (' + record.animal.age + ')'
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
            if(record.animal.breed)
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

    Makers.mkColumn('company', {
        caption: 'Firma',
    }, {
        component: 'cell-string',
        render: record => {
            if( ! record.animal.company_id )
            {
                return null
            }
            if(record.animal.company.logo)
            {
                return '<img class="cs-cell-image img-fluid" src="' + record.animal.company.logo + '" />'
            }
            return record.animal.company.name
        }
    }),

    Makers.mkActionsColumn([
        // Makers.actUpdate('la la-pencil'),
        // Makers.actDelete('la la-trash'),
        {
            icon: 'la la-trash',
            caption: 'Șterge taurul din lista fermei',
            click: v => {
                alert('Sterge...');
            }
        },
        {
            icon: 'la la-exchange',
            caption: 'Schimbă starea taurului in cadrul fermei',
            click: v => {
                alert('Schimb stare...');
            }
        }
    ]),

]