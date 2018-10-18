<template>
    <div class="dt-filter-container">
        <div class="row">
            <div class="col">
                <simple-select
                    id="status"
                    :label="__('Filtrare după stare animal')"
                    :options="statuses"
                    v-model="record.animal_status"
                >
                </simple-select>
            </div>
            <div class="col">
                <simple-select
                    id="company_id"
                    :label="__('Filtrare după firmă')"
                    :ajax="ajax_companies"
                    no_selection_text="Toate..."
                    v-model="record.company_id"
                >
                </simple-select>
            </div>
            <div class="col">
                <simple-select
                    id="breed_id"
                    :label="__('Filtrare după rasă')"
                    :ajax="ajax_breeds"
                    no_selection_text="Toate..."
                    v-model="record.breed_id"
                >
                </simple-select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                record: {
                    animal_status: null,
                    company_id: null,
                    breed_id: null,
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
                    {
                        id: 'inactiv',
                        text: this.__('Inactiv'),
                    }
                ]
            },

            ajax_companies()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Companies\\Company',
                        order_by: {field: 'companies.name', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'name'}
                }
            },

            ajax_breeds()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\App\\Models\\Animals\\Breeds\\Breed',
                        order_by: {field: 'breeds.breed', dir: 'asc'},
                    },
                    map: {id: 'id', text: 'breed'}
                }
            },
        },

        name: 'animals-filter-form'
    }
</script>