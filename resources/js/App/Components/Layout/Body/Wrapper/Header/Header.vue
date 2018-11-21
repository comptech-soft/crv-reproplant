<template>
    <div class="m-subheader" :style="hstyle">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 :class="{'m-subheader__title': true, 'm-subheader__title--separator': has_breadcrumbs}">
                    <img style="height:48px" v-if="icon" :src="$app.url + icon" />
                    <span>{{ title }}</span>
                </h3>
                <breadcrumbs v-if="has_breadcrumbs" :breadcrumbs="breadcrumbs"></breadcrumbs>
            </div>

            <div v-if="has_actions">
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
            actions: {type: Object, default: () => {}},
            icon: {default: ''},
            hstyle: {type: Object, default: () => {
                return {
                    padding: '0px'
                }
            }}
        },

        computed: {
            has_actions() {
                return this.actions && _.keys(this.actions.options).length 
            },

            has_breadcrumbs() {
                return this.breadcrumbs.length
            }
        },

        components: {
            'breadcrumbs': require('./~components/Breadcrumbs'),
            'actions': require('./~components/Actions')
        }
    }
</script>
