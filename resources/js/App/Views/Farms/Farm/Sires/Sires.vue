<template>
    <div v-if="farm && model">

        <import-animals
            v-if="import_form.visible"
            @close="import_form.visible = false"
        >
        </import-animals>

        <dt-grid-page
            v-if="! import_form.visible"
            id="sires"
            :caption="__('Taurii fermei')"
            :model="model"
            icon="/img/icons/bull.png"
            :has_form="false"
            :actions="actions"
            :refresh="refresh"
            @refreshed="refresh=false"
        >    
        </dt-grid-page>

        <!-- adaugarea rapida a unui animal -->
        <quick-add-form
            :visible="quick_add_form.visible"
            :type="quick_add_form.type"
            :gender="quick_add_form.gender"
            @close="hideQuickAddForm"
        >
        </quick-add-form>

        <!-- -->
        <search-form
            :visible="search_form.visible"
            :farm="farm"
            @close="hideSearchForm"
        >
        </search-form>
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
                refresh: false,
                actions: [
                    {
                        caption: 'Caută taur în lista generală',
                        icon: 'la la-search-plus',
                        click: () => {
                            this.showSearch()
                        }
                    },
                    {
                        caption: 'Adaugă rapid un taur',
                        icon: 'la la-plus-circle',
                        click: () => {
                            this.showQuickAdd()
                        }
                    },
                    {
                        caption: 'Importă din fișier excel',
                        icon: 'la la-upload',
                        click: () => {
                            this.import_form.visible = true
                        }
                    }
                ],
                quick_add_form: {
                    visible: false,
                    type: 'sire',
                    gender: 'male',
                },
                search_form: {
                    visible: false,
                },
                import_form: {
                    visible: false,
                }
            }
        },

        methods: {
            showQuickAdd() {
                this.quick_add_form.visible = true
            },

            showSearch() {
                this.search_form.visible = true
            },

            hideQuickAddForm(animal = null) {
                if(animal)
                {
                    this.post('farms/attach-animal', {
                        farm_id: this.farm.id,
                        animal_id: animal.id,
                        status_in_farm: 'inactiv',
                    }, data => {
                        this.refresh = true
                        this.notySuccess(data.result.message)
                        this.quick_add_form.visible = false
                    })
                }
                else 
                {
                    this.quick_add_form.visible = false
                }
            },

            hideSearchForm(animal) {
                if(animal)
                {
                    this.refresh = true
                }
                this.search_form.visible = false
            }
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

        components: {
            'quick-add-form': require('./../../../Animals/Animals/QuickAdd'),
            'search-form': require('./SearchBull'),
            'import-animals': require('./Import'),
        },

        mixins: [
            require('./../../../~Commons/Page/Mixins/data'),
            require('./../../../~Commons/Page/Mixins/computed'),
            require('./../../../~Commons/Page/Mixins/methods'),
            require('./../../../~Commons/Page/Mixins/components')
        ],
    }
</script>