<template>
    <div v-if="farm && dt" style="position: relative">
        <div 
            v-if="dt.loading"
            class="m-spinner m-spinner--brand text-center" 
            style="width:19.5px; margin:0 auto; display:block; position: absolute; left: calc(50% - 10px)"
        >
        </div>

        <div class="m-widget3" v-if="records.length">
            <div 
                class="m-widget3__item"
                v-for="(cow, indexCow) in records"
                :key="'item-user-' + cow.id + '-' + indexCow"
            >

                <item-header :cow="cow">
                </item-header>
                
                <item-body :cow="cow">
                </item-body>
            </div>
        </div>
        <div v-else-if="! dt.loading" class="m-alert m-alert--square m-alert--outline alert alert-info" role="alert">
            <strong>{{farm.farm}}</strong> 
            {{ __('Nu are vaci definite.') }}
        </div>
    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'

    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
                dt: null,
            }
        },

        mounted()
        {
            this.dt = new AppCore.DatatableManager('grid-farm-users', {
                model: '\\App\\Models\\Farms\\Animals\\Animal',
                grid: {
                    search_by_fields: [],
                }
            }, this)

            this.dt.addFilter('farm_id', {
                value: this.farm.id,
                where: 'farms_animals.farm_id=[value]',
            }).populate()
        },

        methods: {
            

        },

        computed: {
            records()
            {
                return this.dt.records
            }
        },

        components: {
            'item-header': require('./~ItemHeader'),
            'item-body': require('./~ItemBody')
        }
    }
</script>