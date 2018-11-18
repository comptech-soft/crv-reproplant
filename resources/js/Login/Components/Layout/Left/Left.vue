<template>
    <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
        <div class="m-stack m-stack--hor m-stack--desktop">
            <auth-form></auth-form>
            <register-link v-if="false"></register-link>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'auth-form': require('./~components/AuthForm'),
            'register-link': require('./~components/RegisterLink'),
        }
    }
</script>