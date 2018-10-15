import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('company'),
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

    .addFilterByCriteria('status', {
        value: null,
        where: 'farms.status=[value]'
    })

    // .addRule('insert', 'name', 'required')
    // .addRule('insert', 'code', 'required')

    // .addField('id')
    // .addField('name', '')
    // .addField('code', '')
    // .addField('icon', '')
    
export default model
