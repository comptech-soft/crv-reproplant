<template>
    <dt-grid-page
        id="farms"
        :caption="__('Lista fermelor')"
        icon="/img/icons/farm.png"
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

    import FarmModel from './../../../Models/Farms/Farms/Farm'

    export default{

        mounted(){
            this.model = FarmModel
        },

        components: {
            'filter-form': require('./Filter'),
            'action-form': require('./Form')
        },

        mixins: [
            require('./../../~Commons/Page/Mixins/data'),
            require('./../../~Commons/Page/Mixins/computed'),
            require('./../../~Commons/Page/Mixins/methods'),
            require('./../../~Commons/Page/Mixins/components')
        ],

        name: 'farms-page'
    }
</script>