<template>
    <div class="m-stack__item m-stack__item--fluid">
        <div class="m-login__wrapper">
            <logo></logo>
            <login-form></login-form>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'login-form': require('./~LoginForm'),
            'logo': require('./~Logo'),
        }
    }
</script>