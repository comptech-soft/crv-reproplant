<template>
    <form-box>
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
    </form-box>
</template>

<script>
    export default {    
        
        data()
        {
            return {
                errors: null,
                action: null,
                record: {
                    id: null,
                    type: 'sire',
                    gender: 'male',
                    animal_status: null,
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
                father: null,
                mother: null,
                quick_add_form: {
                    visible: false,
                    type: null,
                    gender: null,
                },
                add_company: {
                    visible: false,
                    reload: 0,
                }
            }
        },

        methods: {

            showQuickAdd(type, gender)
            {
                this.quick_add_form.visible = true
                this.quick_add_form.type = type
                this.quick_add_form.gender = gender
            },

            hideQuickAddForm(animal = null)
            {
                this.quick_add_form.visible = false
                if(animal)
                {
                    if( (animal.type == 'sire') && (animal.gender == 'male') )
                    {
                        this.father = animal
                    }
                    if( (animal.type == 'cow') && (animal.gender == 'female') )
                    {
                        this.mother = animal
                    }
                }
            },

            showAddCompany()
            {
                this.add_company.visible = true
            },

            hideCompanyForm(company = null)
            {
                this.add_company.visible = false
                this.add_company.reload++;
                if(company)
                {
                    this.record.company_id = company.id
                }
            },

            animal_selectable(caption, type, gender)
            {
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

            onFatherSelected(father)
            {
                this.father = father
            },

            onMotherSelected(mother)
            {
                this.mother = mother
            },

            /**
             * Completam setarea valorilor recordului astfel incat sa se vada 
             * in select2 si datepicker
             */
            setRecordValues(record, action)
            {
                this.father = record.father
                this.mother = record.mother
                if(record.birth_date)
                {
                    this.record.birth_date = this.datetime.setFormat('DD.MM.YYYY', record.birth_date)
                }
            }
        },

        computed: {
            statuses()
            {
                return [
                    {
                        id: '',
                        text: this.__('---'),
                    },
                    {
                        id: 'valid',
                        text: this.__('Valid'),
                    },
                    {
                        id: 'invalid',
                        text: this.__('Invalid'),
                    }
                ]
            },
            
            ajax_breeds()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Breeds\\Breed',
                        order_by: {field: 'breeds.breed', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'breed'}
                }
            },

            ajax_colors()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Colors\\Color',
                        order_by: {field: 'colors.color', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'color'}
                }
            },

            ajax_companies()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Companies\\Company',
                        order_by: {field: 'companies.name', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'name'}
                }
            },

            selected_father()
            {
                if(this.father == null)
                {
                    return null
                }
                return {id: this.father.id, text: this.father.long_name || this.father.short_name}
            },

            selected_mother()
            {
                if(this.mother == null)
                {
                    return null
                }
                return {id: this.mother.id, text: this.mother.long_name || this.mother.short_name}
            },

            
        },

        components: {
            'quick-add-form': require('./QuickAdd'),
            'quick-add-company': require('./../Companies/QuickAddCompany')
        },

        mixins: [
            require('./~mixins/watch')
        ]
    }
</script>