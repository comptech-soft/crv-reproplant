<template>
    <sub-header
        v-if="false"
        :title="subheader.title"
        :icon="subheader.icon"
        :breadcrumbs="subheader.breadcrumbs"
        :actions="subheader.actions"
    >
    </sub-header>
</template>

<script>
    export default {
        computed: {
            subheader()
            {
                return require('./../../../Headers/farms')
            }
        }
    }
</script>