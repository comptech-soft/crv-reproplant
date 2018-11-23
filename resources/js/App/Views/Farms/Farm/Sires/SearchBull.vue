<template>
    <modal-box 
        :visible="visible"
        id="quick-add-sire"
        :caption="__('Căutare taur în lista generală')"
        @close="$emit('close')"
    >
        <template slot="modal-body">
            <div class="m-alert m-alert--outline alert alert-info" role="alert">
                <strong>{{ __('Atenție') }}!</strong> 
                <div>
                    1. {{ __('Această opțiune permite adăugarea unui taur din lista generală de tauri în lista de tauri a fermei.') }}
                </div>
                <div>
                    2. {{ __('Tastați numele taurului sau unul dintre codurile de indentificare ale acestuia apoi selectați taurul din lista de rezultate.') }}
                </div>
                <div>
                    3. {{ __('Selectați daca taurul selectat este ACTIV sau INACTIV apoi efectuați click pe butonul Adaugă. Taurul va apărea in lista de tauri a fermei.') }}
                </div>
            </div>

            <div class="row">
                <div class="col col-sm-8">
                    <two-select
                        id="searched_animal_id"
                        field="animal_id"
                        :label="__('Taur')"
                        :selectable="animal_selectable(__('Selectați taurul'), 'sire', 'male')"
                        :selected="selected_animal"
                        :disabled="false"
                        :errors="errors"
                        v-model="record.animal_id"
                        @selected="onAnimalSelected"
                    >
                    </two-select>
                </div>

                <div class="col col-sm-4">
                    <simple-select
                        id="status_in_farm"
                        :label="__('Starea')"
                        :options="statuses"
                        :disabled="false"
                        v-model="record.status_in_farm"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
            </div>
        </template>

        <template slot="modal-footer-buttons">
            <button 
                type="button" 
                class="btn btn-primary"
                @click="onClickAdd"
            >
                {{ __('Adaugă') }}
            </button>
        </template>
    </modal-box>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'
    import SiresModel from './../../../../Models/Farms/Sires/Sire'

    export default{
        props: {
            visible: {default: false},
            farm: {required: true},
        },

        data() {
            return {
                model: null,
                fm: null,
                am: null,
                created: null,
                action: 'insert',
                record: {
                    animal_id: null,
                    status_in_farm: null,
                    farm_id: null,
                },
                animal: null,
            }
        },

        methods: {
            animal_selectable(caption, type, gender) {
                return {
                    placeholder: caption,
                    model: '\\App\\Models\\Animals\\Animals\\Animal',
                    search_by: ['animals.long_name', 'animals.short_name', 'animals.interbull_code'],
                    order_by: 'animals.long_name',
                    filter_by: [
                        "animals.type = '" + type + "'",
                        "animals.gender = '" + gender + "'" 
                    ],
                    processResults: data => {
                        return {
                            results: _.map(data.results, record => {
                                record.text = record.long_name || record.short_name
                                return record
                            })
                        };
                    }
                }
            },

            onAnimalSelected(animal) {
                this.animal = animal
            },
            
            onClickAdd() {
                this.fm.onClickSubmit(this.model.rules['insert'].rules, data => {
                    this.created = data.result.payload.result
                    this.resetRecord()
                    this.$emit('close', this.created)
                })
            },

            resetRecord() {
                this.fm.errors = null
                this.record.animal_id = null
                this.animal = null
                this.record.status_in_farm = null
            }
        },

        watch: {
            visible: function(newVisible, oldVisible)
            {
                this.resetRecord()
            }
        },

        computed: {
            errors() {
                return this.fm ? this.fm.errors : null
            },

            statuses() {
                return [
                    {
                        id: '', text: this.__('---'),
                    },
                    {
                        id: 'activ', text: this.__('Activ'),
                    },
                    {
                        id: 'inactiv', text: this.__('Inactiv'),
                    }
                ]
            },

            selected_animal() {
                if(this.animal == null)
                {
                    return null
                }
                return {id: this.animal.id, text: this.animal.long_name || this.animal.short_name}
            },
        },

        mounted() {
            this.record.farm_id = this.farm.id
            this.model = SiresModel
            this.am = new AppCore.ActionsManager('action-quick-add-sire', this.model, this)
            this.am.setAction(this.action)
            this.fm = new AppCore.ActionFormManager('search-form', this)
        },  

    }
</script>