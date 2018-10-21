<template>
    <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics">
        <characteristic-head :caption="__('Breeding values')">
        </characteristic-head>

        <characteristic-body
            :items="filtered"
            type="horizontal"
            :has_percents="true"
            :has_numbers="true"
        >
        </characteristic-body>

    </div>
</template>

<script>
    export default {
        props: {
            characteristics: {required: true},
            animal: {required: true},
        },

        computed: {
            filtered()
            {
                return _.filter(this.characteristics, item => item.parameter.category == 'breeding-values')
            }
        },

        components: {
            'characteristic-head': require('./../Elements/CharacteristicHead'),
            'characteristic-body': require('./../Elements/CharacteristicBody'),
        }
    }
</script>

<style lang="scss" scoped>
    @import "./../Sass/characteristics.scss";
</style>