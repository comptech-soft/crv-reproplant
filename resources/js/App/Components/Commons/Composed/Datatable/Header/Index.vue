<template>
    <thead>

        <tr>
            <th 
                v-for="(column, name, col) in dtManager.columns"
                :key="'datatable-header-th-' + name + '-' + col"
                :class="headerClass(column)"
                :style="headerStyle(column)"
            >
                {{column.header.caption}}
                <div v-if="has_order(column)" class="float-right">
                    <i
                        v-for="(item, index) in directions"
                        :key="'direction-' + item.dir + '-' + index"
                        :class="iconClass(column, item)"
                        @click="onClickHeader(column, item)"
                    >
                    </i>
                </div>
            </th>
        </tr>

    </thead>
</template>

<script>
    export default
    {
        props:
        {
            dtManager: {default: null},
        },

        data()
        {
            return {

            }
        },

        computed:
        {
            directions()
            {
                return [
                    {
                        dir: 'asc',
                        type: 'down'
                    },
                    {
                        dir: 'desc',
                        type: 'up'
                    }
                ]
            }
        },

        methods:
        {
            headerClass(column)
            {
                let r = column.header.header_class
                let default_class = {
                }
                if( ! r )
                {
                    return default_class
                }
                if( _.isFunction(r) )
                {
                    return _.extend({}, default_class, r())
                }
                if( _.isObject(r) )
                {
                    return _.extend({}, default_class, r)
                }
            },

            headerStyle(column)
            {
                let r = column.header.header_style;
                let default_style = {
                    width: column.width + '!important'
                }
                if( ! r )
                {
                    return default_style
                }
                if( _.isFunction(r) )
                {
                    return _.extend({}, default_style, r() )
                }
                if( _.isObject(r) )
                {
                    return _.extend({}, default_style, r )
                }
            },

            has_order(column)
            {
                if( ! column.header.hasOwnProperty('order') )
                {
                    return false
                }
                if( ! _.isObject(column.header.order) )
                {
                    return false
                }
                return column.header.order.field !== null
            },

            order_type(column)
            {
                if( ! column.header.order.hasOwnProperty('type') )
                {
                    return 'alpha'
                }
                return column.header.order.type ? column.header.order.type : 'alpha'
            },

            iconClass(column, item)
            {
                let r = {
                    fa: true,
                }
                r['fa-fw fa-sort-' + this.order_type(column) + '-' + item.type] = true
                if( this.dtManager.order_by )
                {
                    r['is-current'] = (column.name == this.dtManager.order_by.name) && (item.dir == this.dtManager.order_by.dir)
                }
                return r
            },

            onClickHeader(column, item)
            {
                this.dtManager.setOrderBy({
                    name: column.name,
                    dir: item.dir,
                    field: column.header.order.field
                }).populate() 
            }
        },

        mounted()
        {

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

        name: 'datatable-header'
    }
</script>

<style lang="scss" scoped>
    i.fa
    {
        cursor: pointer;
    }
    i.fa.is-current
    {
        color: #b3b3b3;
        cursor: default;
    }
    th
    {
        border:1px solid #ccc;
        border-collapse: collapse;
    }
</style>