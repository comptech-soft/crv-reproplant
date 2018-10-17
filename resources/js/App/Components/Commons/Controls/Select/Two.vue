<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }} 
            <i v-if="loading" class="fa fa-spinner fa-spin"></i>
        </label>

        <select 
            class="form-control"
            :disabled="disabled"
            @change="onChange"
        >
            <option 
                v-for="(o, i) in get_options"
                :key="'option-' + i"
                :value="o.id"
                :selected="o.id == value"
            >
                {{ o.text }}
            </option>
        </select>

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
                loading: false,
                records: [],
            }
        },

        methods: {
            onChange(e)
            {
                this.$emit('input', e.target.value ? e.target.value : null)
            },
        },

        mounted()
        {
            if( this.ajax )
            {
                this.loading = true
                this.post( this.ajax.endpoint, this.ajax.data, data => {
                    this.loading = false
                    this.records = data
                })
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

        name: 'two-select-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>