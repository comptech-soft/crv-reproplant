<template>
    <div v-if="animal && ! animal.loading" class="m-portlet__body">
        <div class="tab-content">
            
            <!-- Continut tab caracteristici -->
            <div v-if="current=='traits'" class="tab-pane active show" role="tabpanel">
                <animal-traits 
                    :animal="animal" 
                    @updated="$emit('updated')">
                </animal-traits>
            </div>

            <!-- Continut tab pedigree -->
            <div v-if="current=='pedigree'" class="tab-pane active show" role="tabpanel">
                <animal-pedigree 
                    :animal="animal"
                >
                </animal-pedigree>
            </div>

            <!-- Continut tab update -->
            <div v-if="current=='update'" class="tab-pane active show" role="tabpanel">
               Update
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            animal: {required: true},
            current: {required: true},
        },

        components: {
            'animal-traits': require('./~1~Traits'),
            'animal-pedigree': require('./Pedigree/Pedigree')
        }
    }
</script>
