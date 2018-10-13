<template>
    <div :class="portlet_class">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 v-if="caption" class="m-portlet__head-text">
                        {{ caption }}
                        <small v-if="subtitle">{{ subtitle }}</small>
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            
            <div v-if="portlet_options.has_progress" class="m-portlet__body-progress">
                Loading
            </div>

            <slot>
            </slot>
            
        </div>

        <div v-if="has_footer" class="m-portlet__foot">
            <div class="row align-items-center">
                <div class="col m--align-right">
                    <slot name="buttons">
                    </slot>
                    <span class="m--margin-left-10">
                        <button 
                            class="btn btn-outline-metal m-btn m-btn--icon"
                            @click="$router.go(-1)"
                        >
                            <span>
                                <i class="fa fa-times"></i>
                                <span>{{ __('Renunță') }}</span>
                            </span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            caption: {default: null},
            subtitle: {default: null},
            options: {default: null},
            has_footer: {default: false},
            defaultOptions: {default: () => {
                return {
                    has_progress: false,
                } 
            }}
        },

        data()
        {
            return {

            }
        },

        computed:
        {
            portlet_options()
            {
                return _.extend({}, this.defaultOptions, this.options)
            },

            portlet_class()
            {
                let r = {
                    'm-portlet': true,
                    'm-portlet--mobile': true, 
                }
                r['m-portlet--body-progress-'] = this.portlet_options.has_progress
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

        name: 'portlet'
    }
</script>