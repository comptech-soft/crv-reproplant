<template>
    <div 
        :class="{
            modal: true,
            fade: visible,
            show: visible
        }" 
        :id="id" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="exampleModalLabel" 
        :style="{
            display: visible ? 'block' : 'none', 
            'padding-right': '16px',
        }"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ caption }}
                    </h5>
                    <button type="button" class="close" aria-label="Close" @click="$emit('close')">
                        <span aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="modal-body"></slot>
                </div>
                <div class="modal-footer">
                    <slot name="modal-footer-buttons">
                    </slot>
                    <button type="button" class="btn btn-secondary" @click="$emit('close')">
                        {{ __('Renunță') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: {
            visible: {default: false},
            id: {default: null},
            caption: {default: 'My modal caption'},
        },

        watch: {
            visible: function(newVisible, oldVisible)
            {
                if( newVisible)
                {
                    $('body').addClass('modal-open')
                    $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
                }
                else
                {
                    $('body').removeClass('modal-open')
                    $('div.modal-backdrop').remove();
                }
            }
        },
    }
</script>