<template>
    <div id="m_aside_left" v-if="visible" class="m-grid__item m-aside-left">
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light" data-menu-vertical="true" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
            <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow">
                <template v-for="(group, key, groupIndex) in menu">
                    <li :class="'m-menu__section ' + (groupIndex == 0 ? 'm-menu__section--first' : '')" :key="'aside-section-' + groupIndex">
                        <h4 class="m-menu__section-text">{{ group.caption}}</h4>
                        <i class="m-menu__section-icon flaticon-more-v2"></i>
                    </li>

                    <li 
                        v-for="(option, optionIndex) in group.options" 
                        :class="optionClass(option)" 
                        aria-haspopup="true" 
                        :m-menu-submenu-toggle="hasOptions(option) ? 'hover' : null"
                        :key="'option-item-' + groupIndex + '-' + optionIndex"
                    >
                        <a href="javascript:;" :class="{'m-menu__link': true, 'm-menu__toggle': hasOptions(option)}">
                            <i v-if="false" class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">{{option.caption}}</span>
                            <i v-if="hasOptions(option)" class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div v-if="hasOptions(option)" class="m-menu__submenu">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                    <span class="m-menu__link">
                                        <span class="m-menu__link-text">{{option.caption}}</span>
                                    </span>
                                </li>
                                <li 
                                    v-for="(item, itemIndex) in option.options" 
                                    class="m-menu__item" 
                                    aria-haspopup="true"
                                    :key="'suboption-' + groupIndex + '-' + optionIndex + '-' + itemIndex"
                                >
                                    <span class="m-menu__link">
                                        <span class="m-menu__link-text">{{ item.caption }}</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {

        props: {
            menu: {type: Object, required: true}
        },

        computed: {
            visible()
            {
                return ! _.isEmpty(this.menu)
            }
        },

        methods: {
            hasOptions(option)
            {
                return option.hasOwnProperty('options')
            },

            optionClass(option)
            {
                let r = {
                    'm-menu__item': true,
                }
                if(this.hasOptions(option))
                {
                    r['m-menu__item--submenu'] = true
                }
                return r
            }
        }
    }
</script>