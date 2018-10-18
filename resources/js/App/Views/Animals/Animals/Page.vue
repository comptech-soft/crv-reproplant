<template>
    <dt-grid-page
        id="animals"
        :caption="__('Lista generală de tauri')"
        :model="model"
    >
        <!-- criteriile de filtrare -->
        <div slot="dt-filter">       
            <filter-form
                @do-filter="onFilter"
            >
            </filter-form>
        </div>

        <!-- controalele formularului -->
        <div slot="dt-form">
            <action-form>
            </action-form>
        </div>
    </dt-grid-page>
</template>

<script>

    import model from './../../../Models/Animals/Animals/Animal'
    

    export default{

        mounted(){
            this.model = model
            this.model
                .addFilterByCriteria('type', {
                    value: this.$route.params.type,
                    where: 'animals.type=[value]'
                })
                .addFilterByCriteria('gender', {
                    value: this.$route.params.gender,
                    where: 'animals.gender=[value]'
                })
        },

        components: {
            'filter-form': require('./Filter'),
            'action-form': require('./Form')
        },

        mixins: [
            require('./../../~Commons/Page/Mixins/data'),
            require('./../../~Commons/Page/Mixins/computed'),
            require('./../../~Commons/Page/Mixins/methods'),
            require('./../../~Commons/Page/Mixins/components')
        ],

        name: 'animals-page'
    }
</script>