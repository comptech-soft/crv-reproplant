<template>
    <div 
        class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" 
        m-dropdown-toggle="click" 
        aria-expanded="true"
    >
        <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn btn-secondary m-btn m-btn--icon m-btn--pill cs-btn-actions">
            <i class="la la-ellipsis-h"></i>
        </a>
        
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav">
                            <li 
                                v-for="(action, index) in column.source.actions" 
                                class="m-nav__item"
                                :key="'cell-action-item-' + index"
                            >
                                <anchor tagClass="m-nav__link"
                                    @click="onActionClick(action)"
                                >
                                    <i :class="'m-nav__link-icon ' + action.icon"></i>
                                    <span class="m-nav__link-text">
                                        {{ action.caption }}
                                    </span>
                                </anchor>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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

        methods:
        {
            onActionClick(action)
            {
                if( _.isFunction(action.click))
                {
                    action.click(this)
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

    a.btn.cs-btn-actions
    {
        padding: 0.15rem 0.40rem;
    }

    .m-dropdown__body
    {
        padding: 10px !important;
        ul
        {
            >li
            {
                margin-bottom: 10px;
            }
            >li:last-child
            {
                margin-bottom: 0px;
            }
        }
    }
</style>
