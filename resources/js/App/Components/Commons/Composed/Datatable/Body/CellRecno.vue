<template>
    <div 
        class="cs-datatable-cell cs-datatable-cell-string"
        v-html="cell_content"
    >
    </div>
</template>

<script>
    export default
    {
        props: 
        {
            column: {required: true},
            record: {required: true},
        },

        computed:
        {
            cell_content()
            {
                let r = this.column.source.render
                if( _.isString(r) )
                {
                    return r;
                }
                if( _.isFunction(r) )
                {
                    return r(this.record)
                }
            }
        }
    }
</script>

<style scoped lang="scss">

    .cs-datatable-cell 
    {
        width: 100%;
        max-width: 100%;
        min-width: 100%;
    }
</style>
