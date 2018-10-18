import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('farm'),
    widths = require('./Traits/Widths'),
    columns = require('./Traits/Columns'),
    toolbar = require('./Traits/Toolbar')

model
    .setModel('\\App\\Models\\Farms\\Farms\\Farm')
    .setEntity('fermei')
    .setGenus('F')
    .setWidths(widths)
    .setSearchByFields(['farms.farm'])

    .setToolbar(toolbar)
    .setColumns(columns)

    .setActionsField('farm')
    .setPerPage(20)

    .addFilterByCriteria('status', {
        value: null,
        where: 'farms.status=[value]'
    })

    .addRule('insert', 'farm', 'required')
    .addRule('insert', 'status', 'required')
    .addRule('insert', 'email', 'email')

    .addRule('update', 'farm', 'required')
    .addRule('update', 'status', 'required')
    .addRule('update', 'email', 'email')
    
    .addField('id')
    .addField('farm', '')
    .addField('cod_exploatatie', '')
    .addField('cif', '')
    .addField('status', '')
    .addField('email', '')
    .addField('address', '')
    .addField('locality_id')
    .addField('country_id')
    .addField('region_id')
    .addField('judet_id')

export default model