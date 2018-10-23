module.exports = {

    watch: {
        'record.short_name': function(newShortName, oldShortName)
        {
            this.record.names = this.record.short_name || this.record.long_name
        },

        'record.long_name': function(newShortName, oldShortName)
        {
            this.record.names = this.record.short_name || this.record.long_name
        },

        'record.interbull_code': function(newShortName, oldShortName)
        {
            this.record.codes = this.record.interbull_code || this.record.matricol_number || this.record.naab || this.record.cod_ro
        },

        'record.matricol_number': function(newShortName, oldShortName)
        {
            this.record.codes = this.record.interbull_code || this.record.matricol_number || this.record.naab || this.record.cod_ro
        },

        'record.naab': function(newShortName, oldShortName)
        {
            this.record.codes = this.record.interbull_code || this.record.matricol_number || this.record.naab || this.record.cod_ro
        },

        'record.cod_ro': function(newShortName, oldShortName)
        {
            this.record.codes = this.record.interbull_code || this.record.matricol_number || this.record.naab || this.record.cod_ro
        }
    },
}