<template>
    <div v-if="farm && model">
        <dt-grid-page
            id="cows"
            :caption="__('Vacile fermei')"
            :model="model"
            icon="/img/icons/cow.png"
            :actions="actions"
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
               actions: [
                    {
                        caption: 'Adaugă o vacă',
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
                    },
                    {
                        caption: 'Download',
                        icon: 'la la-download',
                        click: () => {
                            alert('Download....')
                        }
                    },
                    {
                        caption: 'Corectează numerele matricole',
                        icon: 'la la-wrench',
                        click: () => {
                            alert('Corecteaza....')
                        }
                    },
                    {
                        caption: 'Șterge',
                        icon: 'la la-trash',
                        click: () => {
                            alert('Sterge...')
                        }
                    },
                    
               ]
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