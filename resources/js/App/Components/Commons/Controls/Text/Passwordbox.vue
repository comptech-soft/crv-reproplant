<template>
    <div :class="form_group_class">

        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }}
        </label>

        <input 
            :id="id"
            :class="form_control_class" 
            :placeholder="placeholder" 
            :maxlength="maxlength" 
            :name="get_control_name" 
            :disabled="disabled" 
            :value="value"
            autocomplete="off"
            type="password" 
            
            @input="$emit('input', $event.target.value)"
        />

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
        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 

            require('./~Props'),
            require('./~Computed'),  
        ],

        name: 'password-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>