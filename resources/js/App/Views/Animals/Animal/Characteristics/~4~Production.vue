<template>
    <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics">
        <characteristic-head :caption="__('Production traits')">
        </characteristic-head>
        <div class="m-portlet__body">
            <table class="table m-table characteristics-table">
                <thead>
                    <tr class="m-table__row--brand">
                        <th class="cell" v-for="item in filtered" :style="{width: 100/filtered.length + '%'}" :key="'row-' + item.id">
                            {{ __(item.parameter.caption) }}
                        </th>
                    </tr>
                </thead>
                <thead>
                    <tr class="m-table__row--active">
                        <th class="cell" v-for="item in filtered" :style="{width: 100/filtered.length + '%'}" :key="'row-' + item.id">
                            {{ item.value }}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
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
                return _.filter(this.characteristics, item => item.parameter.category == 'production')
            }
        },

        components: {
            'characteristic-head': require('./../Elements/CharacteristicHead'),
        }
    }
</script>

<style lang="scss" scoped>
    @import "./../Sass/characteristics.scss";
</style>