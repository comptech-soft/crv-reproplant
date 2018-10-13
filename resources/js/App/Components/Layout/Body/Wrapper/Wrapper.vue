<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <sub-header
            :title="subheader.title"
            :breadcrumbs="subheader.breadcrumbs"
            :actions="subheader.actions"
        >
        </sub-header>
        <div class="m-content">
            <router-view>
            </router-view> 
        </div>
    </div>
</template>

<script>

    const subheader = {
        title: 'My Page Title',
        breadcrumbs: [
            {
                caption: 'Link #1',
            },
            {
                caption: 'Link #2',
            }
        ],
        actions: {
            caption: 'My Actions',
            options: {
                a: 
                [
                    {
                        icon: 'share',
                        caption: 'Option #1'
                    },
                ],
                b: 
                [
                    {
                        icon: 'lifebuoy',
                        caption: 'Option #2',
                    },

                    {
                        icon: 'info',
                        caption: 'Option #3',
                    }
                ] 
            }
        }
    } 

    export default {

        computed: {
            subheader()
            {
                return subheader
            }    
        },

        components: {
            'sub-header': require('./Header/Header'),
        }
    }
</script>