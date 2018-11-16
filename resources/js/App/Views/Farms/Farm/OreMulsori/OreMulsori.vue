<template>
    <div v-if="farm">
        <div class="m-alert m-alert--icon alert alert-info m-alert--square m-alert--outline" role="alert">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                <strong>{{ __('Atenție') }}.</strong> 
                {{ __('Aici se definesc orele la care se fac mulsorile.') }}
            </div>
            <div class="m-alert__actions" style="width: 160px;">
                <button type="button" class="btn btn-warning btn-sm m-btn m-btn--wide" @click="disabled=false">
                    {{ __('Editează') }}
                </button>
            </div>
        </div>

        <div class="row">
            <div v-for="(part, index) in day_parts" :key="'day-' + index" class="col">
                <simple-select
                    :id="part"
                    :label="__(part)"
                    :options="options[part]"
                    v-model="ora[part]"
                    :errors="errors"
                    :disabled="disabled"
                >
                </simple-select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button 
                    type="button" 
                    :class="'btn btn-primary' + (saving ? ' m-loader m-loader--light m-loader--right': '')" 
                    :disabled="disabled" 
                    @click="save"
                >
                    <i class="la la-save"></i>
                    {{ __('Salvează') }}
                </button>
                <button 
                    type="button" 
                    class="btn btn-secondary" 
                    :disabled="disabled" 
                    @click="disabled=true"
                >
                    <i class="la la-times"></i>
                    {{ __('Renunță') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
                farm_id: null,
                ora: {
                    dimineata: null,
                    amiaza: null,
                    seara: null,
                },
                errors: null,
                disabled: true,
                saving: false,
            }
        },

        computed: {
            day_parts()
            {
                return ['dimineata', 'amiaza', 'seara']
            },

            oremulsori()
            {
                return this.farm.oremulsori
            },

            options()
            {
                return {
                    dimineata: [
                        { id: '', text: this.__('---') },
                        { id: '04:00', text: '04:00' },
                        { id: '04:30', text: '04:30' },
                        { id: '05:00', text: '05:00' },
                        { id: '05:30', text: '05:30' },
                        { id: '06:00', text: '06:00' },
                        { id: '06:30', text: '06:30' },
                        { id: '07:00', text: '07:00' },
                        { id: '07:30', text: '07:30' },
                        { id: '08:00', text: '08:00' },
                        { id: '08:30', text: '08:30' },
                        { id: '09:00', text: '09:00' },
                        { id: '09:30', text: '09:30' },
                        { id: '10:00', text: '10:00' },
                        { id: '10:30', text: '10:30' },
                        { id: '11:00', text: '11:00' },
                        { id: '11:30', text: '11:30' },
                    ],
                    amiaza: [
                        { id: '', text: this.__('---') },
                        { id: '12:00', text: '12:00' },
                        { id: '12:30', text: '12:30' },
                        { id: '13:00', text: '13:00' },
                        { id: '13:30', text: '13:30' },
                        { id: '14:00', text: '14:00' },
                        { id: '14:30', text: '14:30' },
                        { id: '15:00', text: '15:00' },
                        { id: '15:30', text: '15:30' },
                        { id: '16:00', text: '16:00' },
                        { id: '16:30', text: '16:30' },
                    ],
                    seara: [
                        { id: '', text: this.__('---') },
                        { id: '17:00', text: '17:00' },
                        { id: '17:30', text: '17:30' },
                        { id: '18:00', text: '18:00' },
                        { id: '18:30', text: '18:30' },
                        { id: '19:00', text: '19:00' },
                        { id: '19:30', text: '19:30' },
                        { id: '20:00', text: '20:00' },
                        { id: '20:30', text: '20:30' },
                        { id: '21:00', text: '21:00' },
                        { id: '21:30', text: '21:30' },
                        { id: '22:00', text: '22:00' },
                    ]
                }
            }
        },

        methods: {
            save()
            {
                this.saving = true
                this.post('farms/save-ore-mulsori', {farm_id: this.farm_id, ora: this.ora}, data => {
                    this.saving = false
                    if(data.success)
                    {
                        this.notySuccess(data.result.message)
                        this.disabled = true 
                    }
                    else
                    {
                        this.notyError(data.result.message)
                    }
                })
            }
        },

        mounted()
        {
            this.farm_id = this.farm.id
            _.each(this.oremulsori, record => this.ora[record.parte_zi] = record.ora)
        }
    }
</script>