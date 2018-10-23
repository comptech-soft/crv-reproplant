<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }}
        </label>

        <div class="input-group date">
            <input 
                :id="id"
                :class="form_control_class" 
                :placeholder="placeholder" 
                :maxlength="maxlength" 
                :name="get_control_name"
                :disabled="disabled" 
                :value="value"
                autocomplete="off"
                type="text" 
                style="font-family:Poppins"

                @input="$emit('input', $event.target.value)"
            />
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar-check-o"></i>
                </span>
            </div>
        </div>

        <error-label
            v-if="error_to_string"
            :error="error_to_string"
        >
        </error-label>
    </div>
</template>

<script>
    export default
    {
        data()
        {
            return {
                instance: null,
                is_initiated: false,
            }
        },

        watch: {
            value: function(newValue, oldValue)
            {
                if( ! oldValue )
                {
                    this.is_initiated = true
                }
                else
                {
                    if( ! this.is_initiated)
                    {
                        let d = this.datetime.setFormat('DD.MM.YYYY', newValue)
                        console.log(oldValue + '>>>>' + newValue + ' (' + d  + ')')
                        $('#' + this.id).val(d) 
                        this.$emit('input', d)
                        this.is_initiated = true
                        this.instance.datepicker('update')
                    }
                }
            }
        },

        methods: {

            /**
             * https://bootstrap-datepicker.readthedocs.io/en/latest/
             */
            init()
            {
                let v = this
                this.instance = $('#' + this.id).datepicker({
                    format: "dd.mm.yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    clearBtn: true,
                    language: "ro",
                    defaultViewDate: {},
                })
                this.instance.on('changeDate', function(e) {
                    // let d =  $('#' + this.id).val() 
                    v.$emit('input', $('#' + this.id).val() )
                })
            }
        },

        mounted()
        {
            let i = setInterval( () => {
                let el = $('#' + this.id)
                if( el.length == 1)
                {   
                    clearInterval(i)
                    this.init()
                }
            }, 250)
        },

        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 

            require('./~Props'),
            require('./~Computed'),  
        ],

        name: 'date-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>