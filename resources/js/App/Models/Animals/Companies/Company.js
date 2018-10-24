import AppCore from 'comptechsoft-app-starter'

const 
    model = new AppCore.Model('company')
    // widths = require('./Traits/Widths'),
    // columns = require('./Traits/Columns'),
    // toolbar = require('./Traits/Toolbar')

model
    .setModel('\\App\\Models\\Animals\\Companies\\Company')
    .setEntity('firmei')
    .setGenus('F')
    // .setWidths(widths)
    
    /**
     * dupa care filduri se poate face "quick search"
     */
    // .setSearchByFields([
    //     'animals.interbull_code', 
    //     'animals.short_name',
    //     'animals.long_name',
    //     'animals.matricol_number',
    //     'animals.naab',
    //     'animals.cod_ro',
    //     'animals.breed_composition',
    //     'animals.breed',
    // ])

    // .setToolbar(toolbar)
    // .setColumns(columns)

    // .setActionsField('short_name')
    // .setPerPage(50)

    // .addFilterByCriteria('animal_status', {
    //     value: null,
    //     where: 'animals.animal_status=[value]'
    // })
    // .addFilterByCriteria('company_id', {
    //     value: null,
    //     where: 'animals.company_id=[value]'
    // })
    // .addFilterByCriteria('breed_id', {
    //     value: null,
    //     where: 'animals.breed_id=[value]'
    // })

    .addRule('insert', 'name', 'required')
    // .addRule('insert', 'codes', 'required')
    // .addRule('insert', 'animal_status', 'required')

    .addRule('update', 'name', 'required')
    // .addRule('update', 'codes', 'required')
    // .addRule('update', 'animal_status', 'required')
    
    .addField('id')
    .addField('name', '')
    .addField('logo', '')
    .addField('width')
    .addField('height')
    // .addField('naab', '')
    // .addField('cod_ro', '')
    // .addField('birth_date')
    // .addField('breed_id')
    // .addField('color_id')
    // .addField('company_id')
    // .addField('father_id')
    // .addField('mother_id')

export default model