<template>
    <div :class="form_group_class">
        <label
            v-if="label"
            :for="id"
            class="cs-label"
        >
            {{ label }} 
            <i v-if="loading" class="fa fa-spinner fa-spin"></i>
        </label>

        <select
            v-if="! loading"
            :class="inputClass"
            :id="id"
            :value="value"
            style="width: 100%; font-family:Poppins"
            @change="$emit('change', $event.target.value)"
        >
			<option v-for="option in get_options" :value="option.id" :key="'option-' + option.id">
                {{ option.text }}
            </option>
		</select>

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
        props: {
            help: {default: ''},
            disabled: {default: false},
            // initialSelectOptions: {default: () => []},
            defaultPluginOptions: {default: () => {
                return {
                    allowClear: true,
                    escapeMarkup: markup => markup,
                    minimumInputLength: 2,
                    ajax: {}
                }
            }},
            selectable: {required: true},
            selected: {default: null},
            label: {type: String, default: ''},
            inputClass: {type: Object, default: () => {
                return {
                    'form-control': true,
                    'm-select2': true,
                }
            }},
        },

        model:
        {
            prop: 'value',
            event: 'change'
        },
        
        data()
        {
            return {
                loading: false,
                options: [],
                instance: null,
            }
        },

        methods: {
            onChange(e) {
                this.$emit('input', e.target.value ? e.target.value : null)
            },

            init() {
                let v = this
                this.instance = $('#' + this.id).select2(this.plugin_options)
                this.instance.on('select2:select', function(e) {
                    v.$emit('change', e.params.data.id)
                    v.$emit('selected', e.params.data)
                })
                this.instance.on('select2:unselect', function(e){
                    v.$emit('change', null)
                    v.$emit('selected', null)
                    let s = v.instance.data('select2')
                    var opts = s.options;
                    v.setDisabled(true)
                    setTimeout(function() {
                        v.setDisabled(false)
                    }, 10);
                })
                this.instance.on('select2:open', function(params){
                    let s = v.instance.data('select2')
                    s.results.clear();
                    s.dropdown._resizeDropdown();
                    s.dropdown._positionDropdown();
                });
                if( this.selected )
                {
                    let newOption = new Option(this.selected.text, this.selected.id, false, false);
                    this.instance.append(newOption).trigger('change');
                }
                this.setDisabled(this.disabled)
            },

            setDisabled(flag) {
                if( this.timeout )
                {
                    clearTimeout(this.timeout)
                }
                this.timeout = setTimeout( () => {
                    let s = this.instance.data('select2').options
                    let jq = $('#' + this.id).parent().find('span.select2')
                    s.set('disabled', flag);
                    if( ! flag )
                    {
                        jq.removeClass('select2-container--disabled')
                        $('#' + this.id).prop('disabled', false)
                    }
                    else
                    {
                        jq.addClass('select2-container--disabled')
                        $('#' + this.id).prop('disabled', true)
                    }
                }, 5)
            }
        },

        watch: {
            'disabled': function(newDisabled, oldDisabled) {
                this.setDisabled(newDisabled)
            },

            selected: function(newSelected, oldSelected) {
                if( newSelected == null)
                {
                    let jq = $('#' + this.id)
                    let t = setTimeout(() => {
                        // console.log('Tre sa curat lista ');
                        // jq.empty()
                        jq.val(null).trigger('change.select2')
                    }, 10)
                }
            }
        },

        mounted() {
            let i = setInterval(() => {
                if( $('#' + this.id).length == 1)
                {
                    clearInterval(i)
                    this.init()
                }
            }, 10)
        },

        computed: {
            
            get_options() {
                if( this.selected )
                {
                    return [this.selected]
                }
                return [];
            },
            
            plugin_options() {
                let v = this, r = this.defaultPluginOptions

                r.disabled = this.disabled

                r.placeholder = this.selectable.placeholder
                r.dropdownParent = $('#' + this.id).parent()
                r.templateResult = this.selectable.templateResult
                r.templateSelection = this.selectable.templateSelection

                r.ajax.delay = 250
                r.ajax.url = 'api/get-options-items'
                r.ajax.cache = false
                r.ajax.dataType = 'json'
                r.ajax.processResults = this.selectable.processResults

                r.ajax.data = function(params) {
                    var q = {
                        searched: params.term,
                        source_type: 'search',
                        model: v.selectable.model,
                        search_by: v.selectable.search_by,
                        order_by: v.selectable.order_by,
                        filter_by: v.selectable.filter_by,
                    }
                    return q;
                }
                return r
            },
        },

        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./../~Mixins/~Components'), 
        ],

        name: 'two-select-box'
    }
</script>

<style lang="scss" scoped>
    .cs-label
    {
        margin-bottom: 0;
        margin-top: 0;
    }
</style>