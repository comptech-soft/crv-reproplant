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
        'farms_animals.short_number',
        'farms_animals.internal_number',
    ])
    .setColumns(columns)
    .setPerPage(50)

    .addRule('insert', 'animal_id', 'required')
    .addRule('insert', 'status_in_farm', 'required')


export default model