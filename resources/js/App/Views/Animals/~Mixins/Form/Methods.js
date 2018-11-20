module.exports = {

    methods: {
        animal_selectable(caption, type, gender) {
            return {
                placeholder: caption,
                model: '\\App\\Models\\Animals\\Animals\\Animal',
                search_by: ['animals.long_name', 'animals.short_name', 'animals.interbull_code'],
                order_by: 'animals.long_name',
                filter_by: [
                    "animals.type = '" + type + "'",
                    "animals.gender = '" + gender + "'" 
                ],
                processResults: data => {
                    return {
                        results: _.map(data.results, record => {
                            record.text = record.long_name || record.short_name
                            return record
                        })
                    };
                }
            }
        },

        onFatherSelected(father) {
            this.father = father
        },

        onMotherSelected(mother) {
            this.mother = mother
        },

        showQuickAdd(type, gender) {
            this.quick_add_form.visible = true
            this.quick_add_form.type = type
            this.quick_add_form.gender = gender
        },

        hideQuickAddForm(animal = null) {
            this.quick_add_form.visible = false
            if(animal)
            {
                if( (animal.type == 'sire') && (animal.gender == 'male') )
                {
                    this.father = animal
                }
                if( (animal.type == 'cow') && (animal.gender == 'female') )
                {
                    this.mother = animal
                }
            }
        },

        showAddCompany() {
            this.add_company.visible = true
        },

        hideCompanyForm(company = null) {
            this.add_company.visible = false
            this.add_company.reload++;
            if(company)
            {
                this.record.company_id = company.id
            }
        },
    }
}