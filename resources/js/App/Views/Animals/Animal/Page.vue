<template>
    <div class="m-portlet m-portlet--tabs m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm m-portlet--bordered">        
        
        <animal-head 
            :animal="animal" 
            :current="current" 
            @current="setCurrent"
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
                current: 'pedigree',
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

            setCurrent(e) {
                this.current = e
                this.$router.push({
                    name: 'animal',
                    params: {
                        id: this.animal.id,
                        current: e
                    }
                })
            },

            updated() {
                this.getAnimal(this.$route.params.id)
            }
        },

        beforeRouteUpdate(to, from, next){
            next()
            this.getAnimal(this.$route.params.id)
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
        
        mounted(){
            this.current = this.$route.params.current || 'pedigree'
            this.getAnimal(this.$route.params.id)
        },

        destroyed() {
            console.log('Destroyyyy')
        },

        components: {
            'animal-head': require('./~Head'),
            'animal-body': require('./~Body')
        },

        name: 'animal-page'
    }
</script>