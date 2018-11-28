<template>
    <div>
        <!-- Datatable toolbar -->
        <div v-if="false" class="row">
            <div class="col">
                <div style="margin-bottom:6px">
                    <dt-toolbar v-if="dt.model.grid.toolbar.length" :dt="dt" @click="onBtnClick">
                    </dt-toolbar>
                </div>
            </div>
        </div>

        <!-- Filter slot -->
        <div class="row">
            <div class="col">
                <slot name="dt-filter"></slot>
            </div>
        </div>

        <!-- Page length selector and  -->
        <div class="row">
            <div class="col col-md-3">
                <div style="width:80px">
                    <div class="form-group m-form__group">
                        <select class="form-control m-input" @change="onChangePageLength" style="font-family:Poppins;">
                            <option 
                                v-for="page in dt.page_lengths" 
                                :key="'option-value-' + page"
                                :value="page"
                                :selected="page == dt.per_page"
                            >
                                {{ page }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-md-9">
                <div class="form-group m-form__group pull-right" style="width:150px;">
                    <input 
                        type="text" 
                        name="table_search" 
                        class="form-control m-input" 
                        :placeholder="__('Căutare rapidă...')" 
                        style="font-family:Poppins;"
                        @input="onInputSerached"
                    />
                </div>
            </div>
        </div>

        <!-- Pagination and Infos -->
        <div class="row m_datatable m-datatable m-datatable--default m-datatable--loaded" style="display:flex">
            <div class="col-md m-datatable__pager m-datatable--paging-loaded clearfix" style="margin-top:0">
                <dt-pagination
                    :id="'dt-pagination-' + dt.name"
                    :current_page="dt.current_page"
                    :last_page="dt.last_page"
                    :dt="dt"
                >
                </dt-pagination>
            </div>

            <div class="col-md">
                <div 
                    class="text-right" 
                    v-if="dt.total > 0"
                >
                    {{ __('Se afișează de la :from: la :to: din :total: înregistrări', {
                        from: dt.from, 
                        to: dt.to, 
                        total: dt.total
                    })}}
                </div>
                <div class="text-right" v-else-if="! dt.loading">
                    <span class="m-badge m-badge--info m-badge--wide">
                        {{__('Nu există înregistrări de afișat.')}}
                    </span>
                </div>
            </div>
        </div>

        <!-- The table -->
        <div class="row">
            <div class="col">
                <div v-if="dt.total > 0" class="table-responsive" style="margin-top: 6px">
                    <table :id="dt.name" class="table table-bordered table-sm m-table m-table--head-bg-brand cs-table">
                        <dt-header
                            :dt="dt"
                        >
                        </dt-header>

                        <dt-body
                            :dt="dt"
                            @rowclick="onRowClick"
                        >
                        </dt-body>
                        
                    </table>
                </div>
                <div v-else-if="! dt.loading" style="margin-top: 10px">
                    <alert-box type="alert-info" :content="__('Nu există înregistrări de afișat.')"></alert-box>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:
        {
            dt: {default: null},
        },

        methods:
        {
            onChangePageLength(e)
            {
                this.dt.changePageLength(e.target.value)
            },

            onInputSerached(e)
            {
                this.dt.searchBy(e.target.value)
            },

            onBtnClick(e)
            {
                this.$emit('toolbarclick', e)
            },

            onRowClick(e)
            {
                this.$emit('rowclick', e)
            },
        },

        components:
        {
            'dt-toolbar': require('./~Toolbar'),
            'dt-pagination': require('./~Pagination'),
            'dt-header': require('./~Header'),
            'dt-body': require('./Body/~Body'),
        },

    }
</script>