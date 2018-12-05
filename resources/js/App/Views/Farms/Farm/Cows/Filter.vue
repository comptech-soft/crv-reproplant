<template>
    <div class="dt-filter-container">
        <div class="row">
            <div class="col">
                <simple-select
                    id="status"
                    :label="__('Filtrare vaci după stare în fermă')"
                    :options="farm_statuses"
                    v-model="record.status_in_farm"
                >
                </simple-select>
            </div>
            <div class="col">
                <simple-select
                    id="status"
                    :label="__('Filtrare vaci după stare animal')"
                    :options="statuses"
                    v-model="record.animal_status"
                >
                </simple-select>
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
                    status_in_farm: null,
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
            farm_statuses()
            {
                return [
                    {
                        id: '',
                        text: this.__('Toate...'),
                    },
                    {
                        id: 'activ',
                        text: this.__('Activă'),
                    },
                    {
                        id: 'inactiv',
                        text: this.__('Inactivă'),
                    },
                ]
            },

            statuses()
            {
                return [
                    {
                        id: '',
                        text: this.__('Toate...'),
                    },
                    {
                        id: 'valid',
                        text: this.__('Valid'),
                    },
                    {
                        id: 'invalid',
                        text: this.__('Invalid'),
                    },
                    {
                        id: 'adaugat-ferma',
                        text: this.__('Adăugat de o fermă'),
                    },
                ]
            },
        },

        name: 'cows-filter-form'
    }
</script>