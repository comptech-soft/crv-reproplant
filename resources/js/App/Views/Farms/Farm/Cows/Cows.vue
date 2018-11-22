<template>
    <div v-if="farm && model">

        <dt-grid-page
            id="cows"
            :caption="__('Vacile fermei')"
            :model="model"
            icon="/img/icons/cow.png"
        >    
        </dt-grid-page>
    </div>
</template>

<script>

    import CowsModel from './../../../../Models/Farms/Cows/Cow'

    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
               model: null,
            }
        },

        methods: {
            
        },

        mounted() {
            this.model = CowsModel
            this.model.addFilterByCriteria('farm_id', {
                value: this.farm.id,
                where: 'farms_animals.farm_id=[value]'
            })
            this.model.addFilterByCriteria('type', {
                value: 'cow',
                where: 'animals.type=[value]'
            })
        },

        mixins: [
            require('./../../../~Commons/Page/Mixins/data'),
            require('./../../../~Commons/Page/Mixins/computed'),
            require('./../../../~Commons/Page/Mixins/methods'),
            require('./../../../~Commons/Page/Mixins/components')
        ],
    }
</script>