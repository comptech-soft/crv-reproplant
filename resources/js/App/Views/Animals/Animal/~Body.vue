<template>
    <div v-if="animal && ! animal.loading" class="m-portlet__body">
       <div class="tab-content">
            <div v-if="current=='traits'" class="tab-pane active show" role="tabpanel">
                <animal-traits 
                    :animal="animal" 
                    @updated="$emit('updated')">
                </animal-traits>
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
            'animal-traits': require('./~1~Traits')
        }
    }
</script>
