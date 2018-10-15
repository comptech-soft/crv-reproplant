<template>
    <div class="m-header__top">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <brand>
                </brand>
                <top-bar>
                </top-bar>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'brand': require('./Brand/Brand'),
            'top-bar': require('./Bar/Bar'),
        },

        name: 'app-header-top'
    }
</script>