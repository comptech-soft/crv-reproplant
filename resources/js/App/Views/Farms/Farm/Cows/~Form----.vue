<template>
    <div v-if="farm && fm">

        <div v-if="action=='delete'" class="alert alert-danger alert-dismissible m-alert m-alert--air m-alert--square" role="alert">
            <strong>{{__('Confirmare!')}}</strong> 
            {{ __('Sunteți sigur că doriți ștergerea vacii :name: de la ferma :farm:?', {
                name: old.user.full_name,
                farm: farm.farm,
            }) }}
        </div>

        <div style="background-color:#000; color: yellow">
            {{ record }}
        </div>

        <form-box :formManager="fm">
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
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
                <div class="col">
                    <textbox
                        id="short_number"
                        field="codes"
                        :label="__('Număr scurt')"
                        :placeholder="__('Număr scurt')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.short_number"
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
                <div class="col">
                    <textbox
                        id="internal_number"
                        field="codes"
                        :label="__('Număr intern')"
                        :placeholder="__('Număr intern')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.internal_number"
                        :errors="fm.errors"
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
                        :disabled="action == 'delete'"
                        v-model="record.birth_date"
                        :errors="fm.errors"
                    >
                    </datebox>
                </div>
                <div class="col">
                    <datebox
                        id="last_calving_date"
                        :label="__('Data ultimei fătări')"
                        :placeholder="__('Data ultimei fătări')"
                        :disabled="action == 'delete'"
                        v-model="record.last_calving_date"
                        :errors="fm.errors"
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
                        :errors="fm.errors"
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
                        :errors="fm.errors"
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
                        :errors="fm.errors"
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
                        :errors="fm.errors"
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
        </form-box>

        <div class="row" style="margin-top:10px">
            <div class="col">
                <button 
                    type="button" 
                    :class="buttonType + (fm.submitting ? ' m-loader m-loader--light m-loader--right': '')" 
                    @click="save"
                >
                    <i :class="buttonIcon"></i>
                    {{ __(buttonCaption) }}
                </button>
                <button 
                    type="button" 
                    class="btn btn-secondary" 
                    @click="$emit('cancel')"
                >
                    <i class="la la-times"></i>
                    {{ __('Renunță') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'

    export default {
        props: {
            farm: {required: true},
            action: {required: true},
            old: {required: true},
        },

        data()
        {
            return {
                fm: null,
                record: {
                    id: null,
                    matricol_number: null,
                    short_number: null,
                    internal_number: null,
                    birth_date: null,
                    last_calving_date: null,
                    breed_id: null,
                    parity: null,
                    father_id: null,
                    mother_id: null,
                    status_in_farm: 'activ',
                    type: 'cow',
                    gender: 'female',
                    animal_status: 'invalid',
                },
                father: null,
                mother: null,
            }
        },

        methods: {
            fillRecord()
            {
                _.each(this.record, (value, field) => this.record[field] = this.old[field])
                this.record.first_name = this.old.user.first_name
                this.record.last_name = this.old.user.last_name
                this.record.email = this.old.user.email
                this.record.role = this.old.user.roles[0].id
            },

            onFatherSelected(father)
            {
                this.father = father
            },

            onMotherSelected(mother)
            {
                this.mother = mother
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

            save()
            {
                this.fm.onClickSubmit(
                    'farms/save-cow', 
                    this.rules,
                    data => {
                        if(data.success)
                        {
                            this.notySuccess(data.result.message)
                            this.$emit('cancel')
                        }
                        else
                        {
                            this.notyError(data.result.message)
                        }
                    }
                )
            }
        },

        computed: {

            rules()
            {
                if(this.action == 'delete')
                {
                    return null
                }
                let r = {
                    matricol_number: 'required',
                }
                return r
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

        mounted()
        {
            if( this.action != 'insert')
            {
                this.fillRecord()
            }
            this.fm = new AppCore.FormManager('farm-animals-form', this)
            this.fm.getData = () => {
                return {
                    action: this.action,
                    record: this.record,
                    farm_id: this.farm.id,
                    old: this.old
                }
            }
        }
    }
</script>