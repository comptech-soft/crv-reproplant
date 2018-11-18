<template>
    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true">
        <a href="" class="dropdown-toggle m-dropdown__toggle btn btn-outline-metal m-btn m-btn--icon m-btn--pill">
            <span>{{ popup.caption }}</span>
        </a>
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust">
            </span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav">
                            <li class="m-nav__section m-nav__section--first m--hide">
                                <span class="m-nav__section-text">{{ popup.caption }}</span>
                            </li>

                            <template v-for="(group, key, groupIndex) in popup.options">
                                <li v-for="(item, itemIndex) in group" :key="'brand-tool-item-' + groupIndex + '-' + itemIndex" class="m-nav__item">
                                    <a href="javascript:void(0);" class="m-nav__link" @click.prevent="onClick(item)">
                                        <i :class="'m-nav__link-icon flaticon-' + item.icon"></i>
                                        <span class="m-nav__link-text">{{ item.caption }}</span>
                                    </a>
                                </li>
                                
                                <li v-if="groupIndex < groups_length - 1" class="m-nav__separator m-nav__separator--fit" :key="'brand-tool-item-separator-' + groupIndex">
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    const Tools = require('./../../../../../Menus/Header/Brand/tools')
    
    export default {

        computed: {

            popup() {
                return Tools
            },

            groups_length() {
                return _.keys(this.popup.options).length
            }
        }
    }
</script>