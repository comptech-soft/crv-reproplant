<template>
    <div class="m-portlet m-portlet--bordered m-portlet--unair">
        <div class="m-portlet__head" style="background: transparent; border-color: #ebedf2">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text" style="color: #666666">
                        <i class="la la-upload"></i>
                        {{ __('Import tauri din fișier excel') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="file-loading"> 
                    <input id="excel-file" name="excel-file" type="file" multiple />

                </div>
            </form>
        </div>
        <div class="m-portlet__foot">
            <button type="submit" class="btn btn-primary">
                {{ __('???') }}
            </button>
            <span class="m--margin-left-10">
                <a class="m-link m--font-bold" @click.prevent="$emit('close')">{{ __('Renunță') }}</a>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
                instance: null,
            }
        },
        methods: {
            init() {
                let i = setInterval( () => {
                    if( $('#excel-file').length == 1 )
                    {
                        clearInterval(i)
                        let token = $('meta[name="csrf-token"]').attr('content')
                        this.instance = $('#excel-file').fileinput({
                            theme: "fa",
                            maxFileCount: 1,
                            showPreview: false,
                            uploadExtraData: {
                                '_token': token
                            },
                            uploadUrl: this.$app.url + 'farms/import/sires-upload',
                            allowedFileExtensions: ['xls', 'xslx']
                        });
                    }
                }, 100)
            }
        },

        mounted() {
            this.init()
        }
    }
</script>
