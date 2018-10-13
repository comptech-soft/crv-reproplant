<template>
    <li 
        :class="item_class" 
        aria-haspopup="true"
    >
        <anchor 
            tagClass="m-menu__link"
        >
            <i 
                v-if="icon" 
                :class="'m-menu__link-icon ' + icon"
            >
            </i>

            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">{{ item.caption }}</span>
                    <span v-if="badge" class="m-menu__link-badge">
                        <span class="m-badge m-badge--success">{{ badge }}</span>
                    </span>
                </span>
            </span>
        </anchor>
    </li>
</template>

<script>
    export default
    {
        props:
        {
            item: {required: true}
        },

        computed:
        {
            item_class()
            {
                let r = {
                    'm-menu__item': true,
                }
                if(this.item.hasOwnProperty('active') && this.item.active)
                {
                    r['m-menu__item--active'] = true
                }
                return r
            },

            icon()
            {
                return this.item.hasOwnProperty('icon') ? this.item.icon : null
            },

            badge()
            {
                return this.item.hasOwnProperty('badge') ? this.item.badge : null
            }
        },

        name: 'pad-link'
    }
</script>
