<template>
    <header id="m_header" class="m-grid__item m-header " m-minimize="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200">
       <header-top>
       </header-top>
        <!-- banda a doua din header apare doar daca avem user -->
       <header-bottom v-if="$app.user">
       </header-bottom>
    </header>
</template>

<script>
    export default {
        components: {
            'header-top': require('./Top/Top'),
            'header-bottom': require('./Bottom/Bottom'),
        },

        name: 'app-header'
    }
</script>