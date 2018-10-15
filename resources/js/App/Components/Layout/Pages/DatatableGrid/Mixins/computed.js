export default {

    computed: {
        form_tab_caption()
        {
            let am = this.am
            if( ! am || ! am.action || am.action == 'insert')
            {
                return 'Adăugare'
            }
            if(am.action == 'update')
            {
                return 'Editare'
            }
            if(am.action == 'delete')
            {
                return 'Ștergere'
            }
            return '???'
        }, 

        filter_by_fields()
        {
            if(this.model && this.model.hasOwnProperty('filter_by_fields'))
            {
                return this.model.filter_by_fields
            }
            return null
        }
    },

    watch: {
        filter_by_fields: {
            handler: function(newFilter, oldFilter)
            {
                if( this.dt )
                {
                    _.each(newFilter, (filter, field) => this.dt.addFilter(field, filter) )
                    this.dt.populate()
                }
            },
            deep: true,
        }
    }

}