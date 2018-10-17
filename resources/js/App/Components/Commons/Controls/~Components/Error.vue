<template>
    <div 
        class="form-control-feedback" 
        v-html="error"
    >
    </div>
</template>

<script>
    export default
    {
        props: {
            error: {required: true, type: String}
        }
    }
</script>