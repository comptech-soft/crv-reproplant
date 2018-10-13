<template>
    <div class="m-stack__item m-stack__item--middle m-brand__tools">
        <tools-dropdown>
        </tools-dropdown>

        <!-- Aside Left Menu Toggler -->
        <a id="m_aside_left_offcanvas_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
            <span></span>
        </a>

        <!-- Responsive Header Menu Toggler-->
        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
            <span></span>
        </a>

        <!-- Topbar Toggler-->
        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
            <i class="flaticon-more"></i>
        </a>
    </div>
</template>

<script>
    export default {
        components: {
            'tools-dropdown': require('./~ToolsDropdown'),
        }
    }
</script>