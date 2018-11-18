<template>
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-page__container m-body">
        
        <!-- 
            ce buton o fi asta [m_aside_left_close_btn]??? 
        -->
        <button 
            id="m_aside_left_close_btn" 
            class="m-aside-left-close m-aside-left-close--skin-light"
        >
            <i class="la la-close"></i>
        </button>

        <!-- 
            Left aside este scos 
        -->
        <left-aside v-if="false && $app.user" :menu="menu">
        </left-aside>

        <!-- Wrapper -->
        <wrapper></wrapper>
    </div>
</template>

<script>

    const menu = {
        // a: {
        //     caption: 'Group #1',
        //     options: [
        //         {
        //             caption: 'Option #1',
        //             options: [
        //                 {
        //                     caption: 'Option #1.1',
        //                 },
        //                 {
        //                     caption: 'Option #1.2',
        //                 }
        //             ]
        //         },
        //     ]
        // },
        // b: {
        //     caption: 'Group #2',
        //     options: [
        //         {
        //             caption: 'Option #1',
        //         },
        //         {
        //             caption: 'Option #2',
        //         }
        //     ]
        // },
    }
    export default {
        computed: {
            menu()
            {
                return menu
            }
        },

        components: {
            'left-aside': require('./Aside/Aside'),
            'wrapper': require('./Wrapper/Wrapper'),
        }
    }
</script>