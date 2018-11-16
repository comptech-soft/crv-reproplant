<template>
    <div class="m-portlet m-portlet--tabs m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm m-portlet--bordered">
        <farm-head 
            :farm="farm" 
            :current="current" 
            @current="current=$event"
        >
        </farm-head>
        <farm-body 
            :farm="farm" 
            :current="current"
        >
        </farm-body>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {

        data() {

            return {
                current: 'data',
            }
        },

        computed: {
            farm()
            {
                return this.$store.getters.farm.record
            }
        },

        methods: {
            ...mapActions([
                'getFarm'
            ])
        },

        mounted(){
            this.getFarm(this.$route.params.id)
        },

        destroy() {
            console.log('Destroyyyy')
        },

        components: {
            'farm-head': require('./~Head'),
            'farm-body': require('./~Body')
        },

        name: 'farm-page'
    }
</script>