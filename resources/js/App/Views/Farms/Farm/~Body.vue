<template>
    <div v-if="farm && ! farm.loading" class="m-portlet__body">
        <div class="tab-content">
            <div v-if="current=='data'" class="tab-pane active show" role="tabpanel">
                {{ farm}}
            </div>
            
            <div v-if="current=='users'" class="tab-pane active show" role="tabpanel">
                <farm-users :farm="farm"></farm-users>
            </div>

            <div v-if="current=='mulsori'" class="tab-pane active show" role="tabpanel">    
                <ore-mulsori :farm="farm"></ore-mulsori>
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
            'ore-mulsori': require('./~3~OreMulsori'),
            'farm-users': require('./~2~Users')
        }
    }
</script>
