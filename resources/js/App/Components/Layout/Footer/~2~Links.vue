<template>
    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
            <li v-for="(item, itemIndex) in links" :key="'footer-links-item-' + itemIndex" class="m-nav__item">
                <a href="#" class="m-nav__link">
                    <span class="m-nav__link-text">{{ item.caption}}</span>
                </a>
            </li>
            <li class="m-nav__item m-nav__item--last">
                <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                    <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

        props: {
            links: {type: Array, default: () => []}
        },

    }
</script>