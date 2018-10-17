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
                let r = {
                    alert: true,
                    'alert-dismissible': true,
                    'm-alert': true, 
                    'm-alert--air': true, 
                    'm-alert--outline': true,
                }
                r[this.type] = true
                return r
            }
        },

        name: 'alert-box'
    }
</script>
