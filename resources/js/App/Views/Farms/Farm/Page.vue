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

        beforeRouteEnter (to, from, next) {
            let user_id = document.head.querySelector('meta[name="has-user"]').content
            if( user_id == 0)
            {
                let i = setTimeout( () => {
                    location.href = document.head.querySelector('meta[name="base-url"]').content
                }, 10)
            }
            else
            {
                next()
            }
        },

        beforeRouteUpdate (to, from, next) {
            console.log('Before Update...')
            next();
        },

        beforeRouteLeave(to, from, next) {
            console.log('Before Leave...');
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