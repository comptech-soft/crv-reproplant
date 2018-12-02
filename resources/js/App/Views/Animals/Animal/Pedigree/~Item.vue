<template>
    <div class="animal-item-container">
        <div v-if="animal != null" :class="'animal-item-header animal-item-' + variant">
            <img :src="$app.url + 'img/icons/' + animal.animal_status + '.png'" />
            {{ title }} 
        </div>
        <table v-if="animal != null" class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <td class="caption">{{__('Nume')}}</td>
                    <td class="value">
                        <a style="font-weight:bold; cursor:pointer" @click="openAnimal(animal)">
                            {{ animal.long_name }}
                        </a>
                    </td>
                </tr>
                <tr v-for="(cell, index) in cells[animal.gender]" :key="'cell-' + index">
                    <td class="caption">{{ __(cell.caption) }}</td>
                    <td class="value" v-html="cell.value(animal)"></td>
                </tr>
            </tbody>
        </table>
        <table v-else class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="height:102px; text-align:center; vertical-align:middle; border:none; border-top: 1px solid #cccccc; color: #f4516c; font-size: 13px">
                        <i class="flaticon-questions-circular-button"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    const birthDate = (v, record) => {
        if( ! record.birth_date )
        {
            return null
        }
        return v.datetime.setFormat('DD.MM.YYYY', record.birth_date) + ' (' + record.age + ')'
    }
    const Rasa = record => {
        let r = []
        if(record.breed)
        {
            r.push(record.breed)
        }
        if(record.breed_composition)
        {
            r.push(record.breed_composition)
        }
        return r.join(', ')
    }
    const Color = record => {
        let r = []
        if(record.color)
        {
            r.push(record.color)
        }
        return r.join(', ')
    }
    const Company = record => {
        let r = []
        if(record.company_id)
        {
            r.push(record.company_id)
        }
        return r.join(', ')
    }
    const animalStatus = record => {
        let statuses = {
            'adaugat-ferma' : {
                caption: 'AF',
                color: 'warning',
            },
            'valid': {
                caption: 'V',
                color: 'success',
            },
            'invalid': {
                caption: 'IV',
                color: 'danger',
            },
            'inactiv': {
                caption: 'IA',
                color: 'danger',
            }
        }
        if(record.animal_status)
        {
            if(statuses.hasOwnProperty(record.animal_status))
            {
                return '<span style="min-height:11px; height:11px; line-height:11px;" class="m-badge m-badge--' + statuses[record.animal_status].color + '">' + statuses[record.animal_status].caption + '</span>'
            }
            return record.animal_status
        }
        return '?'
    }

    export default {
        props: {
            animal: {required: true},
            title: {required: true},
            variant: {default: ''}
        },
        
        data() {
            return {
                cells: {
                    male: [
                        // {caption: 'Nume', value: record => record.long_name},
                        {caption: 'Nume scurt', value: record => record.short_name},
                        {caption: 'Cod interbull', value: record => record.interbull_code},
                        {caption: 'Număr matricol', value: record => record.matricol_number},
                        // {caption: 'Cod Ro', value: record => record.cod_ro},
                        // {caption: 'NAAB', value: record => record.naab},
                        {caption: 'Data nașterii', value: record => birthDate(this, record) },
                        {caption: 'Rasa', value: record => Rasa(record)},
                        // {caption: 'Culoare', value: record => Color(record)},
                        // {caption: 'Firma', value: record => Company(record)},
                        // {caption: 'Stare animal', value: record => animalStatus(record) },
                    ],

                    female: [
                        // {caption: 'Nume', value: record => record.long_name},
                        // {caption: 'Nume scurt', value: record => record.short_name},
                        // {caption: 'Cod interbull', value: record => record.interbull_code},
                        {caption: 'Număr matricol', value: record => record.matricol_number},
                        // {caption: 'Cod Ro', value: record => record.cod_ro},
                        // {caption: 'NAAB', value: record => record.naab},
                        {caption: 'Data nașterii', value: record => birthDate(this, record) },
                        // {caption: 'Rasa', value: record => Rasa(record)},
                        // {caption: 'Culoare', value: record => Color(record)},
                        // {caption: 'Firma', value: record => Company(record)},
                        // {caption: 'Stare animal', value: record => animalStatus(record) },
                    ]
                }
            }
        },

        methods: {
            openAnimal(animal) {
                this.$router.push({
                    name: 'animal',
                    params: {
                        id: animal.id,
                        current: 'pedigree'
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .animal-item-container {
        margin: 0;
        padding: 0;
        width: 100%;
        border: none;
        table {
            width: 100%;
            margin: 0;
            padding: 0;
            border: none;
            tr {
                margin: 0;
                padding: 0;
                td {
                    padding: 0.1rem;
                    font-size: 10px;
                    border-color: #ededed;
                    color: #333333;
                }
                td.caption {
                    border-left: none;
                }
                td.value {
                    border-right: none;
                }
            }
        }
        .animal-item-header {
            color: #ffffff;
            padding: 0px 6px;
            font-weight: bold;
        }
        .animal-item-blue {
            background-color: #4B8DF8;
        }
        .animal-item-green {
            background-color: #44b6ae;
        }
        .animal-item-red {
            background-color: #E26A6A;
        }
    }
</style>
