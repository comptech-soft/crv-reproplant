<template>
    <div v-if="farm && model">
        <div 
            v-if="downloading"
            class="m-spinner m-spinner--brand text-center" 
            style="width:19.5px; margin:0 auto; display:block; position: absolute; left: calc(50% - 10px)"
            slot="dt-form"
        >
        </div>

        <dt-grid-page
            id="cows"
            :caption="__('Vacile fermei')"
            :model="model"
            icon="/img/icons/cow.png"
            :actions="actions"
            :refresh="refresh"
            @refreshed="refresh=false"
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
                refresh: false,
                model: null,
                downloading: false,
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
                            this.confirmDownload()
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
                            this.confirmDeleteAll()
                        }
                    },    
                ],
            }
        },

        methods: {  

            deleteAll() {
                this.post('farms/animals/delete-all', {
                    farm_id: this.farm.id,
                    type: 'cow',
                    gender: 'female',
                }, data => {
                    this.refresh = true
                })
            },

            download() {
                this.downloading = true
                this.post('farms/animals/download', {
                    farm_id: this.farm.id,
                    type: 'cow',
                    gender: 'female',
                }, data => {
                    location.href = data.url
                    this.downloading = false
                })
            },

            confirmDeleteAll() {
                csApp.Messagebox.confirm(this.__('Confirmare'), this.__('Doriți ștergerea tuturor vacilor?'), () => {
                    this.deleteAll()
                })
            },

            confirmDownload() {
                csApp.Messagebox.confirm(this.__('Confirmare'), this.__('Doriți descărcarea unui fișier excel cu lista vacilor din fermă?'), () => {
                    this.download()
                })
            },
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
            'action-form': require('./Form'),
            'filter-form': require('./Filter'),
        },

        mixins: [
            require('./../../../~Commons/Page/Mixins/data'),
            require('./../../../~Commons/Page/Mixins/computed'),
            require('./../../../~Commons/Page/Mixins/methods'),
            require('./../../../~Commons/Page/Mixins/components')
        ],
    }
</script>