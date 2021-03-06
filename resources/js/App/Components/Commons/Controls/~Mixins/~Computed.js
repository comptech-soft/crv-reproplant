module.exports = {

    computed:
    {
        form_group_class()
        {
            let r = this.makeClass('formGroupClass', {
                'form-group': true,
                'm-form__group': true,
            })
            if( this.has_error )
            {
                r['has-danger'] = true
            }
            return r
        },

        form_control_class()
        {
            return this.makeClass('formControlClass', {
                'form-control': true,
            })
        },

        label_class()
        {
            return this.makeClass('labelClass', {})
        },

        get_control_name()
        {
            return this.name ? this.name : this.id
        },

        has_error()
        {
            if( this.errors == null )
            {
                return false;
            }
            if( this.id && this.errors.has(this.id))
            { 
                return true
            }
            let field = this.field ? this.field : this.get_control_name
            return this.errors.has(field)
        },

        error_to_string()
        {
            if( this.errors == null )
            {
                return '';
            }
            if( this.id && (this.errors.has(this.id)) )
            {
                return this.errors.collect(this.id).map(e => this.__(e)).toString();
            }
            let field = this.field ? this.field : this.get_control_name
            if( (this.errors == null) || (! this.errors.has(field) ) )
            {
                return '';
            }
            return this.errors.collect(field).map(e => this.__(e)).toString();
        }
    },
    
}