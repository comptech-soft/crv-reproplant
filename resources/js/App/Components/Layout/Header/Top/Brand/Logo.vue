<template>
    <div class="m-stack__item m-stack__item--middle m-brand__logo">
        <a href="javascript:oid(0);" class="m-brand__logo-wrapper" @click.prevent="onClick">
            <img alt="" :src="$app.url + 'img/logos/logo_crv.png'" />
        </a>
    </div>
</template>

<script>
    export default {
        methods: {
            onClick() {
                this.redirectTo(this.$app.url, 10)
            }
        }
    }
</script>
