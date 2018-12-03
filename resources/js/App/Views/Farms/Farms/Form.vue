<template>
    <form-box>
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
            <div class="col col-md-6">
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
            <div class="col col-md-3">
                <number-box
                    id="external_id"
                    :label="__('ID Extern')"
                    :placeholder="__('ID Extern')"
                    :disabled="action == 'delete'"
                    autonumeric="integerPos"
                    v-model="record.external_id"
                    :errors="errors"
                >
                </number-box>
            </div>
        </div>
    </form-box>
</template>

<script>
    export default {    
        
        data() {
            return {
                errors: null,
                action: null, 
            }
        },

        methods: {
            setRecordValues(record, action) {
                if( record.locality_id )
                {
                    this.record.country_id = record.locality.judet.region.country_id
                    this.record.region_id = record.locality.judet.region_id
                    this.record.judet_id = record.locality.judet_id
                    this.record.locality_id = record.locality_id
                }
            }
        },

        mixins: [
            require('./../~Mixins/Form/Record'),
            require('./../~Mixins/Form/Computed'),
            require('./../~Mixins/Form/Watch')
        ]
    }
</script>