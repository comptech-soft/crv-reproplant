<template>
    <footer class="m-grid__item m-footer crv-footer">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <copyright :year="datetime.year()" :company="$app.config.name"></copyright>
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
            'copyright': require('./~1~Copyright'),
            'footer-links': require('./~2~Links'),
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

<style scoped lang="scss">

    .crv-footer
    {
        margin-top: initial !important;
        .m-footer__wrapper
        {
            margin: 0 !important;
            padding: 10px 20px !important;
        }
    }
</style>