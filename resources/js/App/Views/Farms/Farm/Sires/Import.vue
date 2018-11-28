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
            
            <div class="m-alert m-alert--outline alert alert-success" role="alert">
                <strong>
                    {{ __('Atenție') }}! 
                    {{ __('Reguli pentru importul taurilor dintr-un fișier Excel') }}
                </strong>
                <br/><br/>
                #1. {{ __('Fișierul trebuie să aibă lista taurilor în primul sheet.') }}<br/>
                #2. {{ __('Antetul listei va fi pe rândul 1 începând din celula A și va avea obligatoriu continutul: nume, nume_lung, cod_interbull, crotalie, naab, cod_ro.') }}<br/>
                #3. {{ __('Taurii vor fi scriși începund din râdndul 2.') }}<br/>
                #4. {{ __('Este obligatoriu de completat coloana A (nume). Coloana B (nume lung) este opțională.') }}<br/>
                #5. {{ __('Este obligatoriu să se completeze doar una din valorile din coloanele C (cod_interbul), D  (crotalie), E (naab), F (cod_ro).') }}
            </div>

            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="file-loading"> 
                    <input id="excel-file" name="excel-file" type="file" multiple />
                </div>
            </form>

            <div v-if="uploading" style="margin:10px auto; display:block" class="m-spinner m-spinner--brand m-spinner--lg"></div>

            <div v-if="file" style="margin-top:20px">

                <div v-if="!is_valid_file" class="alert alert-danger" role="alert" style="margin:10px 0px 5px 0px">
                    <strong>{{ __('Fișierul nu respectă condițiile.') }}</strong>
                    <br/>
                    {{ __('Antetul nu este corect sau informațiile din rânduri nu sunt corecte.') }}
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="cell-import cell-import-header">#</td>
                            <td class="cell-import cell-import-header" v-for="(col, indexCol) in file.columns" :key="'col-' + indexCol">
                                {{ col }}
                            </td>
                            <td class="cell-import cell-import-header">
                                {{ __('Importat') }}
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            v-for="(row, index) in details" 
                            :key="'row-' + index" 
                            :class="{
                                'row-failed': row.finished && ! row.imported,
                                'row-success': row.finished && row.imported
                            }"
                        >
                            <td class="cell-import">{{ index + 1 }}.</td>
                            <td class="cell-import" v-for="(col, indexCol) in row.columns" :key="'col-' + index + '-' + indexCol">
                                {{ col }}
                            </td>
                            <td class="cell-import text-center">
                                {{row.imported ? __('Da') : __('Nu')  }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="m-portlet__foot">
            <button 
                :disabled="!is_valid_file || ! details.length" 
                type="submit" 
                class="btn btn-primary" 
                @click="loadIntoTable"
            >
                {{ __('Importă') }}
            </button>
            <span class="m--margin-left-10">
                <a class="m-link m--font-bold" @click.prevent="$emit('close')">{{ __('Renunță') }}</a>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        
        props: {
            farm: {required: true},
        },

        data() {
            return {
                instance: null,
                file: null,
                details: [],
                uploading: false,
                is_valid_file: false,
            }
        },
        
        methods: {
            reset() {
                this.file = null
                this.details = []
                this.is_valid_file = false
                this.uploading = false
            },

            init() {
                let v = this, i = setInterval( () => {
                    if( $('#excel-file').length == 1 )
                    {
                        clearInterval(i)
                        let token = $('meta[name="csrf-token"]').attr('content')
                        this.instance = $('#excel-file').fileinput({
                            theme: "fa",
                            maxFileCount: 1,
                            showPreview: false,
                            uploadExtraData: {
                                '_token': token,
                                'farm_id': this.farm.id,
                                'type': 'sire',
                            },
                            uploadUrl: this.$app.url + 'farms/import/sires-upload',
                            allowedFileExtensions: ['xls', 'xlsx']
                        }).on('fileuploaded', function(event, data, previewId, index) { 
                            let response = data.response
                            if(response.success)
                            {
                                v.file = response.result.payload.import
                                v.details = response.result.payload.details
                                v.checkValidity()
                                v.uploading = false
                            }
                            else
                            {
                                this.notyError(response.result.message)
                                v.reset()
                            }
                        }).on('filepreajax', function(event, previewId, index) {
                            v.uploading = true
                        }).on('fileclear', function(event) {
                            v.reset()
                        }).on('fileuploaderror', function(event, data, msg) {
                            // var form = data.form, files = data.files, extra = data.extra,
                            //     response = data.response, reader = data.reader;
                            console.log('File upload error');
                            // get message
                            // alert(msg);
                        }).on('fileselectnone', function(event) {
                            console.log("Huh! No files were selected.");
                        }).on('fileerror', function(event, data, msg) {
                            // console.log(data.id);
                            // console.log(data.index);
                            // console.log(data.file);
                            // console.log(data.reader);
                            // console.log(data.files);
                            // // get message
                            // alert(msg);
                        }).on('filebatchuploaderror', function(event, data, msg) {
                            // var form = data.form, files = data.files, extra = data.extra,
                            // response = data.response, reader = data.reader;
                            console.log('File batch upload error');
                            // get message
                            // alert(msg);
                        }).on('filelock', function(event, filestack, extraData) {
                            var fstack = filestack.filter(function(n){ return n != undefined });
                            console.log('Files selected (filelock)- ' + fstack.length);
                        }).on('fileunlock', function(event, filestack, extraData) {
                            var fstack = filestack.filter(function(n){ return n != undefined });
                            console.log('Files selected (fileunlock) - ' + fstack.length);
                        }).on('filebatchuploadcomplete', function(event, files, extra) {
                            console.log('File batch upload complete', files);
                            v.uploading = false
                        });
                    }
                }, 100)
            },

            headerIsCorrect() {
                let correct = ['nume', 'nume_lung', 'cod_interbull', 'crotalie', 'naab', 'cod_ro'];
                if( correct.length != this.file.columns.length )
                {
                    return false
                }
                correct = _.map(correct, item => item.toLowerCase() )
                let columns = _.map(this.file.columns, item => item.toLowerCase() )
                correct = _.sortBy(correct)
                columns = _.sortBy(columns)
                for(let i = 0; i < correct.length; i++)
                {
                    if( correct[i] != columns[i])
                    {
                        return false
                    }
                }
                return true
            },

            checkValidity() {
                this.is_valid_file = this.headerIsCorrect()
            },

            loadIntoTable() {
                _.each(this.details, item => {

                    let animal = {}
                    for(let i = 0; i < item.columns.length; i++)
                    {
                        animal[this.file.columns[i]] = item.columns[i]
                    }
                    item.finished = false
                    this.post('farms/import/sires-import', {
                        farm_id: this.file.farm_id,
                        type: this.file.type,
                        gender: 'male',
                        animal: animal
                    }, data => {
                       item.imported = data.success ? 1 : 0
                       item.finished = 1
                    })
                })
                
            }
        },

        mounted() {
            this.init()
        }
    }
</script>

<style lang="scss" scoped>
    td.cell-import {
        font-size: 11px;
        padding: 2px;
    }

    td.cell-import-header {
        background-color: #34bfa3 !important;
        color: #ffffff;
    }

    tr.row-failed {
        td {
            color: red;
        }
    }

    tr.row-success {
        td {
            color: green;
        }
    }
</style>
