<template>
    <tbody>
        <tr 
            v-for="(record, row) in dt.records" 
            :id="dt.name + '-row-' + row"
            :key="'datatable-row-' + row"
            class="cs-datatable-row"
        >
            <td 
                v-for="(column, name, col) in dt.model.grid.columns.all()"
                :key="'datatable-td-' + name + '-' + col"
                :class="cellClass(column, record)"
                :style="cellStyle(column, record)"
            >
                <span v-if="column.source.component == 'cell-recno'">
                    {{ ( (dt.current_page - 1) * dt.per_page + 1 + row ) + '.' }}
                </span>

                <component
                    v-else
                    :is="column.source.component"
                    :column="column"
                    :record="record"
                    @click="onClickCell(column, record, $event)"
                >
                </component>
            </td>
        </tr>

    </tbody>
</template>

<script>
    export default
    {
        props:
        {
            dt: {default: null},
        },

        methods:
        {
            cellClass(column, record)
            {
                let r = column.source.cell_class
                let default_class = {}
                if(column.source.component == 'cell-actions')
                { 
                    default_class['cs-cell-actions'] = true
                }
                if( ! r )
                {
                    return default_class
                }
                if( _.isFunction(r))
                {
                    return _.extend({}, default_class, r(column, record))
                }
                if( _.isObject(r))
                {
                    return _.extend({}, default_class, r)
                }
            },

            cellStyle(column, record)
            {
                let r = column.source.cell_style
                let default_style = {
                    width: column.width + '!important',
                    'max-width': column.width + '!important',
                    'min-width': column.width + '!important',
                }
                if( ! r )
                {
                    return default_style
                }
                if( _.isFunction(r) )
                {
                    let style = r(column, record)
                    return _.extend({}, default_style, style)
                }
                if( _.isObject(r) )
                {
                    return _.extend({}, default_style, r)
                }
            },

            onClickCell(column, record, e)
            {
                if(column.source.hasOwnProperty('actions'))
                {
                    let r = column.source.actions
                    if( _.isFunction(r) )
                    {
                        r(this, record)
                    }
                    else
                    {
                        this.$emit('rowclick', {name: e.name, record, column})
                    }
                }
            }
        },

        components:
        {
            'cell-string' : require('./CellString'),
            'cell-actions' : require('./CellActions'),
        },

        name: 'datatable-body'
    }
</script>

<style scoped lang="scss">
    td
    {
        border-left:1px solid #ccc;
        border-right:1px solid #ccc;
        border-bottom:1px solid #ccc;
        border-collapse: collapse;
    }
</style>