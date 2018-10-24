<template>
	<div 
        :class="uploader_control_class"
    >
        <label
            v-if="label"
            v-html="label"
        >
        </label>

        <vue-image
            :id="'vue-image-' + id"
            :source="image_url"
            :dimensions="image_real_dimensions"
            :maxheight="maxheight"
        >
        </vue-image>
        
        <div v-if="! disabled" class="input-group" style="margin-top:2px">
            <div class="input-group-btn">
                <button 
                    type="button" 
                    class="btn btn-primary btn-browse"
                    :id="btn_fake_browse"
                    @click.prevent="openBrowseForFile"
                >
                    <i v-if="uploading" class="fa fa-spinner fa-spin">
                    </i>
                    <i v-else class="fa fa-upload"></i>

                    <span v-if="caption">{{ caption }}</span>
                </button>
            </div>
            <input 
                type="text" 
                readonly 
                class="form-control"
                v-model="file_name"
            />
        </div>

        <span 
            v-if="(render_errors == null ? '' : render_errors) + (validation_errors == null ? '' : validation_errors)"
            class="help-block"
            v-html="(render_errors == null ? '' : render_errors) + (validation_errors == null ? '' : (render_errors ? '<br/>' : '') + validation_errors)"
        >
        </span>
        
        <form
            action="#" 
            method="post"
            enctype="multipart/form-data"
            :id="form_id"
            class="iu-fake-form"
            style="position:absolute; top: -2000px; left: -2000px;"
        >
            <input :id="btn_browse_id" type="file" name="post_image" /> 
            <input :id="btn_submit_id" type="submit" />
        </form>
    </div>
</template>

<script>

    import ImageUploaderManager from './ImageUploaderManager'

    export default 
    {
        mixins: 
        [
            require('./image-uploader-properties-mix'),
            require('./image-uploader-events-mix'),
            require('./errors-mix'),
        ],

        mounted()
        {
            this.uploaderManager = new ImageUploaderManager();
            this.uploaderManager.SetMaxsize(this.maxsize).SetExtensions(this.extensions);
            this.bindUploadEvent();
        },

        name: 'image-uploader'
    }

</script>

<style lang="scss" scoped>
    .btn-browse
    {
        border-radius: 0;
    }
</style>