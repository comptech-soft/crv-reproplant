import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('animal'),
    widths = require('./Traits/Widths'),
    columns = require('./Traits/Columns'),
    toolbar = require('./Traits/Toolbar')

model
    .setModel('\\App\\Models\\Farms\\Animals\\Animal')
    .setEntity('animalului')
    .setGenus('M')
    .setWidths(widths)
    
    .setSearchByFields([
        'animals.matricol_number',
    ])

    .setToolbar(toolbar)
    .setColumns(columns)

    .setActionsField('matricol_number')

    .setPerPage(50)
    .setCurrentPage(1)

    .addFilterByCriteria('status_in_farm', {
        value: null,
        where: 'farms_animals.status_in_farm=[value]'
    })
    .addFilterByCriteria('animal_status', {
        value: null,
        where: 'animals.animal_status=[value]'
    })


    .addRule('insert', 'matricol_number', 'required')
    .addRule('insert', 'status_in_farm', 'required')

    .addRule('update', 'matricol_number', 'required')
    .addRule('update', 'status_in_farm', 'required')
    
    .addField('id')
    .addField('matricol_number', '')
    .addField('short_number', '')
    .addField('internal_number', '')
    .addField('birth_date')
    .addField('last_calving_date')
    .addField('color_id')
    .addField('breed_id')
    .addField('father_id')
    .addField('mother_id')
    .addField('parity')

export default model