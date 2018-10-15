<template>
    <div class="checkbox icheck">
        <label>
            <input 
                :id="id" 
                type="checkbox"
                :name="get_control_name" 
                :checked="value"
                :disabled="disabled"
            > 
            {{ caption }}
        </label>
    </div>
</template>

<script>
    export default
    {
        
        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./~Props'),
            require('./~Computed'),  
            require('./~Methods'),  
        ],

        watch: {
            disabled: function(newDisabled, oldDisabled)
            {
                this.sync(this.value, newDisabled)
            },

            value: function(newValue, oldValue)
            {
                this.sync(newValue, this.disabled)
            }
        },

        methods: {
            
            sync(value, disabled)
            {
                let el = $('input#' + this.id)
                if(value)
                {
                    el.iCheck('check');
                }
                else
                {
                    el.iCheck('uncheck');
                }
                if(disabled)
                {
                    el.iCheck('disabled')
                    el.parent().addClass('disabled')
                }
                else
                {
                    el.iCheck('enabled')
                    el.parent().removeClass('disabled')
                }
            },

            updateValue(value)
            {
                this.checked = value;
                if( this.type == 'integer')
                {
                    value = (value ? 1 : 0);
                }
                this.$emit('input', value);
            },

            init()
            {
                let vm = this
                $('input#' + this.id).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%'
                }).on('ifUnchecked', function(e){
                    vm.updateValue(false);
                }).on('ifChecked', function(e){
                    vm.updateValue(true);
                });
            }
        },

        mounted(){
            let i = setInterval( () => {
                if( $('input#' + this.id).length == 1)
                {
                    clearInterval(i)
                    this.init()
                }
            }, 100)
        },

        name: 'check-box'
    }
</script>