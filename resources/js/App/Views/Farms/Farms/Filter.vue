<template>
    <div class="dt-filter-container">
        <div class="row">
            <div class="col">
                <simple-select
                    id="status"
                    :label="__('Filtrare după stare')"
                    :options="statuses"
                    v-model="record.status"
                >
                </simple-select>
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                record: {
                    status: null,
                }
            }
        },

        watch: {
            record: {
                handler: function(newRecord, oldRecord)
                {
                    this.$emit('do-filter', newRecord)
                },
                deep: true
            }
        },

        computed: {
            statuses()
            {
                return [
                    {
                        id: '',
                        text: this.__('Toate...'),
                    },
                    {
                        id: 'activ',
                        text: this.__('Active'),
                    },
                    {
                        id: 'inactiv',
                        text: this.__('Inactive'),
                    }
                ]
            }
        },

        name: 'farms-filter-form'
    }
</script>