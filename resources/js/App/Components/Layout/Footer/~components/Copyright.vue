<template>
    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
        <span class="m-footer__copyright">
            {{ year }}&copy; 
            <a :href="url" class="m-link" target="blank">{{ company }}</a>
        </span>
    </div>
</template>

<script>
    export default {

        props: {
            year: {type: String, default: 'Year'},
            company: {type: String, default: 'Copyright Company'},
            url: {type: String, default: 'http://www.comptech.ro'}
        },

    }
</script>
