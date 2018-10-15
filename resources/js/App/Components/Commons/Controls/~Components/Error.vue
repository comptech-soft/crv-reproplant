<template>
    <span 
        class="help-block" 
        style="font-size: 1.2rem"
        v-html="error"
    >
    </span>
</template>

<script>
    export default
    {
        props: {
            error: {required: true, type: String}
        }
    }
</script>