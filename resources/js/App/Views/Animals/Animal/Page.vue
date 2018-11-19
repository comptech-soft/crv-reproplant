<template>
    <div class="m-portlet m-portlet--tabs m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm m-portlet--bordered">
        
        <animal-head 
            :animal="animal" 
            :current="current" 
            @current="current=$event"
        >
        </animal-head>
        
        <animal-body 
            :animal="animal" 
            :current="current" 
            @updated="updated">
        </animal-body>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {

        data() {
            return {
                /**
                 * Care tab este activ
                 */
                current: 'traits',
            }
        },

        computed: {
            /**
             * Animalul selectat via store
             */
            animal() {
                return this.$store.getters.animal.record
            }
        },

        methods: {
            ...mapActions([
                'getAnimal'
            ]),

            updated() {
                this.getAnimal(this.$route.params.id)
            }
        },

        beforeRouteUpdate(to, from, next){
            next()
            console.log('beforeRouteUpdate.... >>> ' + this.$route.params.id)
            this.getAnimal(this.$route.params.id)
        },

        mounted(){
            console.log('Mounted.... >>> ' + this.$route.params.id + '|' + this.$route.params.current)
            this.current = this.$route.params.current || 'traits'
            this.getAnimal(this.$route.params.id)
        },

        destroy() {
            console.log('Destroyyyy')
        },

        components: {
            'animal-head': require('./~Head'),
            'animal-body': require('./~Body')
        },

        name: 'animal-page'
    }
</script>