<template>
    <div class="cs-datatable-container">
        
        <toolbar v-if="dtManager.toolbar.length" :dtManager="dtManager">            
        </toolbar>

        <slot name="filter">
        </slot>

        <div 
            class="m_datatable m-datatable m-datatable--default m-datatable--loaded dataTables_wrapper dt-bootstrap4" 
            :id="'cs-datatable-' + dtManager.name" 
        >

            <div class="row">
                <div class="col">
                    <div class="dataTables_length">
                        <label>
                            <select 
                                class="custom-select custom-select-sm form-control form-control-sm" 
                                style="width: initial; font-size:1em; font-family: Poppins"
                                @change="onChangePageLength"
                            >
                                <option 
                                    v-for="page in dtManager.page_lengths" 
                                    :key="'option-value-' + page"
                                    :value="page"
                                    :selected="page == dtManager.per_page"
                                >
                                    {{ page }}
                                </option>
                            </select>
                        </label>
                    </div>

                    <div v-if="dtManager.search_by_fields.length" class="dataTables_filter">
                        <label>
                            <input 
                                style="font-size:1em; font-family: Poppins" 
                                type="search" 
                                class="form-control form-control-sm" 
                                :placeholder="__('Căutare rapidă')"
                                @input="onInputSerached"
                            />
                        </label>
                    </div>
                </div>

                <div class="col dataTables_pager" style="text-align: right">
                    
                    <div class="dataTables_paginate paging_simple_numbers">
                        <dt-pagination
                            :id="'dt-pagination-' + dtManager.name"
                            :current_page="dtManager.current_page"
                            :last_page="dtManager.last_page"
                            :dtManager="dtManager"
                        >
                        </dt-pagination>
                    </div>

                    <div 
                        class="dataTables_info" 
                        role="status" aria-live="polite"
                    >
                        {{ __('Se afișează de la :from: la :to: din :total: înregistrări', {
                            from: dtManager.from, 
                            to: dtManager.to, 
                            total: dtManager.total
                        })}} ({{dtManager.count}})
                    </div>
                </div>
            </div>

            <table 
                class="table table-bordered m-table" 
                style="overflow-x: auto;"
            >

                <dt-header
                    :dtManager="dtManager"
                >
                </dt-header>

                <dt-body
                    :dtManager="dtManager"
                >
                </dt-body>

            </table>

        </div>

    </div>
</template>

<script>
    export default
    {
        props:
        {
            toolbar: {default: () => []},
            dtManager: {default: null},
        },

        methods:
        {
            onChangePageLength(e)
            {
                this.dtManager.changePageLength(e.target.value)
            },

            onInputSerached(e)
            {
                this.dtManager.searchBy(e.target.value)
            }
        },

        components:
        {
            toolbar: require('./Toolbar/Index'),
            'dt-header': require('./Header/Index'),
            'dt-body': require('./Body/Index'),
            'dt-pagination': require('./Pagination/Index'),
        },

        name: 'datatable'
    }
</script>

<style scoped lang="scss">
    .cs-datatable-container
    {
        width: 100%;
        max-width: 100%;
        min-width: 100%;

        div.dataTables_wrapper 
        {
            div.dataTables_length 
            {
                label 
                {
                    font-weight: normal;
                    text-align: left;
                    white-space: nowrap;
                }
            }

            .dataTables_info
            {
                padding: 0px !important;
                margin: 0px !important;
                display: block !important;
            }
        }
    }
</style>