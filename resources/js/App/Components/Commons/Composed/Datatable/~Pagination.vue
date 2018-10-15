<template>
    <ul :id="'dt-pagination-' + id" class="m-datatable__pager-nav" style="margin:0">

        <li>
            <a
                :title="__('Prima pagină')"     
                data-page="1"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link--first': true,
                    'm-datatable__pager-link--disabled': current_page == 1
                }"
                :disabled="current_page == 1"
                @click.prevent="onClick(1)"
            >
                <i class="la la-angle-double-left"></i>
            </a>
        </li>

        <li>
            <a
                :title="__('Pagina anterioară')"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link--first': true,
                    'm-datatable__pager-link--disabled': current_page <= 1
                }"
                :disabled="current_page <= 1"
                data-page="current_page - 1"
                @click.prevent="onClick(current_page - 1)"
            >
                <i class="fa fa-angle-left"></i>
            </a>
        </li>

        <li v-for="p in firsts" :key="'page-' + p">
            <a
                :title="__('Pagina :page', {page:p})"
                href="javascript:void(0);"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link-number': true,
                    'm-datatable__pager-link--active': current_page == p
                }"
                data-page="p"
                @click.prevent="onClick(p)"
            >
                {{p}}
            </a>
        </li>

        <li class="item-more-points" v-if="(firsts.length > 0) && (middles.length > 0) && (firsts[firsts.length - 1] + 1 < middles[0])">
            <a
                :title="__('Mai multe pagini')"
                :disabled="true"
            >
                <i class="la la-ellipsis-h"></i>
            </a>
        </li>

        <li v-for="p in middles" :key="'page-' + p">
            <a
                :title="__('Pagina :page', {page:p})"
                href="javascript:void(0);"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link-number': true,
                    'm-datatable__pager-link--active': current_page == p
                }"
                data-page="p"
                @click.prevent="onClick(p)"
            >
                {{p}}
            </a>
        </li>

        <li class="item-more-points" v-if="(middles.length > 0) && (lasts.length > 0) && (middles[middles.length-1] + 1 < lasts[0])">
            <a
                :title="__('Mai multe pagini')"
                :disabled="true"
            >
                <i class="la la-ellipsis-h"></i>
            </a>
        </li>

        <li v-for="p in lasts" :key="'page-' + p">
            <a
                :title="__('Pagina :page', {page:p})"
                href="javascript:void(0);"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link-number': true,
                    'm-datatable__pager-link--active': current_page == p
                }"
                data-page="p"
                @click.prevent="onClick(p)"
            >
                {{p}}
            </a>
        </li>

        <li>
            <a
                :title="__('Pagina următoare')"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link--first': true,
                    'm-datatable__pager-link--disabled': current_page >= last_page,
                }"
                :disabled="current_page >= last_page"
                data-page="current_page + 1"
                @click.prevent="onClick(current_page + 1)"
            >
                <i class="fa fa-angle-right"></i>
            </a>
        </li>

        <li>
            <a
                :title="__('Ultima pagină')"
                :class="{
                    'm-datatable__pager-link': true,
                    'm-datatable__pager-link--first': true,
                    'm-datatable__pager-link--disabled': current_page == last_page,
                }"
                data-page="last_page"
                :disabled="current_page == last_page"
                @click.prevent="onClick(last_page)"
            >
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>

    </ul>
</template>

<script>
    export default
    {

        props:
        {
            id: {type: String, required: true},
            size: {type: String, default: 'sm'},
            current_page: {default: 1, required: true},
            last_page: {type: Number, default: 1, required: true},
            has_incremental: {type: Boolean, default: true},
            arround: {type: Number, default: 2},
            dt: {dfault: null}
        },

        computed:
        {
            has_previous()
            {
                if( ! this.has_incremental )
                {
                    return false;
                }
                if(this.current_page > 1)
                {
                    return true;
                }
                return false;
            },

            has_next()
            {
                if( ! this.has_incremental )
                {
                    return false;
                }
                if(this.current_page < this.last_page)
                {
                    return true;
                }
                return false;
            },

            firsts()
            {
                let result = [];
                for(let i = 1; i <= this.arround; i++)
                {
                    if( i <= this.last_page)
                    {
                        result.push(i);
                    }
                }
                return result;
            },

            middles()
            {
                let result = [];
                for(let i = this.current_page - this.arround; i <= this.current_page + this.arround; i++)
                {
                    if( (i >= 1) && (i <= this.last_page)  && (this.firsts.indexOf(i) == - 1) )
                    {
                        result.push(i);
                    }
                }
                return result;
            },

            lasts()
            {
                let result = [];
                for(var i = this.last_page - this.arround + 1; i <= this.last_page; i++)
                {
                    if( (i >= 1) && (this.firsts.indexOf(i) == - 1) && (this.middles.indexOf(i) == - 1) )
                    {
                        result.push(i);
                    }
                }
                return result;
            }
        },

        methods:
        {
            onClick(page)
            {
                if(page == 0)
                {
                    return null
                }
                if( page > this.last_page )
                {
                    return null
                }
                this.dt.changePage(page)
            }
        }


    }
</script>

<style scoped lang="scss">
    
</style>