<template>
    <modal-box 
        :visible="visible"
        id="quick-add-sire"
        :caption="__('Adăugare companie')"
        @close="$emit('close')"
    >
        <template slot="modal-body">
            <div class="row">
                <div class="col">
                    <textbox
                        id="name"
                        field="name"
                        :label="__('Nume')"
                        :placeholder="__('Nume')"
                        maxlength="128"
                        :disabled="action == 'delete'"
                        v-model="record.name"
                        :errors="errors"
                    >
                    </textbox>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <vue-uploader
                        :label="__('Company Logo')"
                        id="company-logo"
                        field="company-logo"
                        maxsize="5"
                        maxheight="128"
                        folder="logos"
                        :extensions="['png', 'jpg', 'jpeg']"
                        :errors="errors"
                        :initial_image="{ s3_path: record.logo, width: 160}"
                        
                        @upload-validation-fail="onImageValidationFail"
                        @uploading-process-end-success="onImageUploadSuccess"
                    >
                    </vue-uploader>
                </div>
            </div>
        </template>

        <template slot="modal-footer-buttons">
            <button 
                type="button" 
                class="btn btn-primary"
                @click="onClickAdd"
            >
                {{ __('Adaugă') }}
                <i v-if="fm && fm.submitting" class="fa fa-spinner fa-spin"></i>
            </button>
        </template>
    </modal-box>   
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'
    import model from './../../../Models/Animals/Companies/Company'

    export default{
        props: {
            visible: {default: false},
        },

        data()
        {
            return {
                
                action: 'insert',
                am: null,
                model: null,
                fm: null,
                record: {
                    id: null,
                    name: '',
                    logo: '',
                    width: null,
                    height: null,
                },
                created: null,
            }
        },

        watch: {
            visible: function(newVisible, oldVisible){
                this.emptyRecord()
            }
        },

        methods: {

            emptyRecord()
            {
                this.record.name = ''
                this.record.logo = ''
                this.record.width = null
                this.record.height = null
                this.created = null
            },

            onClickAdd()
            {
                this.fm.onClickSubmit(this.model.rules[this.am.action].rules, data => {
                    this.created = data.result.payload.result
                    this.resetRecord()
                })
            },

            resetRecord()
            {
                this.$emit('close', this.created)
                this.emptyRecord()
            },

            onImageValidationFail(e)
            {
                this.record.logo = null;
                this.record.width = null;
                this.record.height = null;
            },
            
            onImageUploadSuccess(e)
            {
                this.record.logo = e.image.s3_path;
                this.record.width = e.image.width;
                this.record.height = e.image.height;
            },

        },

        computed: {
            errors()
            {
                return this.fm ? this.fm.errors : null
            }
        },

        mounted(){
            this.model = model
            this.am = new AppCore.ActionsManager('action-quick-add-company', this.model, this)
            this.am.setAction(this.action)
            this.fm = new AppCore.ActionFormManager('quick-company-form', this)
        },  

    }
</script>