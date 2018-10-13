<template>
    <div v-if="items.length" class="m-dropdown__wrapper">
        <span 
            :class="spanClass"
        >
        </span>
        <div class="m-dropdown__inner">
            <slot name="inner">
            </slot>
            <div class="m-dropdown__body cs-dropdown-body">
                <div class="m-dropdown__content">
                    <ul v-if="ulClass" :class="ulClass">
                        <dropdown-item
                            v-for="(item, index) in items"
                            :key="'dropdown-item-' + index"
                            :item="item"

                            @click="$emit('click', $event)"
                        >   
                        </dropdown-item>
                    </ul>
                    <slot name="content">
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            items: {default: () => []},
            spanClass: {default: '', required: true},
            ulClass: {default: '', required: true},
        },

        components:
        {
            'dropdown-item': require('./Item')
        },

        name: 'dropdown'
    }
</script>

<style scoped lang="scss">
    div.cs-dropdown-body
    {
        padding: 8px !important;
    }
</style>