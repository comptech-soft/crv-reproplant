<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }}
        </label>

        <textarea 
            :id="id"
            :class="form_control_class" 
            :placeholder="placeholder" 
            :maxlength="maxlength" 
            :name="get_control_name"
            :disabled="disabled"
        >{{value}}</textarea>

        <error-label
            v-if="error_to_string"
            :error="error_to_string"
        >
        </error-label>
    </div>
</template>

<script>
    export default
    {
        data()
        {
            return {
                instance: null,
            }
        },

        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 

            require('./~Props'),
            require('./~Computed'),  
        ],

        watch: {
            disabled: function(newDisabled, oldDisabled)
            {
                if(newDisabled)
                {
                    this.instance.summernote('disable');
                }
                else
                {
                    this.instance.summernote('enable');
                }
            },
        },

        methods: {
            init()
            {
                let v = this
                if(! this.instance)
                {
                    this.instance = $('textarea#' + this.id).summernote({
                        height: this.height,
                        minHeight: null,             
                        maxHeight: null,         
                        focus: true,             
                    }).on('summernote.change', function(we, contents, $editable){                        
                        if( $('textarea#' + this.id).summernote('isEmpty') )
                        {
                            v.$emit('input', '')
                        }
                        else
                        {
                            v.$emit('input', contents)
                        }
                    })
                    this.instance.summernote('code', v.value)
                    if( v.disabled )
                    {
                        this.instance.summernote('disable');
                        // sn.parent().find('.note-toolbar-wrapper').hide();
                    }
                }
            }
        },

        mounted(){
            let i = setInterval( () => {
                if( $('textarea#' + this.id).length == 1)
                {
                    clearInterval(i)
                    this.init()
                }
            }, 100)
        },

        name: 'summernote-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>