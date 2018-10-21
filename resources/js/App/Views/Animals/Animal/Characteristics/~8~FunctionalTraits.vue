<template>
    <div 
        class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics" 
        style="margin-bottom:10px"
    >
        
        <characteristic-head :caption="__('Functional traits')">
        </characteristic-head>
        
        <characteristic-body
            :items="filtered"
            :has_numbers="true"
            :has_percents="true"
            :has_progress="true"
        >
        </characteristic-body>
    
    </div>
</template>

<script>
    export default {
        props: {
            characteristics: {required: true},
            animal: {required: true},
        },

        computed: {
            filtered()
            {
                return _.filter(this.characteristics, item => item.parameter.category == 'functional-traits')
            }
        },

        components: {
            'characteristic-head': require('./../Elements/CharacteristicHead'),
            'characteristic-body': require('./../Elements/CharacteristicBody'),
        }
    }
</script>
