<template>
    <div class="m-portlet__body">
        <table class="table m-table characteristics-table">
            <thead v-if="type=='horizontal'">
                <tr class="m-table__row--brand">
                    <th class="cell" v-for="item in items" :style="{width: 100/items.length + '%'}" :key="'row-' + item.id">
                        {{ __(item.parameter.caption) }}
                    </th>
                </tr>
            </thead>
            <tbody v-if="type=='vertical'">
                <slot name="body-before">
                </slot>
                <tr class="m-table__row--active" v-for="item in items" :key="'row-' + item.id">
                    <td class="cell cell-caption" v-html="__(item.parameter.caption)"></td>
                    <td class="cell" v-if="has_progress" style="width:40%">
                        <div class="progress-container">
                            <div class="progress-cell progress-container-left">
                                <div v-if="item.value < 100" class="progress m-progress--sm" style="position: relative">
                                    <div 
                                        class="progress-bar m--bg-primary" 
                                        role="progressbar" 
                                        :style="{
                                            width: 7*(100 - item.value) + '%',
                                            position: 'absolute',
                                            top: 0,
                                            bottom: 0, 
                                            right: 0
                                        }" 
                                        :aria-valuenow="7*(100 - item.value)"
                                        aria-valuemin="0" 
                                        aria-valuemax="100"
                                    >
                                    </div>
                                </div>
                                <div v-else style="width:100%">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="progress-cell progress-container-right">
                                <div v-if="item.value > 100" class="progress m-progress--sm">
                                    <div 
                                        class="progress-bar m--bg-primary" 
                                        role="progressbar" 
                                        :style="{
                                            width: 7*(item.value - 100) + '%'
                                        }" 
                                        :aria-valuenow="7*(item.value - 100)" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100"
                                    >
                                    </div>
                                </div>
                                <div v-else style="width:100%">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </td>
                    <td 
                        class="cell" 
                        :style="{
                            'text-align': has_numbers ? 'right' : 'left',
                        }"
                    >
                        {{ __(item.value) }}
                    </td>
                     <td 
                        v-if="has_percents"
                        class="cell" 
                        :style="{
                            'text-align': 'right',
                        }"
                    >
                        {{ __(item.percent) }}
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr class="m-table__row--active">
                    <th 
                        class="cell" 
                        v-for="item in items" 
                        :style="{
                            width: 100/items.length + '%',
                            'text-align': has_numbers ? 'right' : 'left',
                        }" 
                        :key="'row-' + item.id"
                    >
                        {{ item.value }}
                    </th>
                </tr>
                <tr v-if="has_percents" class="m-table__row--active">
                    <th 
                        class="cell" 
                        v-for="item in items" 
                        :style="{
                            width: 100/items.length + '%',
                            'text-align': 'right',
                        }" 
                        :key="'row-' + item.id"
                    >
                        {{ item.percent }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            items: {required: true},
            type: {default: 'vertical'},
            has_percents: {default: false},
            has_numbers: {default: false},
            has_progress: {default: false},
        },
    }
</script>

<style lang="scss" scoped>
    @import "./../Sass/characteristics.scss";

    .progress-container
    {
        width: 100%;
        .progress-cell
        {
            width: 50%;
            float: left;
        }
        .progress-container-left
        {
            text-align: right;
        }
    }
</style>