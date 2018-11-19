<template>
    <div class="m-portlet__head">

        <!-- loading indicator -->
        <div v-if="! animal || animal.loading" class="m-loader text-center" style="width:100%">
        </div>

        <!-- Caption -->
        <div v-if="animal && ! animal.loading" class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon">
                    <i class="flaticon-multimedia"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    {{ animal.short_name || animal.long_name }}
                </h3>
            </div>
        </div>

        <!-- Taburile -->
        <div v-if="animal && ! animal.loading" class="m-portlet__head-tools">
            <ul class="nav nav-tabs m-tabs m-tabs-line  m-tabs-line--right" role="tablist">
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'traits',
                            'show': current == 'traits',
                        }" role="tab"
                        @click="$emit('current', 'traits')"
                    >
                        {{ __('Caracteristici') }}
                    </a>
                </li>
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'pedigree',
                            'show': current == 'pedigree',
                        }"
                        role="tab"
                        @click="$emit('current', 'pedigree')"
                    >
                        {{ __('Ascendența') }}
                    </a>
                </li>
                 <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{
                            'nav-link': true, 
                            'm-tabs__link': true,
                            'active': current == 'update',
                            'show': current == 'update',
                        }" role="tab"
                        @click="$emit('current', 'update')"
                    >
                        {{ __('Editează') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            animal: {required: true},
            current: {required: true}
        }
    }

</script>
