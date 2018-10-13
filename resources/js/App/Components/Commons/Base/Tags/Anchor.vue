<template>
    <a
        :id="id"
        :href="href"
        :class="getTagClass"
        
        @click="$emit('click')"
    >
        <slot>
        </slot>
    </a>
</template>

<script>
    export default
    {
        props:
        {
            id: {default: null},
            href: {default: 'javascript:void(0);'},
            tagClass: {default: null}
        },

        computed:
        {
            getTagClass()
            {
                return this.makeClass('tagClass', {})
            }
        },

        name: 'anchor'
    }
</script>