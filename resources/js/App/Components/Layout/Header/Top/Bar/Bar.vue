<template>
    <div id="m_header_nav" class="m-stack__item m-stack__item--fluid m-header-head">
        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
            <div class="m-stack__item m-topbar__nav-wrapper">
                <ul class="m-topbar__nav m-nav m-nav--inline">

                    <li v-if="farm" class="m-nav__item m-topbar__user-profile">
                        <a class="m-nav__link">
                            <span class="m-topbar__welcome">
                                {{ farm.farm }}
                            </span>
                        </a>
                    </li>

                    <!-- aici se ma pot baga quick actions si notifications -->
                    <user>
                    </user>

                    <!-- 
                        in dreapta, chestia aia faina cu messages, settings, logs
                        doar daca avem users 
                    -->
                    <li v-if="$app.user" id="m_quick_sidebar_toggle" class="m-nav__item">
                        <a href="#" class="m-nav__link m-dropdown__toggle">
                            <span class="m-nav__link-icon m-nav__link-icon--aside-toggle">
                                <span class="m-nav__link-icon-wrapper">
                                    <i class="flaticon-grid-menu"></i>
                                </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

    // import {mapActions} from 'vuex'

    export default {
        
        computed: {
            farm() {
                return this.$store.getters.farm.record
            }
        },

        components: {
            'user': require('./User'),
        },
    }
</script>