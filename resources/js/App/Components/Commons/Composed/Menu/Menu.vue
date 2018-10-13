<template>
     <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <component
                v-for="(item, index) in items"
                :is="item.component"
                :key="'menu-pad-' + index"
                :item="item"
            >
            </component>
        </ul>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            items: {},
        },

        data()
        {
            return {

            }
        },

        computed:
        {

        },

        methods:
        {

            initMenu()
            {
                let horMenuOffcanvas = new mOffcanvas('m_header_menu', {
                    overlay: true,
                    baseClass: 'm-aside-header-menu-mobile',
                    closeBy: 'm_aside_header_menu_mobile_close_btn',
                    toggleBy: {
                        target: 'm_aside_header_menu_mobile_toggle',
                        state: 'm-brand__toggler--active'
                    }            
                });
        
                let horMenu = new mMenu('m_header_menu', {
                    submenu: {
                        desktop: 'dropdown',
                        tablet: 'accordion',
                        mobile: 'accordion'
                    },
                    accordion: {   
                        slideSpeed: 200,  
                        expandAll: false
                    }
                });
            }


        },

        mounted()
        {
            this.jQueryInterval('#m_header_menu', 1, 100, 'initMenu')
        },

        created()
        {

        },

        components:
        {
            
        },

        mixins:
        [

        ],

        name: 'menu-box'
    }
</script>

<style scoped lang="scss">
</style>