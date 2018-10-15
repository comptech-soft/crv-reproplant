<template>
    <div class="btn-toolbar">
        <div class="btn-group">
            <button 
                type="button" 
                :class="item.btn_class"
                v-for="(item, index) in items"
                :key="'toolbar-btn-' + index"
                @click="onClick(item)"
            >
                <i 
                    v-if="hasProperty(item, 'icon')" 
                    :class="getProperty(item, 'icon')"
                ></i>
            </button>
        </div>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            dt: {default: null},
        },

        computed:
        {
            items()
            {
                return ! this.dt ? [] : this.dt.model.grid.toolbar
            }
        },

        name: 'datatable-toolbar'
    }
</script>