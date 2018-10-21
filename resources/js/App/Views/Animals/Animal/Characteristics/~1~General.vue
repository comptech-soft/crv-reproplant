<template>
    <div 
        class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet-characteristics" 
        style="margin-bottom:10px"
    >

        <characteristic-head 
            :caption="__('General infos')"
        >
        </characteristic-head>
        
        <characteristic-body
            :items="filtered"
        >
            <template slot="body-before">
                <tr class="m-table__row--active">
                    <td class="cell cell-caption">{{ __('Nume') }}</td>
                    <td class="cell">{{ animal.long_name}}</td>
                </tr>
                <tr class="m-table__row--active">
                    <td class="cell cell-caption">{{ __('Nume scurt') }}</td>
                    <td class="cell">{{ animal.short_name}}</td>
                </tr>
            </template>
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
                return _.filter(this.characteristics, item => item.parameter.category == 'general')
            }
        },

        components: {
            'characteristic-head': require('./../Elements/CharacteristicHead'),
            'characteristic-body': require('./../Elements/CharacteristicBody'),
        }
    }
</script>