<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <router-view name="header"></router-view> 
        <div class="m-content">
            <router-view name="page"></router-view> 
        </div>
    </div>
</template>