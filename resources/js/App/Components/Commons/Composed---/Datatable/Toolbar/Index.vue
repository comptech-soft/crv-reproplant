<template>
    <div class="m-form m-form--label-align-right cs-datatable-toolbar-container m--margin-bottom-10">
        <div class="row align-items-center">
            <div class="col">
                <anchor 
                    v-for="(item, index) in items"
                    :key="'toolbar-btn-' + index"
                    :tagClass="'btn, m-btn' + (has_property(item, 'type') ? ', ' + item.type : '')"
                    @click="onClick(item)"
                >
                    <span>
                        <i v-if="has_property(item, 'icon')" :class="get_property(item, 'icon')"></i>
                        <span v-if="has_property(item, 'caption')">{{ item.caption }}</span>
                    </span>
                </anchor>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        props:
        {
            dtManager: {default: null},
        },

        computed:
        {
            items()
            {
                return ! this.dtManager ? [] : this.dtManager.toolbar
            }
        },

        methods:
        {
            has_property(item, property)
            {
                return item.hasOwnProperty(property)
            },

            get_property(item, property)
            {
                let r = item[property]
                if( _.isString(r) )
                {
                    return r
                }
                if( _.isFunction(r) )
                {
                    return r(this)
                }
            },

            onClick(item)
            {
                if( item.hasOwnProperty('action') && _.isFunction(item.action) ) 
                {
                    item.action(this)
                }
            }
        },

        name: 'datatable-toolbar'
    }
</script>

<style scoped lang="scss">
    .cs-datatable-toolbar-container
    {
        a.btn.m-btn
        {
            margin-left: 6px;
        }
        a.btn.m-btn:first-child
        {
            margin-left: 0px;
        }
    }
</style>