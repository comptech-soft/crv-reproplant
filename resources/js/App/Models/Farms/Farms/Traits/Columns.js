import AppCore from 'comptechsoft-app-starter'

const Makers = AppCore.GridMakers

module.exports = [

    Makers.mkRecnoColumn(),

    Makers.mkColumn('external_id', {
        caption: 'ID Extern',
        order: {default: false, dir: 'asc', field: 'farms.external_id', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'right'
        },
        render: record => record.external_id
    }),
   
    Makers.mkColumn('status', {
        caption: 'Stare',
        order: {default: false, dir: 'asc', field: 'farms.status', type: 'alpha'}
    }, {
        component: 'cell-string',
        cell_style: {
            'text-align': 'center'
        },
        render: record => {
            return '<span class="m-badge m-badge--' + (record.status == 'activ' ? 'success' : 'danger') + '">' + (record.status == 'activ' ? 'A' : 'I') + '</span>'
        }
    }),

    Makers.mkColumn('farm', {
        caption: 'Nume fermă',
        order: {default: true, dir: 'asc', field: 'farms.farm', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.farm,
        cell_style: (column, record) => {
            return {
                cursor: 'pointer',
                color: record.status == 'inactiv' ? '#f4516c' : '#5867dd',
            }
        },
        actions: (v, record) => v.$router.push({name: 'farm', params: {id: record.id}})
    }),

    Makers.mkColumn('address', {
        caption: 'Adresa',
        order: {default: false, dir: 'asc', field: 'farms.address', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => {
            let r = [record.address]
            if( record.locality_id && record.locality )
            {
                r.push(record.locality.name)
                if(record.locality.judet_id && record.locality.judet)
                {
                    r.push(record.locality.judet.name)
                }
            }
            return r.join(', ')
        }
    }),

    Makers.mkColumn('cod_exploatatie', {
        caption: 'Cod exploatație',
        order: {default: false, dir: 'asc', field: 'farms.cod_exploatatie', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.cod_exploatatie
    }),

    Makers.mkColumn('cif', {
        caption: 'Cod fiscal',
        order: {default: false, dir: 'asc', field: 'farms.cif', type: 'alpha'}
    }, {
        component: 'cell-string',
        render: record => record.cif
    }),

    Makers.mkActionsColumn([
        Makers.actUpdate(true, 'la la-pencil'),
        Makers.actDelete(true, 'la la-trash'),
        {
            icon: 'la la-folder-o',
            caption: 'Deschide',
            click: v => v.$router.push({
                name: 'farm', 
                params: {
                    id: v.record.id
                }
            })
        }
    ]),

]