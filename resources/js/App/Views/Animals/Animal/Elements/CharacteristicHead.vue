<template>
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ caption }}
                </h3>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            caption: {required: true},
        },
    }
</script>

<style lang="scss" scoped>
    @import "./../Sass/characteristics.scss";
</style>