<template>
    <div 
        :class="alert_class" 
        role="alert"
    >
        <strong 
            v-if="title"
        >
            {{ title }}
        </strong> 
        
        <div
            v-if="content"
            v-html="content"
        >
        </div>

        <slot>
        </slot>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            type: {default: ''},
            title: {default: ''},
            content: {default: ''},
        },

        data()
        {
            return {

            }
        },

        computed:
        {
            alert_class()
            {
                //alert m-alert--default
                let r = {
                    alert: true,
                }
                r[this.type] = true
                return r
            }
        },

        methods:
        {

        },

        mounted()
        {

        },

        created()
        {

        },

        components:
        {

        },

        mixins:
        [

        ],

        name: 'alert-box'
    }
</script>
