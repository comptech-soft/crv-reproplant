<template>
    <button 
        :id="id"
        :class="getTagClass"
        type="button"

        @click.prevent="$emit('click')"
    >
        <i v-if="iconClass" :class="iconClass"></i>

        <span v-if="caption" v-html="caption"></span>
    </button>
</template>

<script>
    export default
    {
        props:
        {
            id: {default: null},
            tagClass: {default: null},
            iconClass: {default: null},
            caption: {default: null},
        },

        computed:
        {
            getTagClass()
            {
                return this.makeClass('tagClass', {})
            }
        },

        name: 'command-button'
    }
</script>