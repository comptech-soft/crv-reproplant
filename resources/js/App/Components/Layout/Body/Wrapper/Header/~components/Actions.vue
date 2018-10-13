<template>
    <div v-if="visible" class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle">
            <i class="la la-plus m--hide"></i>
            <i class="la la-ellipsis-h"></i>
        </a>
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust">
            </span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav">
                            <li class="m-nav__section m-nav__section--first m--hide">
                                <span class="m-nav__section-text">Quick Actions</span>
                            </li>
                            <template v-for="(group, key, groupIndex) in actions.options">
                                <li v-for="(item, itemIndex) in group" :key="'brand-tool-item-' + groupIndex + '-' + itemIndex" class="m-nav__item">
                                    <a href="" class="m-nav__link">
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
    export default {

        props: {
            actions: {type: Object, default: () => {}}
        },

        computed:
        {
            visible()
            {
                return ! _.isEmpty(this.actions)
            },

            groups_length()
            {
                return _.keys(this.actions.options).length
            }
        }

    }
</script>