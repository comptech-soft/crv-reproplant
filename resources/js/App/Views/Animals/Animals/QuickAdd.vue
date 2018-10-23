<template>
    <modal-box 
        :visible="visible"
        id="quick-add-sire"
        :caption="__('Adăugare rapidă')"
        @close="$emit('close')"
    >
        <template slot="modal-body">
            <div class="m-alert m-alert--outline alert alert-info" role="alert">
                <strong>{{ __('Atenție') }}!</strong> 
                <div>
                    1. {{ __('Trebuie să completaţi cel puţin unul dintre nume (Nume sau Nume lung) şi cel puţin unul dintre coduri (Cod interbull, Număr matricol, NAAB, Cod RO)') }}
                </div>
                <div>
                    2. {{ __('Taurul va fi adăugat în lista de tauri generală cu starea INVALID.') }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <textbox
                        id="long_name"
                        field="names"
                        :label="__('Nume')"
                        :placeholder="__('Nume')"
                        maxlength="128"
                        :disabled="action == 'delete'"
                        v-model="record.long_name"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col">
                    <textbox
                        id="short_name"
                        field="names"
                        :label="__('Nume scurt')"
                        :placeholder="__('Nume scurt')"
                        maxlength="128"
                        :disabled="action == 'delete'"
                        v-model="record.short_name"
                        :errors="errors"
                    >
                    </textbox>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <textbox
                        id="interbull_code"
                        field="codes"
                        :label="__('Interbull code')"
                        :placeholder="__('Interbull code')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.interbull_code"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col">
                    <textbox
                        id="matricol_number"
                        field="codes"
                        :label="__('Număr matricol')"
                        :placeholder="__('Număr matricol')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.matricol_number"
                        :errors="errors"
                    >
                    </textbox>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <textbox
                        id="naab"
                        field="codes"
                        :label="__('NAAB')"
                        :placeholder="__('NAAB')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.naab"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col">
                    <textbox
                        id="cod_ro"
                        field="codes"
                        :label="__('Cod RO')"
                        :placeholder="__('Cod RO')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.cod_ro"
                        :errors="errors"
                    >
                    </textbox>
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
    import model from './../../../Models/Animals/Animals/Animal'

    export default{
        props: {
            visible: {default: false},
            type: {required: true},
            gender: {required: true},
        },

        data()
        {
            return {
                
                action: 'insert',
                am: null,
                model: null,
                fm: null,
                record: {
                    id: null,
                    type: '',
                    gender: '',
                    animal_status: 'invalid',
                    short_name: '',
                    long_name: '',
                    interbull_code: '',
                    matricol_number: '',
                    naab: '',
                    cod_ro: '',

                    birth_date: null,
                    breed_id: null,
                    color_id: null,
                    company_id: null,
                    father_id: null,
                    mother_id: null,

                    names: '',
                    codes: '',
                },
            }
        },

        methods: {
            onClickAdd()
            {
                this.fm.onClickSubmit(this.model.rules[this.am.action].rules)
            },

            resetRecord()
            {
                this.record.type = ''
                this.record.gender = ''
                this.record.short_name = ''
                this.record.long_name = ''
                this.record.interbull_code = ''
                this.record.matricol_number = ''
                this.record.naab = ''
                this.record.cod_ro = ''
                this.$emit('close')
            }
        },

        watch: {
            visible: function(newVisible, oldVisible)
            {
                if(newVisible)
                {
                    this.record.type = this.type
                    this.record.gender = this.gender
                }
                else
                {
                    this.record.type = ''
                    this.record.gender = ''
                }
            }
        },

        computed: {
            errors()
            {
                return this.fm ? this.fm.errors : null
            }
        },

        mounted(){
            this.model = model
            this.am = new AppCore.ActionsManager('action-quick-add-sire', this.model, this)
            this.am.setAction(this.action)
            this.fm = new AppCore.ActionFormManager('quick-animal-form', this)
        },  

        mixins: [
            require('./~mixins/watch')
        ]
    }
</script>