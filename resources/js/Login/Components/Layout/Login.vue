<template>
    <div class="m-grid m-grid--hor m-grid--root m-page" style="height:100vh">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
            <left-form></left-form>
            <right-side></right-side>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'left-form': require('./Left/Left'),
            'right-side': require('./Right/Right'),
        }
    }
</script>