<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }}
        </label>
        
        <div class="input-group">
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
                style="text-align:right"

                @input="$emit('input', $event.target.value)"
            />
            <span v-if="symbol" class="input-group-addon" v-html="symbol"></span>
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
        
        methods: {

            /**
             * integer
             * integerPos, integerNeg
             * float
             * floatPos
             * ....
             * http://autonumeric.org/examples
             */
            init()
            {
                new Autonumeric('#' + this.id, this.autonumeric)
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

        name: 'text-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>