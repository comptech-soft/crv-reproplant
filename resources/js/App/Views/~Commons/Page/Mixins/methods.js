module.exports = {

    methods: {
        onFilter(filter)
        {
            _.each(filter, (value, field) => {
                if(this.model.filter_by_fields.hasOwnProperty(field))
                {
                    this.model.filter_by_fields[field].value = value
                }
            })
        }
    },
    
}