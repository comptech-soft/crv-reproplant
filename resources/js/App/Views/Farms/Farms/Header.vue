<template>
    <sub-header
        :title="subheader.title"
        :breadcrumbs="subheader.breadcrumbs"
        :actions="subheader.actions"
    >
    </sub-header>
</template>

<script>

    const Subheader = require('./../../../Headers/farms')

    export default {
        computed: {
            subheader()
            {
                return Subheader
            }
        }
    }
</script>