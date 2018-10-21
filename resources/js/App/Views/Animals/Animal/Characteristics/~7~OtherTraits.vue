<template>
    <div 
        class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics" 
        style="margin-bottom:10px"
    >
        
        <characteristic-head :caption="__('Other Infos')">
        </characteristic-head>
        
        <characteristic-body
            :items="filtered"
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
                return _.filter(this.characteristics, item => item.parameter.category == 'other-traits')
            }
        },

        components: {
            'characteristic-head': require('./../Elements/CharacteristicHead'),
            'characteristic-body': require('./../Elements/CharacteristicBody'),
        }
    }
</script>
>