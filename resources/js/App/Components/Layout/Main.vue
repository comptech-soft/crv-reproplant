<template>

    <div class="m-grid m-grid--hor m-grid--root m-page">

        <page-header>
        </page-header>

        <page-body>
        </page-body>

    </div>

</template>

<script>
    export default {
        components: {
            'page-header': require('./Header/Header'),
            'page-body': require('./Body/Body'),
            'page-footer': require('./Footer/Footer')
        }
    }
</script>