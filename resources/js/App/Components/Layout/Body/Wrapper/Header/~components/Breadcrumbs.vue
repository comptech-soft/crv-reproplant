<template>
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

        <li v-if="back_is_visible" class="m-nav__item m-nav__item--home">
            <a class="m-nav__link m-nav__link--icon" @click="onClickBack">
                <i class="m-nav__link-icon la la-angle-left"></i>
            </a>
        </li>

        <li class="m-nav__item m-nav__item--home">
            <router-link to="/" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </router-link>
        </li>

        <template v-for="(item, itemIndex) in breadcrumbs">
            <li v-if="itemIndex > 0" :key="'breadcrump-separator-' + itemIndex" class="m-nav__separator">-</li>
            <li class="m-nav__item" :key="'breadcrump-item-' + itemIndex">
                <a class="m-nav__link">
                    <span class="m-nav__link-text">{{ item.caption }}</span>
                </a>
            </li>
        </template>
    </ul>
</template>

<script>
    export default {

        props: {
            breadcrumbs: {type: Array, default: () => []}
        },

        computed:
        {
            back_is_visible()
            {
                return window.history.length > 1
            }
        },

        methods: {
            onClickBack()
            {
                this.$router.go(-1)
            }
        }
    }
</script>