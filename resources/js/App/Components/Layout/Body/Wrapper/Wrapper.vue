<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <router-view name="header"></router-view> 
        <div class="m-content" :style="cstyle">
            <router-view name="page"></router-view> 
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cstyle: {type: Object, default: () => {
                return {
                    padding: '10px 0px 10px 0px'
                }
            }}
        }   
    }
</script>
