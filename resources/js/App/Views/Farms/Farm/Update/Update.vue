<template>
    <div v-if="fm">
        <div class="farm-controls">
            <div class="row">
                <div class="col col-md-6">
                    <textbox
                        id="farm"
                        :label="__('Numele fermei')"
                        :placeholder="__('Numele fermei')"
                        maxlength="191"
                        :disabled="action == 'delete'"
                        v-model="record.farm"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col col-md-3">
                    <textbox
                        id="cod_exploatatie"
                        :label="__('Cod exploatație')"
                        :placeholder="__('Cod exploatație')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.cod_exploatatie"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col col-md-3">
                    <textbox
                        id="cif"
                        :label="__('Cod fiscal')"
                        :placeholder="__('Cod fiscal')"
                        maxlength="16"
                        :disabled="action == 'delete'"
                        v-model="record.cif"
                        :errors="errors"
                    >
                    </textbox>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-3">
                    <simple-select
                        id="country_id"
                        :label="__('Țara')"
                        :ajax="ajax_countries"
                        :disabled="action == 'delete'"
                        v-model="record.country_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
                <div class="col col-md-3">
                    <simple-select
                        id="region_id"
                        :label="__('Regiunea')"
                        :ajax="ajax_regions"
                        :disabled="(action == 'delete') || ! record.country_id"
                        :reload="region_load"
                        v-model="record.region_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
                <div class="col col-md-3">
                    <simple-select
                        id="judet_id"
                        :label="__('Județul')"
                        :ajax="ajax_judete"
                        :disabled="(action == 'delete') || ! record.region_id"
                        :reload="judet_load"
                        v-model="record.judet_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
                <div class="col-xs-12 col-md-3">
                    <simple-select
                        id="locality_id"
                        :label="__('Localitatea')"
                        :ajax="ajax_localities"
                        :disabled="(action == 'delete') || ! record.judet_id"
                        :reload="locality_load"
                        v-model="record.locality_id"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <textbox
                        id="address"
                        :label="__('Adresa')"
                        :placeholder="__('Adresa')"
                        maxlength="191"
                        :disabled="action == 'delete'"
                        v-model="record.address"
                        :errors="errors"
                    >
                    </textbox>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-9">
                    <textbox
                        id="email"
                        :label="__('Adresa de email')"
                        :placeholder="__('Adresa se email')"
                        maxlength="128"
                        :disabled="action == 'delete'"
                        v-model="record.email"
                        :errors="errors"
                    >
                    </textbox>
                </div>
                <div class="col col-md-3">
                    <simple-select
                        id="status"
                        :label="__('Starea fermei')"
                        :options="statuses"
                        :disabled="action == 'delete'"
                        v-model="record.status"
                        :errors="errors"
                    >
                    </simple-select>
                </div>
            </div>
        </div>

        <div class="farm-footer">
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
                v-if="action != 'delete'"
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

    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'
    import FarmModel from './../../../../Models/Farms/Farms/Farm'

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
            this.model = FarmModel
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
            if( this.old.locality_id )
            {
                this.record.country_id = this.old.locality.judet.region.country_id
                this.record.region_id = this.old.locality.judet.region_id
                this.record.judet_id = this.old.locality.judet_id
                this.record.locality_id = this.old.locality_id
            }
        },

        mixins: [
            require('./../../~Mixins/Form/Record'),
            require('./../../~Mixins/Form/Computed'),
            require('./../../~Mixins/Form/Watch')
        ]
    }
</script>

<style lang="scss" scoped>
    .farm-footer {
        margin-top: 10px;
        border-top: 1px solid #cccccc;
        padding: 6px 0px;
    }
</style>
