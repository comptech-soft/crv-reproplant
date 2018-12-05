<template>
    <modal-box 
        :visible="visible"
        id="quick-add-sire"
        :caption="__('Adăugare rapidă a :type:', {type: type == 'sire' ? 'unui taur' : 'unei vaci'})"
        @close="$emit('close')"
    >
        <template slot="modal-body">
            <div v-if="type=='sire'">
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
            </div>

            <div v-if="type=='cow'">
                <div class="row">
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
                    <div class="col">
                        <textbox
                            id="short_number"
                            field="short_number"
                            :label="__('Număr scurt')"
                            :placeholder="__('Număr scurt')"
                            maxlength="8"
                            :disabled="action == 'delete'"
                            v-model="record.short_number"
                            :errors="errors"
                        >
                        </textbox>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <textbox
                            id="internal_number"
                            field="internal_number"
                            :label="__('Număr intern')"
                            :placeholder="__('Număr intern')"
                            maxlength="8"
                            :disabled="action == 'delete'"
                            v-model="record.internal_number"
                            :errors="errors"
                        >
                        </textbox>
                    </div>

                    <div class="col">
                        <simple-select
                            id="status_in_farm"
                            :label="__('Starea în fermă')"
                            :options="farm_statuses"
                            :disabled="action == 'delete'"
                            v-model="record.status_in_farm"
                            :errors="errors"
                        >
                        </simple-select>
                    </div>
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
            farm_id: {default: null},
        },

        data() {
            return {
                action: 'insert',
                am: null,
                model: null,
                fm: null,
                created: null,
            }
        },

        methods: {
            onClickAdd()
            {
                this.fm.onClickSubmit(this.rules, data => {
                    this.created = data.result.payload.result
                    this.resetRecord()
                })
            },

            resetRecord()
            {
                this.$emit('close', this.created)
                this.record.type = ''
                this.record.gender = ''
                this.record.short_name = ''
                this.record.long_name = ''
                this.record.interbull_code = ''
                this.record.matricol_number = ''
                this.record.naab = ''
                this.record.cod_ro = ''
                this.created = null
            },

            toShortNumber(matricolNumber) {
                let l = matricolNumber.length
                switch(matricolNumber.substr(0, 2).toUpperCase())
                {
                    case 'NL': 
                        if( l >= 8)
                        {
                            return matricolNumber.substr(l - 5, 4)
                        }
                        return ''
                    default: 
                        if( l >= 7)
                        {
                            return matricolNumber.substr(l - 4, 4)
                        }
                        return ''
                }
            },
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
            },

            'record.matricol_number': {
                handler: function(newMatricolNumber, oldMatricolNumber) {
                    if( (this.type == 'cow') && (newMatricolNumber != undefined ))
                    {
                        if(newMatricolNumber != oldMatricolNumber)
                        {
                            let l = newMatricolNumber.length
                            if( l <= 2)
                            {
                                if(newMatricolNumber.substr(0, l) != newMatricolNumber.substr(0, l).toUpperCase())
                                {
                                    this.record.matricol_number = newMatricolNumber.substr(0, l).toUpperCase()
                                }
                            }
                            else
                            {
                                if(newMatricolNumber[2] != ' ')
                                {
                                    this.record.matricol_number = newMatricolNumber.substr(0, 2).toUpperCase() + ' ' + newMatricolNumber.substr(2).toUpperCase()
                                }
                            }
                        }
                        this.record.short_number = this.toShortNumber(newMatricolNumber)
                    }
                },
                deep: true,
            }
        },

        computed: {
            errors() {
                return this.fm ? this.fm.errors : null
            },

            rules() {
                if( this.type == 'sire')
                {
                    return this.model.rules[this.am.action].rules
                }
                return {
                    matricol_number: 'required',
                    animal_status: 'required',
                    internal_number: 'required',
                    status_in_farm: 'required',
                    short_number: 'required',
                }
            },

            farm_statuses() {
                return [
                    {
                        id: '', text: this.__('---'),
                    },
                    {
                        id: 'activ', text: this.__('Activă'),
                    },
                    {
                        id: 'inactiv', text: this.__('Inactivă'),
                    }
                ]
            },
        },

        mounted() {
            this.model = model
            this.am = new AppCore.ActionsManager('action-quick-add-sire', this.model, this)
            this.am.setAction(this.action)
            this.fm = new AppCore.ActionFormManager('quick-animal-form', this),
            this.record.animal_status = 'invalid'
            this.record.type = ''
            this.record.gender = ''
            this.record.farm_id = this.farm_id
        },  

        mixins: [
            require('./../~Mixins/Form/Watch'),
            require('./../~Mixins/Form/Record'),
        ]
    }
</script>