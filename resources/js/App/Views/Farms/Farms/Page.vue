<template>
    <dt-grid-page
        id="farms"
        :caption="__('Lista fermelor')"
        :model="model"
    >
        <!-- criteriile de filtrare -->
        <div slot="dt-filter">       
            <filter-form
                @do-filter="onFilter"
            >
            </filter-form>
        </div>
        <!-- controalele formularului -->
        <div slot="dt-form">
            <action-form>
            </action-form>
        </div>

    </dt-grid-page>
</template>

<script>

    import model from './../../../Models/Farms/Farms/Farm'

    export default{

        data()
        {
            return {
                model: null
            }
        },

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

        mounted(){
            this.model = model
        },

        components: {
            'dt-grid-page':  require('./../../../Components/Layout/Pages/DatatableGrid/Page'),
            'filter-form': require('./Filter'),
            'action-form': require('./Form')
        },

        name: 'farms-page'
    }
</script>