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
            return Renderers.animalInfo(record, 'father_id', 'father') + '<i style="font-size:11px" class="la la-times"></i>' + Renderers.animalInfo(record, 'mother_id', 'mother')
        }
    }),

    Makers.mkColumn('nvi', {
        caption: 'NVI',
        order: {default: false, dir: 'asc', field: 'animals.nvi', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.nvi ? record.nvi : 0
    }),

    Makers.mkColumn('milk_kg', {
        caption: 'Milk (Kg)',
        order: {default: false, dir: 'asc', field: 'animals.milk_kg', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.milk_kg ? record.milk_kg : 0
    }),

    Makers.mkColumn('fat_percent', {
        caption: 'Fat (%)',
        order: {default: false, dir: 'asc', field: 'animals.fat_percent', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.fat_percent ? parseFloat(record.fat_percent).toFixed(2) : 0.00
    }),

    Makers.mkColumn('protein_percent', {
        caption: 'Protein (%)',
        order: {default: false, dir: 'asc', field: 'animals.protein_percent', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.protein_percent ? parseFloat(record.protein_percent).toFixed(2) : 0.00
    }),

    Makers.mkColumn('inet', {
        caption: 'INET',
        order: {default: false, dir: 'asc', field: 'animals.inet', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.inet ? record.inet : 0
    }),

    Makers.mkColumn('longevity', {
        caption: 'Longevity',
        order: {default: false, dir: 'asc', field: 'animals.longevity', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.longevity ? record.longevity : 0
    }),

    Makers.mkColumn('frame', {
        caption: 'Frame',
        order: {default: false, dir: 'asc', field: 'animals.frame', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.frame ? record.frame : 0
    }),

    Makers.mkColumn('udder', {
        caption: 'Udder',
        order: {default: false, dir: 'asc', field: 'animals.udder', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.udder ? record.udder : 0
    }),

    Makers.mkColumn('feet_legs', {
        caption: 'Feet and Legs',
        order: {default: false, dir: 'asc', field: 'animals.feet_legs', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.feet_legs ? record.feet_legs : 0
    }),

    Makers.mkColumn('total_score', {
        caption: 'Total Score',
        order: {default: false, dir: 'asc', field: 'animals.total_score', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right',
            'font-weight': 'bold',
        },
        render: record => record.total_score ? record.total_score : 0
    }),

    Makers.mkColumn('udder_health', {
        caption: 'Udder Health',
        order: {default: false, dir: 'asc', field: 'animals.udder_health', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.udder_health ? record.udder_health : 0
    }),

    Makers.mkColumn('calving_ease', {
        caption: 'Calving Ease',
        order: {default: false, dir: 'asc', field: 'animals.calving_ease', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.calving_ease ? record.calving_ease : 0
    }),

]