<template>
    <div class="m-portlet m-portlet--tabs m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm m-portlet--bordered">
        <farm-head 
            :farm="farm" 
            :current="current" 
            @current="setCurrent"
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
            farm() {
                return this.$store.getters.farm.record
            }
        },

        methods: {
            ...mapActions(['getFarm', 'setFarm']),

            setCurrent(e) {
                this.current = e
                this.$router.push({
                    name: 'farm',
                    params: {
                        id: this.farm.id,
                        current: e
                    }
                })
            },
        },

        mounted(){
            this.getFarm(this.$route.params.id)
            this.current = this.$route.params.current || 'data'
        },

        beforeRouteLeave(to, from, next) {
            this.setFarm(null)
            next();
        },

        destroyed() {
        },

        components: {
            'farm-head': require('./~Head'),
            'farm-body': require('./~Body')
        },

        name: 'farm-page'
    }
</script>