<template>
    <form-box>
        <div class="row">
            <div class="col">
                <textbox
                    id="matricol_number"
                    field="matricol_number"
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
                <datebox
                    id="last_calving_date"
                    :label="__('Data ultimei fătări')"
                    :placeholder="__('Data ultimei fătări')"
                    maxlength="16"
                    :disabled="action == 'delete'"
                    v-model="record.last_calving_date"
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
                <number-box
                    id="parity"
                    :label="__('Paritate')"
                    :placeholder="__('Paritate')"
                    :disabled="action == 'delete'"
                    autonumeric="integerPos"
                    v-model="record.parity"
                    :errors="errors"
                >
                </number-box>
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
            :farm_id="quick_add_form.type == 'sire' ? null : farm.id"
            @close="hideQuickAddForm"
        >
        </quick-add-form>
        
    </form-box>
</template>

<script>
    export default {    
        
        props: {
            farm: {required: true},
        },

        data()
        {
            return {
                errors: null,
                action: null,
                record: {
                    id: null,
                    farm_id: null,
                    animal_required: false,
                    type: 'cow',
                    gender: 'female',
                    animal_status: 'valid',
                    matricol_number: '',
                    birth_date: null,
                    last_calving_date: null,
                    breed_id: null,
                    father_id: null,
                    mother_id: null,
                    short_number: null,
                    internal_number: null,
                    status_in_farm: null,
                    parity: null,
                },

                father: null,
                
                mother: null,
                
                quick_add_form: {
                    visible: false,
                    type: null,
                    gender: null,
                },

            }
        },

        computed: {
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
            
            ajax_breeds() {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Breeds\\Breed',
                        order_by: {field: 'breeds.breed', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'breed'}
                }
            },

            selected_father() {
                if(this.father == null)
                {
                    return null
                }
                return {id: this.father.id, text: this.father.long_name || this.father.short_name || this.father.matricol_number}
            },

            selected_mother() {
                if(this.mother == null)
                {
                    return null
                }
                return {id: this.mother.id, text: this.mother.long_name || this.mother.short_name || this.mother.matricol_number}
            },
        },

        watch: {

            'record.matricol_number': {
                handler: function(newMatricolNumber, oldMatricolNumber) {
                    
                    if(newMatricolNumber != undefined )
                    {
                        if(newMatricolNumber != oldMatricolNumber)
                        {
                            let l = newMatricolNumber.length
                            console.log(oldMatricolNumber + ' >>> ' + newMatricolNumber + ' (' + l + ')')
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

        methods: {            

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

            /**
             * Completam setarea valorilor recordului astfel incat sa se vada 
             * in select2 si datepicker
             */
            setRecordValues(record, action)
            {
                this.record.matricol_number = record.animal.matricol_number
                this.record.animal_required = false
                this.record.animal_status = record.animal.animal_status
                this.record.breed_id = record.animal.breed_id
                this.record.father_id = record.animal.father_id
                this.record.mother_id = record.animal.mother_id
                this.record.gender = record.animal.gender
                this.record.type = record.animal.type
                this.record.parity = record.animal.parity
                this.father = record.animal.father
                this.mother = record.animal.mother
                this.record.birth_date = (record.animal.birth_date ? this.datetime.setFormat('DD.MM.YYYY', record.animal.birth_date) : null)
                this.record.last_calving_date = (record.animal.last_calving_date ? this.datetime.setFormat('DD.MM.YYYY', record.animal.last_calving_date) : null)
            },

            animal_selectable(caption, type, gender) {

                let search_by = ( 
                    (type == 'sire') 
                    ? ['animals.long_name', 'animals.short_name', 'animals.interbull_code']
                    : ['animals.matricol_number']
                )
                let order_by = ( 
                    (type == 'sire') 
                    ? 'animals.long_name'
                    : 'animals.matricol_number'
                )


                return {
                    placeholder: caption,
                    model: '\\App\\Models\\Animals\\Animals\\Animal',
                    search_by,
                    order_by,
                    filter_by: [
                        "animals.type = '" + type + "'",
                        "animals.gender = '" + gender + "'" 
                    ],
                    processResults: data => {
                        return {
                            results: _.map(data.results, record => {
                                if( type == 'sire')
                                {
                                    record.text = (record.long_name || record.short_name) + ' (' + (record.interbull_code || record.matricol_number) + ')'
                                } 
                                else
                                {
                                    record.text = record.matricol_number
                                }
                                return record
                            })
                        };
                    }
                }
            },

            onFatherSelected(father) {
                this.father = father
            },

            onMotherSelected(mother) {
                this.mother = mother
            },

            showQuickAdd(type, gender) {
                this.quick_add_form.visible = true
                this.quick_add_form.type = type
                this.quick_add_form.gender = gender
            },

            hideQuickAddForm(animal = null) {
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
        },

        mounted() {
            this.record.farm_id = this.farm.id
        },

        components: {
            'quick-add-form': require('./../../../Animals/Animals/QuickAdd'),
        },


    }
</script>