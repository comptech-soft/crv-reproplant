<template>
    <div v-if="farm && model">
        <dt-grid-page
            id="cows"
            :caption="__('Vacile fermei')"
            :model="model"
            icon="/img/icons/cow.png"
            :actions="actions"
        >    

            <!-- controalele formularului -->
            <div slot="dt-form">
                <action-form 
                    :farm="farm"
                >
                </action-form>
            </div>
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
                        caption: 'Șterge toate vacile',
                        icon: 'la la-trash',
                        click: () => {
                            alert('Sterge...')
                        }
                    },    
                ],

                // add_cow_form: {
                //     visible: false,
                //     type: 'cow',
                //     gender: 'female',
                // },
            }
        },

        methods: {  

            // showForm() {
            //     this.add_cow_form.visible = true
            // },

            // hideForm() {
            //     this.add_cow_form.visible = false
            // }
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

        components: {
            // 'add-cow-form': require('./Form.vue'),
            'action-form': require('./Form')
        },

        mixins: [
            require('./../../../~Commons/Page/Mixins/data'),
            require('./../../../~Commons/Page/Mixins/computed'),
            require('./../../../~Commons/Page/Mixins/methods'),
            require('./../../../~Commons/Page/Mixins/components')
        ],
    }
</script>