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
                    farm: '',
                    cod_exploatatie: '',
                    cif: '',
                    status: 'activ',
                    address: '',
                    email: '',
                    country_id: null,
                    region_id: null,
                    judet_id: null,
                    locality_id: null,
                },
                region_load: 0,
                judet_load: 0,
                locality_load: 0,
            }
        },

        watch: {

            'record.country_id': function(newCountryId, oldCountryId)
            {
                if( ! newCountryId )
                {
                    this.record.region_id = null
                }
                this.region_load++
                this.judet_load++
                this.locality_load++
            },

            'record.region_id': function(newRegionId, oldRegionId)
            {
                if( ! newRegionId )
                {
                    this.record.judet_id = null
                }
                this.judet_load++
                this.locality_load++
            },

            'record.judet_id': function(newJudetId, oldJudetId)
            {
                if( ! newJudetId )
                {
                    this.record.locality_id = null
                }
                this.locality_load++
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
                        id: 'activ',
                        text: this.__('Activă'),
                    },
                    {
                        id: 'inactiv',
                        text: this.__('Inactivă'),
                    }
                ]
            },

            ajax_countries()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Locations\\Countries\\Country',
                        order_by: {field: 'geo_countries.name', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'name'}
                }
            },

            ajax_regions()
            {
                if(! this.region_load)
                {
                    return null
                }
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Locations\\Regions\\Region',
                        order_by: {field: 'geo_regions.name', dir: 'asc'},
                        filter_by_fields: {
                            country_id: { 
                                value: this.record.country_id ? this.record.country_id : -1,
                                where: 'geo_regions.country_id = [value]'
                            }
                        }
                    },
                    map: {id: 'id', text: 'name'}
                }
            },

        ajax_judete()
        {
            if(! this.judet_load)
            {
                return null
            }
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Locations\\Judete\\Judet',
                    order_by: {field: 'geo_judete.name', dir: 'asc'},
                    filter_by_fields: {
                        country_id: { 
                            value: this.record.region_id ? this.record.region_id : -1,
                            where: 'geo_judete.region_id = [value]'
                        }
                    }
                },
                map: {id: 'id', text: 'name'}
            }
        },

        ajax_localities()
        {
            if(! this.locality_load )
            {
                return null
            }
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Locations\\Localities\\Locality',
                    order_by: {field: 'geo_localities.name', dir: 'asc'},
                    filter_by_fields: {
                        country_id: { 
                            value: this.record.judet_id ? this.record.judet_id : -1,
                            where: 'geo_localities.judet_id = [value]'
                        }
                    }
                },
                map: {id: 'id', text: 'name'}
            }
        },
        },
    }
</script>