<template>
    <div :class="form_group_class">

        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }}
        </label>

        <textarea 
            :id="id"
            :class="form_control_class" 
            :placeholder="placeholder" 
            :maxlength="maxlength" 
            :name="get_control_name"
            v-model="localValue"
            :disabled="disabled" 
            @input="$emit('input', $event.target.value)"
        ></textarea>

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
                localValue: ''
            }
        },

        watch: {
            value: function(newValue, oldValue)
            {
                this.localValue = newValue
            }
        },

        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 

            require('./~Props'),
            require('./~Computed'),  
        ],

        mounted()
        {
            this.localValue = this.value
        },

        name: 'edit-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>