module.exports = {

    computed: {
        statuses() {
            return [
                {
                    id: '', text: this.__('---'),
                },
                {
                    id: 'valid', text: this.__('Valid'),
                },
                {
                    id: 'invalid', text: this.__('Invalid'),
                }
            ]
        },

        ajax_breeds() {
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Animals\\Breeds\\Breed',
                    order_by: {field: 'breeds.breed', dir: 'asc'},
                },
                map: {id: 'id', text: 'breed'}
            }
        },

        ajax_colors() {
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Animals\\Colors\\Color',
                    order_by: {field: 'colors.color', dir: 'asc'},
                },
                map: {id: 'id', text: 'color'}
            }
        },

        ajax_companies() {
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Animals\\Companies\\Company',
                    order_by: {field: 'companies.name', dir: 'asc'},
                },
                map: {id: 'id', text: 'name'}
            }
        },

        selected_father() {
            if(this.father == null)
            {
                return null
            }
            return {id: this.father.id, text: this.father.long_name || this.father.short_name}
        },

        selected_mother() {
            if(this.mother == null)
            {
                return null
            }
            return {id: this.mother.id, text: this.mother.long_name || this.mother.short_name}
        },

    }
}