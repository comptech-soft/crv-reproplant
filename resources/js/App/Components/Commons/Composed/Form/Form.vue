<template>
    <form :class="form_class">
        
        <div class="row" v-if="formManager.result">
            <div class="col">
                <alert-box
                    type="alert-danger"
                    :content="formManager.result.message"
                >
                </alert-box>
            </div>
        </div>

        <div class="row">
            <div v-if="getting_record" class="col text-center">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
        
        <div v-if="! getting_record" class="row">
            <div class="col">
                <slot>
                </slot>
            </div>
        </div>

    </form>
</template>

<script>
    export default
    {
        props:
        {
            formClass: {default: null},
            formManager: {default: null},
            getting_record: {default: false},
        },

        data()
        {
            return {

            }
        },

        computed:
        {
            form_class()
            {
                return this.makeClass('formClass', {
                    'm-form': true
                })
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

        name: 'from-box'
    }
</script>