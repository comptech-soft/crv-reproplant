module.exports = {

    computed:
    {
        get_options()
        {
            if( ! this.ajax )
            {
                return this.options;
            }
            let r = [
                {
                    id: '',
                    text: this.__('---')
                },
            ]
            _.map(this.records, record => r.push({
                id: record[this.ajax.map.id],
                text: record[this.ajax.map.text]
            }))
            return r
        }
    },
    
}