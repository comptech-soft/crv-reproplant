<template>
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <copyright></copyright>
                    <footer-links :links="links"></footer-links>
                </div>
            </div>
        </div>
    </footer>
</template>


<script>

    const links = [
        {
            caption: 'Link #1'
        },
        {
            caption: 'Link #2'
        },
        {
            caption: 'Link #3'
        }
    ]
    export default {

        components: {
            'copyright': require('./~components/Copyright'),
            'footer-links': require('./~components/Links'),
        },

        computed:
        {
            links()
            {
                return links
            }
        }

    }
</script>