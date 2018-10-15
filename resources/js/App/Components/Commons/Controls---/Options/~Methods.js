module.exports = {


    methods:
    {
        onChange(e)
        {
            if(this.type == 'boolean')
            {
                this.$emit('input', e.target.checked ? true : false)
            }
            if(this.type == 'integer')
            {
                this.$emit('input', e.target.checked ? 1 : 0)
            }
        }
        
        
    },
    
}