<template>
    <sub-header
        :title="subheader.title($route.params.type, $route.params.gender)"
        :breadcrumbs="subheader.breadcrumbs"
        :actions="subheader.actions"
    >
    </sub-header>
</template>

<script>

    const Subheader = require('./../../../Headers/animals')

    export default {
        computed: {
            subheader()
            {
                return Subheader
            }
        }
    }
</script>