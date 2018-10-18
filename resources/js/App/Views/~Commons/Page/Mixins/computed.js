module.exports = {

    computed:
    {
        filter_by_fields()
        {
            if(this.model && this.model.hasOwnProperty('filter_by_fields'))
            {
                return this.model.filter_by_fields
            }
            return null
        }
    },
    
}