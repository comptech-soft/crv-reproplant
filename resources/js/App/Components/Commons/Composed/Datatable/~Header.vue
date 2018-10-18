<template>
    <thead>
        <tr>
            <th 
                v-for="(column, name, col) in dt.model.grid.columns.all()"
                :key="'datatable-header-th-' + name + '-' + col"
                :class="headerClass(column)"
                :style="headerStyle(column)"
            >
                {{column.header.caption}}
                <div v-if="has_order(column)" class="pull-right" style="width:40px">
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
            dt: {default: null},
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
                        type: 'asc'
                    },
                    {
                        dir: 'desc',
                        type: 'desc'
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
                    width: column.width + '!important',
                    'max-width': column.width + '!important',
                    'min-width': column.width + '!important',
                    'vertical-align': 'middle !important'
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
                    la: true,
                }
                r['la-sort-' + this.order_type(column) + '-' + item.type] = true
                if( this.dt.order_by )
                {
                    r['is-current'] = (column.name == this.dt.order_by.name) && (item.dir == this.dt.order_by.dir)
                }
                return r
            },

            onClickHeader(column, item)
            {
                this.dt.setOrderBy({
                    name: column.name,
                    dir: item.dir,
                    field: column.header.order.field
                }).populate() 
            }
        },

        name: 'datatable-header'
    }
</script>

<style lang="scss" scoped>
    i.la
    {
        cursor: pointer;
    }
    i.la.is-current
    {
        color: #b3b3b3;
        cursor: default;
    }
</style>