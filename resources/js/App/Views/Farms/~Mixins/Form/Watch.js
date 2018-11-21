module.exports = {

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
}