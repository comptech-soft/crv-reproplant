<template>
    <div class="m-widget3__body">
        <div class="row">
            <div class="col">
                <animal-short 
                    :caption="__('Sire')" 
                    :animal="cow.animal.father"
                >
                </animal-short>
                <div class="row">
                    <div class="col">
                        <animal-short 
                            :caption="__('Paternal Grand Sire')" 
                            :animal="cow.animal.father ? cow.animal.father.father : null"
                        >
                        </animal-short>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <animal-short 
                            :caption="__('Paternal Grand Dam')" 
                            :animal="cow.animal.father ? cow.animal.father.mother : null"
                        >
                        </animal-short>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cow: {required: true}
        },

        components: {
            'animal-short': require('./../../../Animals/Animal/Elements/AnimalShort')
        }
    }
</script>
