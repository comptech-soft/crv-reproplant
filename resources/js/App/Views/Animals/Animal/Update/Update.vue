<template>
    <div v-if="fm">
        <div class="animal-controls">
            <div class="row">
                <div class="col">
                    <simple-select
                        id="animal_status"
                        :label="__('Starea')"
                        :options="statuses"
                        :disabled="action == 'delete'"
                        v-model="record.animal_status"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
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

            <div class="row">
                <div class="col">
                    <datebox
                        id="birth_date"
                        :label="__('Data nașterii')"
                        :placeholder="__('Data nașterii')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.birth_date"
                        :errors="errors"
                    >
                    </datebox>
                </div>
                <div class="col">
                    <simple-select
                        id="breed_id"
                        :label="__('Rasa')"
                        :ajax="ajax_breeds"
                        :disabled="action == 'delete'"
                        v-model="record.breed_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
                <div class="col">
                    <simple-select
                        id="color_id"
                        :label="__('Culoare')"
                        :ajax="ajax_colors"
                        :disabled="action == 'delete'"
                        v-model="record.color_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
                <div class="col">
                    <simple-select
                        id="company_id"
                        :label="__('Firma')"
                        :ajax="ajax_companies"
                        :disabled="action == 'delete'"
                        v-model="record.company_id"
                        :reload="add_company.reload"
                        :errors="errors"
                    >
                    </simple-select>
                    <div v-if="action != 'delete'">
                        <button 
                            type="button" 
                            class="btn btn-outline-info btn-sm m-btn m-btn--custom"
                            @click="showAddCompany"
                        >
                            {{ __('Adaugă firmă') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <two-select
                        id="father_id"
                        :label="__('Sire (Tatăl)')"
                        :selectable="animal_selectable(__('Selectați tatăl'), 'sire', 'male')"
                        :selected="selected_father"
                        :disabled="action == 'delete'"
                        :errors="errors"
                        v-model="record.father_id"
                        @selected="onFatherSelected"
                    >
                    </two-select>
                    <div v-if="action != 'delete'">
                        <span class="m--font-info" v-html="__('Selectarea tatălui se face din lista generală. Dacă nu gasiţi tatăl în lista de căutare, folosiţi opţiunea ')">
                        </span>
                        <button 
                            type="button" 
                            class="btn btn-outline-info btn-sm m-btn m-btn--custom"
                            @click="showQuickAdd('sire', 'male')"
                        >
                            {{ __('Adaugă rapid') }}
                        </button>
                    </div>
                </div>
                <div class="col">
                    <two-select
                        id="mother_id"
                        :label="__('Dam (Mama)')"
                        :selectable="animal_selectable(__('Selectați mama'), 'cow', 'female')"
                        :selected="selected_mother"
                        :disabled="action == 'delete'"
                        :errors="errors"
                        v-model="record.mother_id"
                        @selected="onMotherSelected"
                    >
                    </two-select>
                    <div v-if="action != 'delete'">
                        <span class="m--font-info" v-html="__('Selectarea mamei se face din lista generală. Dacă nu gasiţi mama în lista de căutare, folosiţi opţiunea')">
                        </span>
                        <button 
                            type="button" 
                            class="btn btn-outline-info btn-sm m-btn m-btn--custom"
                            @click="showQuickAdd('cow', 'female')"
                        >
                            {{ __('Adaugă rapid') }}
                        </button>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="animal-footer">
            <button 
                v-if="(action == 'delete')"
                type="button" 
                class="btn btn-default"
                @click="action = 'update'"
            >
                <span>
                    <i class="la la-pencil"></i>
                    <span>{{ __('Editează') }}</span>
                </span> 
            </button>

            <button 
                v-if="action == 'update'"
                type="button" 
                class="btn btn-primary"
                @click="saveRecord"
            >
                <span>
                    <i class="la la-save"></i>
                    <span>{{ __('Salvează') }}</span>
                    <i v-if="fm.submiting" class="fa fa-spinner fa-spin"></i>
                </span>
            </button>

            <button 
                type="button" 
                class="btn btn-secondary"
                @click="action = 'delete'"
            >
                <span>
                    <i class="fa fa-times"></i>
                    <span>{{ __('Renunță') }}</span>
                </span>
            </button>
        </div>

        <!-- adaugarea rapida a unui animal -->
        <quick-add-form
            :visible="quick_add_form.visible"
            :type="quick_add_form.type"
            :gender="quick_add_form.gender"
            @close="hideQuickAddForm"
        >
        </quick-add-form>
        <!-- adaugarea rapida a unei copanii -->
        <quick-add-company
            :visible="add_company.visible"
            @close="hideCompanyForm"
        >
        </quick-add-company>

    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'
    import AnimalModel from './../../../../Models/Animals/Animals/Animal'

    export default {
        props: {
            old: {required: true}
        },

        data() {
            return {
                action: 'delete',
                fm: null,
                model: null,
            }
        },

        computed: {
            errors() {
                return this.fm ? this.fm.errors : null
            }
        },

        methods: {
            saveRecord() {
                this.fm.onClickSubmit(this.model.rules[this.action].rules, data => {
                    this.notySuccess(data.result.message)
                    this.action = 'delete'
                })
            }
        },
        
        mounted() {
            this.model = AnimalModel
            this.fm = new AppCore.ActionFormManager('update-animal-form', this)
            this.fm.getData = () => {
                return {
                    model: this.model.model,
                    action: this.action,
                    record: this.record,
                    entity: this.model.entity,
                    genus: this.model.genus
                }
            }
            /**
             * Initializez "record" cu valorile din "old"
             */
            _.each(this.record, (value, field) => {                
                if( this.old.hasOwnProperty(field) )
                {
                    this.record[field] = this.old[field]
                }
            })
            if(this.old.father_id)
            {
                this.father = this.old.father
            }
            if(this.old.mother_id)
            {
                this.mother = this.old.mother
            }
            /**
             * Probleme cu data calendaristica
             */
            if(this.old.birth_date)
            {
                this.record.birth_date = this.datetime.setFormat('DD.MM.YYYY', this.record.birth_date)
            }
        },

        components: {
            'quick-add-form': require('./../../Animals/QuickAdd'),
            'quick-add-company': require('./../../Companies/QuickAddCompany')
        },

        mixins: [
            require('./../../~Mixins/Form/Record'),
            require('./../../~Mixins/Form/Computed'),
            require('./../../~Mixins/Form/Methods'),
            require('./../../~Mixins/Form/Watch')
        ]
    }
</script>

<style lang="scss" scoped>
    .animal-footer {
        margin-top: 10px;
        border-top: 1px solid #cccccc;
        padding: 6px 0px;
    }
</style>
