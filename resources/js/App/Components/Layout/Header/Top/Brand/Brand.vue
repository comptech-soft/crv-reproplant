<template>
    <div class="m-stack__item m-brand">
        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
           <logo>
           </logo>
           <tools>
           </tools>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'logo': require('./~components/Logo'),
            'tools': require('./~components/Tools'),
        }
    }
</script>