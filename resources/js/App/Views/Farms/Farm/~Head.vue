<template>
    <div class="m-portlet__head">
        <div v-if="! farm || farm.loading" class="m-loader text-center" style="width:100%">
        </div>
        <div v-if="farm && ! farm.loading" class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon">
                    <i class="flaticon-multimedia"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    {{ farm.farm }}
                </h3>
            </div>
        </div>
        <div v-if="farm && ! farm.loading" class="m-portlet__head-tools">
            <ul class="nav nav-tabs m-tabs m-tabs-line  m-tabs-line--right" role="tablist">
                <li 
                    :class="{
                        'nav-item': true, 
                        'm-tabs__item': true,
                    }"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'data',
                            'show': current == 'data',
                        }" role="tab"
                        @click="$emit('current', 'data')"
                    >
                        {{ __('Date de identificare') }}
                    </a>
                </li>
                <li 
                    :class="{
                        'nav-item': true, 
                        'm-tabs__item': true,
                    }" 
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'users',
                            'show': current == 'users',
                        }"
                        role="tab"
                        @click="$emit('current', 'users')"
                    >
                        {{ __('Utilizatori') }}
                    </a>
                </li>
                 <li 
                    :class="{
                        'nav-item': true, 
                        'm-tabs__item': true,
                    }"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'mulsori',
                            'show': current == 'mulsori',
                        }" role="tab"
                        @click="$emit('current', 'mulsori')"
                    >
                        {{ __('Ore mulsori') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            farm: {required: true},
            current: {required: true}
        }
    }
</script>
