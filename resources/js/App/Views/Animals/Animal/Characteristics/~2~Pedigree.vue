<template>
    <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics">
        <characteristic-head :caption="__('Pedigree')">
        </characteristic-head>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col">
                    <animal-short 
                        :caption="__('Sire')" 
                        :animal="animal.father"
                    >
                    </animal-short>
                    <div class="row">
                        <div class="col">
                            <animal-short 
                                :caption="__('Paternal Grand Sire')" 
                                :animal="animal.father ? animal.father.father : null"
                            >
                            </animal-short>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <animal-short 
                                :caption="__('Paternal Grand Dam')" 
                                :animal="animal.father ? animal.father.mother : null"
                            >
                            </animal-short>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <animal-short 
                        :caption="__('Dam')" 
                        :animal="animal.mother"
                    >
                    </animal-short>
                    <div class="row">
                        <div class="col">
                            <animal-short 
                                :caption="__('Maternal Grand Sire')" 
                                :animal="animal.mother ? animal.mother.father : null"
                            >
                            </animal-short>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <animal-short 
                                :caption="__('Maternal Grand Dam')" 
                                :animal="animal.mother ? animal.mother.mother : null"
                            >
                            </animal-short>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            characteristics: {required: true},
            animal: {required: true},
        },

        components: {
            'animal-short': require('./../Elements/AnimalShort'),
            'characteristic-head': require('./../Elements/CharacteristicHead'),
        }
    }
</script>

<style lang="scss" scoped>
    @import "./../Sass/characteristics.scss";
</style>