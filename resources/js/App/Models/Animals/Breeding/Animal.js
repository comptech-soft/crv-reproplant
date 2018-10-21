import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('animal'),
    widths = require('./Traits/Widths'),
    columns = require('./Traits/Columns')

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

export default model