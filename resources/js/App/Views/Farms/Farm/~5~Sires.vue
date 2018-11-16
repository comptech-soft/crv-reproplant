<template>
    <div v-if="farm">
        My Sires
    </div>
</template>

<script>
    export default {
        props: {
            farm: {required: true},
        },

       
    }
</script>