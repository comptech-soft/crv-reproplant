<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }} 
        </label>

        <select 
            :class="form_control_class"
            :disabled="disabled"
            :id="id"
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
        computed:
        {
            get_options()
            {
                let r = [{id: '', text: this.__('---')}], year = this.datetime.year()
                for(let y = year; y >= year - 50; y--)
                {
                    r.push({id: y, text: y})
                }
                return r
            }
        },
        
        methods: {
            onChange(e)
            {
                this.$emit('input', e.target.value ? e.target.value : null)
            },
        },

        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 
            require('./~Props'),
        ],

        name: 'simple-select-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>