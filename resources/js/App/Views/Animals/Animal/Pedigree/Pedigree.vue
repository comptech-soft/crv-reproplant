<template>
    <div class="pedigree-container">

        <div class="col-pedigree col-animal">
            <div class="one-height"></div>
            <div class="half-height"></div>
            <div class="one-separator"></div>
            <div class="half-separator"></div>
            <div class="animal-item animal-item-current">
                <pedigree-item 
                    :animal="animal"
                    :title="__(animal.gender ? 'Taur' : 'Vacă')"
                    variant="blue"
                >
                </pedigree-item>
            </div>
        </div>
        
        <div class="col-pedigree col-separator">
            <div class="one-height"></div>
            <div class="one-separator"></div>
            <div class="half-separator"></div>
            <div class="bottom-bordered one-height"></div>
        </div>

        <div class="col-pedigree col-separator">
            <div class="bottom-bordered one-height-half-separator"></div>
            <div class="left-bordered one-height-one-separator"></div>
            <div class="left-bordered bottom-bordered one-height-one-separator"></div>
        </div>

        <div class="col-pedigree col-animal">
            <div class="half-height-half-separator"></div>
            <div class="animal-item animal-item-father">
                <pedigree-item 
                    :animal="animal.father"
                    :title="__('Tatăl')"
                    variant="green"
                >
                </pedigree-item>
            </div>
            <div class="one-height-half-separator"></div>
            <div class="one-separator"></div>
            <div class="half-separator"></div>
            <div class="animal-item animal-item-mother">
                <pedigree-item 
                    :animal="animal.mother"
                    :title="__('Mama')"
                    variant="red"
                >
                </pedigree-item>
            </div>
        </div>

        <div class="col-pedigree col-separator">
            <div class="bottom-bordered one-height-half-separator"></div>
            <div class="bottom-bordered two-height-two-separator"></div>
        </div>

        <div class="col-pedigree col-separator">
            <div class="bottom-bordered half-height"></div>
            <div class="left-bordered one-height-one-separator"></div>
            <div class="top-bordered half-height"></div>
            <div class="bottom-bordered half-height-one-separator"></div>
            <div class="left-bordered bottom-bordered one-height-one-separator"></div>
        </div>

        <div class="col-pedigree col-animal">
            <div class="animal-item animal-item-father">
                <pedigree-item 
                    :animal="animal.father ? animal.father.father : null"
                    :title="__('Bunicul patern')"
                    variant="green"
                >
                </pedigree-item>
            </div>

            <div class="vertical-separator">
            </div>

            <div class="animal-item animal-item-father">
                <pedigree-item 
                    :animal="animal.father ? animal.father.mother : null"
                    :title="__('Bunica paternă')"
                    variant="green"
                >
                </pedigree-item>
            </div>
            
            <div class="vertical-separator">
            </div>

            <div class="animal-item animal-item-mother">
                <pedigree-item 
                    :animal="animal.mother ? animal.mother.father : null"
                    :title="__('Bunicul matern')"
                    variant="red"
                >
                </pedigree-item>
            </div>

            <div class="vertical-separator">
            </div>

            <div class="animal-item animal-item-mother">
                <pedigree-item 
                    :animal="animal.mother ? animal.mother.mother : null"
                    :title="__('Bunica materna')"
                    variant="red"
                >
                </pedigree-item>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        props: {
            animal: {required: true}
        },

        methods: {
            // openAnimal(animal) {
            //     this.$router.push({
            //         name: 'animal',
            //         params: {
            //             id: animal.id,
            //             current: 'pedigree'
            //         }
            //     })
            // }
        },
        
        components: {
            'pedigree-item': require('./~Item')
        }
    }
</script>

<style lang="scss" scoped>

    $animal-width: 30%;
    $separator-width: (100% - 3 * $animal-width)/4;

    $animal-height: 128px;
    $vertical-separator-height: 6px;

    $border-color: #cccccc;

    div.col-pedigree {
        float: left;
    }

    .one-height {
        height: $animal-height;
    }
    .half-height {
        height: $animal-height/2;
    }
    .one-separator {
        height: $vertical-separator-height;
    }
    .half-separator {
        height: $vertical-separator-height/2;
    }
    .half-height-half-separator {
        height: $animal-height/2 + $vertical-separator-height/2;
    }
    .one-height-one-separator {
        height: $animal-height + $vertical-separator-height;
    }
    .half-height-one-separator {
        height: $animal-height/2 + $vertical-separator-height;
    }
    .one-height-half-separator {
        height: $animal-height + $vertical-separator-height/2;
    }
    .two-height-two-separator {
        height: 2 * $animal-height + 2 * $vertical-separator-height;
    }

    div.col-animal {
        width: $animal-width;
        .animal-item {
            border:1px solid $border-color; 
            height: $animal-height;
            overflow-x: hidden;
            overflow-y: hidden;
        }
        .animal-item-current {
            border: 1px solid #4B8DF8;
        }
        .animal-item-father {
            border: 1px solid #44b6ae;
        }
        .animal-item-mother {
            border: 1px solid #E26A6A;
        }
        .vertical-separator {
            height: $vertical-separator-height;
        }
    }

    div.col-separator {
       
        width: $separator-width;
        .bottom-bordered {
            border-bottom: 1px solid $border-color;
        }
        .top-bordered {
            border-top: 1px solid $border-color;
        }
        .left-bordered {
            border-left: 1px solid $border-color;
        }

        
        
    }
</style>


