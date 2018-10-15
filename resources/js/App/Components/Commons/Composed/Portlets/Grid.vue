<template>
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div v-if="dt.loading" class="m-loader"></div>
            <datatable
                v-if="dt"
                :dt="dt"
                @toolbarclick="onToolbarClick"
                @rowclick="onRowClick"
            >
                <div slot="dt-filter">
                    <slot name="dt-filter"></slot>
                </div>
            </datatable>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            /**
             * Datatable manager
             */
            dt: {required: true},
        },

        methods: {
            onToolbarClick(e)
            {
                this.$emit('dttoolbarclick', e)
            },

            onRowClick(e)
            {
                this.$emit('dtrowclick', e)
            },
        },

        components: {
            datatable: require('./../Datatable/Datatable')
        }
    }
</script>