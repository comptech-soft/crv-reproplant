<template>
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ title }}</h3>
                <breadcrumbs :breadcrumbs="breadcrumbs"></breadcrumbs>
            </div>

            <div>
                <actions :actions="actions"></actions>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            title: {type: String, required: true},
            breadcrumbs: {type: Array, default: () => []},
            actions: {type: Object, default: () => {}}
        },

        components: {
            'breadcrumbs': require('./~components/Breadcrumbs'),
            'actions': require('./~components/Actions')
        }
    }
</script>
