<template>
    <div v-if="dt && am" class="nav-tabs-custom">
        <ul class="nav nav-pills" role="tablist">
            <li 
                :class="{'nav-item': true}"
            >
                <a :class="{'nav-link': true,  active: current_tab == 'list'}" href="javascript:void(0);" @click.prevent="showGrid(false)">
                    <img v-if="icon" :src="$app.url + icon" style="height:20px"/>
                    {{ caption }}
                </a>
            </li>
            <li 
                :class="{'nav-item': true}"
                v-if="(current_tab == 'list') && has_form"
            >
                <a :class="{'nav-link': true,  active: current_tab == 'form'}" href="javascript:void(0);" @click.prevent="showForm('insert', null)">
                    <i class="la la-plus-circle"></i>
                    {{ form_tab_caption }}
                </a>
            </li>
            
            <!-- 
                aici se poate pune un dropdown cu actiuni
                actiunile vin via proprietatea "actions" 
            -->
            <li v-if="current_tab == 'list'" class="nav-item dropdown">
                <a class="nav-link m-tabs__link dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ __('Acțiuni') }} 
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="min-width:20rem">
                    <li role="presentation" v-for="(action, indexAction) in actions" :key="'action-' + indexAction">
                        <a
                            role="menuitem" 
                            tabindex="-1" href="javascript:void(0);" 
                            @click.prevent="onClickAction(action)"
                        >
                            <i :class="action.icon"></i>
                            {{ __(action.caption) }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="javascript:void(0);" @click.prevent="onRefresh">
                            <i class="la la-refresh"></i>
                            {{ __('Reîncarcă') }}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- aici se pot pune iconitie cu actiuni -->
            <li v-if="false" class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
        </ul>

        <div class="tab-content">
            <!-- Boxul cu datatable grid -->
            <div 
                :class="{'tab-pane': true, active: current_tab == 'list'}"
            >
                <grid-box-container
                    :dt="dt"
                    @dttoolbarclick="onToolbarClick"
                    @dtrowclick="onRowClick"
                >
                    <div slot="dt-filter">
                        <slot name="dt-filter"></slot>
                    </div>
                </grid-box-container>
            </div>

            <!-- Boxul cu formuarul -->
            <div
                :class="{'tab-pane': true, active: current_tab == 'form'}"
                v-if="has_form"
            >
                <div class="row">
                    <div class="col">
                        <action-box-container
                            :dt="dt"
                            :am="am"
                            @close="showGrid(false)"
                            @submit-success="showGrid(true)"
                        >
                            <!-- asta se injecteaza in body-ul action-box-contaier -->

                            <div slot="box-action-slot">
                                <slot name="dt-form"></slot>
                            </div>
                        </action-box-container>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        mounted() {
            let i = setInterval( () => {
                if(this.model)
                {
                    clearInterval(i)
                    this.init()
                }
            }, 500)
        },

        components: {
            'grid-box-container': require('./../../../Commons/Composed/Portlets/Grid'),
            'action-box-container': require('./../../../Commons/Composed/Portlets/Action'),
        },

        mixins: [
            require('./Mixins/props'), 
            require('./Mixins/computed'), 
            require('./Mixins/data'), 
            require('./Mixins/methods'),
        ],

        name: 'datatable-grid-page'
    }
</script>