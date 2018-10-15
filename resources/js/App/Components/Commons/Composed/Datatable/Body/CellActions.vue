<template>
    <div class="btn-group">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm m-btn--pill dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                 <li 
                    v-for="(action, index) in column.source.actions" 
                    :key="'cell-action-item-' + index"
                >
                    <a 
                        href="javascript:void(0);"
                        @click="onClick(action)"
                    >
                        <i :class="action.icon"></i>
                        <span class="m-nav__link-text">
                            {{ action.caption }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
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
        },

        
    }
</script>
