<template>
    <div v-if="farm && model">
        <dt-grid-page
            id="cows"
            :caption="__('Taurii fermei')"
            :model="model"
            icon="/img/icons/bull.png"
            :has_form="false"
            :actions="actions"
        >    
        </dt-grid-page>
    </div>
</template>

<script>

    import SiresModel from './../../../../Models/Farms/Sires/Sire'

    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
               model: null,
               actions: [
                    {
                        caption: 'Caută taur în lista generală',
                        icon: 'la la-search-plus',
                        click: () => {
                            alert('Cautare....')
                        }
                    },
                    {
                        caption: 'Adaugă rapid un taur',
                        icon: 'la la-plus-circle',
                        click: () => {
                            alert('Adaugare....')
                        }
                    },
                    {
                        caption: 'Importă din fișier excel',
                        icon: 'la la-upload',
                        click: () => {
                            alert('Upload....')
                        }
                    }
               ]
            }
        },

        methods: {
            
        },

        mounted() {
            this.model = SiresModel
            this.model.addFilterByCriteria('farm_id', {
                value: this.farm.id,
                where: 'farms_animals.farm_id=[value]'
            })
            this.model.addFilterByCriteria('type', {
                value: 'sire',
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