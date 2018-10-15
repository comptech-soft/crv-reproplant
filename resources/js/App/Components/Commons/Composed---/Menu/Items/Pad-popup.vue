<template>
    <li 
        class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel" 
        m-menu-submenu-toggle="click" 
        aria-haspopup="true"
    >
        <anchor 
            tagClass="m-menu__link, m-menu__toggle" 
            title="Non functional dummy link"
        >
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">{{ item.caption }}</span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </anchor>
        
        <div 
            class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"
        >
            <span class="m-menu__arrow m-menu__arrow--adjust">    
            </span>
            
            <ul class="m-menu__subnav">

                <pad-link
                    :item="{
                        caption: 'Bar #1',
                        icon: 'flaticon-diagram',
                        badge: ';)',
                        active: true,
                    }"
                >
                </pad-link>

                <pad-link
                    :item="{
                        caption: 'Bar #2',
                        icon: 'flaticon-users',
                    }"
                >
                </pad-link>

                <pad-submenu
                    :item="{
                        caption: 'Bar #3',
                    }"
                >
                </pad-submenu>

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


        name: 'pad-popup'
    }
</script>
