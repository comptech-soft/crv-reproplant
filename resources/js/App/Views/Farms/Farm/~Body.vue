<template>
    <div v-if="farm && ! farm.loading" class="m-portlet__body">
        <div class="tab-content">
            <div v-if="current=='data'" class="tab-pane active show" role="tabpanel">
                {{ farm }}
            </div>
            
            <div v-if="current=='users'" class="tab-pane active show" role="tabpanel">
                <farm-users :farm="farm"></farm-users>
            </div>

            <div v-if="current=='mulsori'" class="tab-pane active show" role="tabpanel">    
                <ore-mulsori :farm="farm"></ore-mulsori>
            </div>

            <div v-if="current=='sire'" class="tab-pane active show" role="tabpanel">    
                <farm-sires :farm="farm"></farm-sires>
            </div>

            <div v-if="current=='cow'" class="tab-pane active show" role="tabpanel">    
                <farm-cows :farm="farm"></farm-cows>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            farm: {required: true},
            current: {required: true},
        },

        components: {
            'ore-mulsori': require('./OreMulsori/OreMulsori'),
            'farm-users': require('./Users/Users'),
            'farm-cows': require('./Cows/Cows'),
            'farm-sires': require('./~5~Sires'),
            
        }
    }
</script>
