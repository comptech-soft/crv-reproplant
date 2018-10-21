<template>
    <div v-if="animal">
        <div class="m-alert m-alert--icon alert alert-info m-alert--square m-alert--outline" role="alert">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                <strong>{{ __('Atenție') }}.</strong> 
                {{ __('Aici se vizualizează caracteristicile animalului :nume:.', {nume: animal.long_name || animal.short_name}) }}
            </div>
            <div class="m-alert__actions" style="width: 160px;">
                <button type="button" class="btn btn-warning btn-sm m-btn m-btn--wide" @click="updateAll">
                    {{ __('Actualizează caracteristicile') }}
                    <i v-if="updateing" class="fa fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div v-if="loading" class="m-loader m-loader--brand text-center" style="width: 100%;">
                </div>
                <traits-body 
                    :calculation_bases="calculation_bases" 
                    :animal="animal"
                    :current="current"
                    :characteristics="current_characteristics"
                    @current="onChangeBaseCalculation"
                ></traits-body>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            animal: {required: true},
        },

        data(){
            return {
                updateing: false,
                loading: false,
                characteristics: [],
                calculation_bases: [
                    {
                        id: 'Z',
                        text: 'Black and White',
                        active: true,
                    },
                    {
                        id: 'R',
                        text: 'Red and white',
                        active: false,
                    },
                    {
                        id: 'Y',
                        text: 'Dual purpose',
                        active: false,
                    },
                    {
                        id: 'B',
                        text: 'Belgian blue',
                        active: false,
                    }
                ]
            }
        },

        methods: {

            onChangeBaseCalculation(current)
            {
                _.forEach(this.calculation_bases, item => {item.active = (item.id == current)})
            },

            update(index)
            {
                if( index <= this.calculation_bases.length - 1)
                {
                    this.post('animals/crv4-all-import', {
                        interbull_code: this.animal.interbull_code,
                        calculation_base: this.calculation_bases[index].id,
                    }, data => {
                        if(data.success)
                        {
                            this.notySuccess(this.calculation_bases[index].text + ': ' + data.result.message)
                            this.update(index + 1)
                        }
                        else
                        {
                            this.notyError(data.result.message)
                            this.update(this.calculation_bases.length)
                        }
                    })
                }
                else
                {
                    this.updateing = false
                    this.$emit('updated')
                    this.getAnimalTraits()
                }
            },

            /**
             * Preia informatiile despre animal de pe https://apps.crv4all.com
             */
            updateAll()
            {
                this.updateing = true
                this.update(0)
            },

            getAnimalTraits()
            {
                this.loading = true
                this.post('animals/get-animal-characteristics', {animal_id: this.animal.id}, data => {
                    this.loading = false
                    this.characteristics = data
                })
            },

        },

        watch: {
            'animal.id': {
                handler: function(newAnimalId, oldAnimalId)
                {
                    // console.log(oldAnimalId + '>>>>' + newAnimalId)
                    if(newAnimalId != oldAnimalId)
                    {
                        this.updateAll()
                    }
                },
                deep: true,
            }
        },

        mounted()
        {
            this.updateAll()
        },

        computed: {
            current()
            {
                let item = _.find(this.calculation_bases, item => item.active)
                return item.id
            },

            current_characteristics()
            {
                return _.filter(this.characteristics, item => {
                    return (item.calculation_base == null) || (item.calculation_base == this.current);
                })
            }
        },

        components: {
            'traits-body': require('./~1~1~Body')
        }
    }
</script>