import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('animal'),
    widths = require('./Traits/Widths'),
    columns = require('./Traits/Columns'),
    toolbar = require('./Traits/Toolbar')

model
    .setModel('\\App\\Models\\Animals\\Animals\\Animal')
    .setEntity('animalului')
    .setGenus('M')
    .setWidths(widths)
    
    /**
     * dupa care filduri se poate face "quick search"
     */
    .setSearchByFields([
        'animals.interbull_code', 
        'animals.short_name',
        'animals.long_name',
        'animals.matricol_number',
        'animals.naab',
        'animals.cod_ro',
        'animals.breed_composition',
        'animals.breed',
    ])

    .setToolbar(toolbar)
    .setColumns(columns)

    .setActionsField('short_name')
    .setPerPage(50)

    .addFilterByCriteria('animal_status', {
        value: null,
        where: 'animals.animal_status=[value]'
    })
    .addFilterByCriteria('company_id', {
        value: null,
        where: 'animals.company_id=[value]'
    })
    .addFilterByCriteria('breed_id', {
        value: null,
        where: 'animals.breed_id=[value]'
    })

    // .addRule('insert', 'farm', 'required')
    // .addRule('insert', 'status', 'required')
    // .addRule('insert', 'email', 'email')

    // .addRule('update', 'farm', 'required')
    // .addRule('update', 'status', 'required')
    // .addRule('update', 'email', 'email')
    
    // .addField('id')
    // .addField('farm', '')
    // .addField('cod_exploatatie', '')
    // .addField('cif', '')
    // .addField('status', '')
    // .addField('email', '')
    // .addField('address', '')
    // .addField('locality_id')
    // .addField('country_id')
    // .addField('region_id')
    // .addField('judet_id')

export default model