module.exports = {

    computed: {
        
        statuses() {
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

        ajax_countries() {
            return {
                endpoint: 'api/get-datatable-rows',
                data: {
                    model: '\\App\\Models\\Locations\\Countries\\Country',
                    order_by: {field: 'geo_countries.name', dir: 'asc'},
                },
                map: {id: 'id', text: 'name'}
            }
        },

        ajax_regions() {
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

        ajax_judete() {
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

        ajax_localities() {
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

    }
}