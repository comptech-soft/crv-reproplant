<template>
    <div :class="'m-portlet m-portlet--' + am.model.actions.color() + ' m-portlet--head-solid-bg m-portlet--bordered'">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i :class="am.model.actions.icon()"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        {{ am.model.actions.caption() }}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="javascript:void(0);" class="m-portlet__nav-link m-portlet__nav-link--icon" @click="$emit('close')">
                            <i class="la la-close"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div v-if="formManager" class="m-portlet__body">
            <slot name="box-action-slot"></slot>
        </div>

        <div class="m-portlet__foot">
            <button 
                type="button" 
                :class="'btn btn-' + am.model.actions.color() + (formManager && formManager.submitting ? ' m-loader m-loader--light m-loader--right' : '')"
                @click="onSubmit"
            >
                <i :class="am.model.actions.icon()"></i>
                {{am.model.actions.button()}}
            </button>
            
            <button 
                type="button" 
                class="btn btn-default pull-right" 
                @click="$emit('close')"
            >
                {{ __('Renunț') }}
            </button>
        </div>
    </div>
</template>

<script>

    /**
     * dt: Datatable Manager - vine de la Datatable Grid Page via props
     * am: Actions Manager - vine de la Datatable Grid Page via props
     * formManager: Action Form Manager - se instantiaza aici
     * record: se preia din $children[0]
     */

    import AppCore from 'comptechsoft-app-starter'

    export default {

        props: {

            /**
             * Datatable manager
             */

            dt: {required: true},
            /**
             * Actions manager
             */
            am: {required: true},
        },

        data(){
            return {
                formManager: null,
                record: null
            }
        },

        computed:
        {
            model()
            {
                return this.am ? this.am.model : null
            },

            errors()
            {
                return this.formManager ? this.formManager.errors : null
            },

            action()
            {
                return this.am ? this.am.action : null
            }
        },

        watch: {

            /**
             * Cand am errors in Form manager ==> le trimit spre Form Controls
             */
            errors: function(newErrors, oldErrors)
            {
                this.$children[0].errors = newErrors
            },

            /**
             * Cand am action in Actions Manager ==> le trimit spre Form Controls
             */
            action: function(newAction, oldAction)
            {
                this.$children[0].action = newAction
                if( newAction == 'insert' )
                {
                    this.resetRecord()
                }
            }
        },

        methods: {

            /**
             * Reset the record after insert|update|delete
             * -------------------------------------------
             * Se apeleaza callback onSucces in in onClickSubmit de la Action Form Manager
             * --------------------------------------------
             * 1) In this.model.fields am valorile default
             * 2) In this.record am recordul activ
             * Reset the errors. Pun si erorile pe null
             */
            resetRecord()
            {
                console.log('RESET');
                _.map(this.record, (value, field) => {

                    console.log(field + '=' + value)
                    if( this.model.fields.hasOwnProperty(field) )
                    {
                        this.record[field] = this.model.fields[field].value
                    }
                })
                this.formManager.errors = null
            },

            onSubmit()
            {
                /**
                 * Se transmit rules = regulile de validare
                 * Acestea sunt definite in model
                 */
                this.formManager.onClickSubmit(this.model.rules[this.am.action].rules)
            }
        },

        mounted()
        {
            this.formManager = new AppCore.ActionFormManager('grid-action-form', this)
            let i = setInterval( () => {
                if(this.$children.length)
                {
                    clearInterval(i)
                    /**
                     * Aici iau recordul din formularul specific
                     * Acolo definesc explicit campurile.
                     * Sa nu uitam de id
                     */
                    this.record = this.$children[0].record
                    // console.log('Action::mounted()');
                    // console.log('Sunt in: ' + this.$options._componentTag + ' (' + this.$options.__file  + ')')
                    // console.log('Childern[0]: ' + this.$children[0].$options._componentTag + ' (' + this.$children[0].$options.__file  + ')')
                    _.map(this.record, (value, field) => {
                        // console.log(field + ' == ' + value)
                    })
                }
            }, 100) 
        }

    }
</script>
