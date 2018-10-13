<template>
    <li 
        :class="item_class" 
        m-menu-submenu-toggle="hover" 
        m-menu-link-redirect="1" 
        aria-haspopup="true"
    >
        <anchor 
            tagClass="m-menu__link m-menu__toggle" 
            title="Non functional dummy link"
        >
            <i class="m-menu__link-icon flaticon-business"></i>
            <span class="m-menu__link-text">{{ item.caption }}</span>
            <i class="m-menu__hor-arrow la la-angle-right"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </anchor>
        
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
            
            <span class="m-menu__arrow "></span>
            <ul class="m-menu__subnav">

                <pad-link
                    :item="{caption: 'Bar #3.1.'}"
                >
                </pad-link>

                <pad-link
                    :item="{caption: 'Bar #3.2.'}"
                >
                </pad-link>
            
            </ul>
        </div>
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
                    'm-menu__item--submenu': true,
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

        name: 'pad-submenu'
    }
</script>
