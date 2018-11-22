<template>
    <div class="m-portlet__head">
        <div v-if="! farm || farm.loading" class="m-loader text-center" style="width:100%">
        </div>
        <div v-if="farm && ! farm.loading" class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon">
                    <img :src="$app.url + '/img/icons/farm.png'" style="height:32px" />
                </span>
                <h3 class="m-portlet__head-text">
                    {{ farm.farm }}
                </h3>
            </div>
        </div>
        <div v-if="farm && ! farm.loading" class="m-portlet__head-tools">
            <ul class="nav nav-tabs m-tabs m-tabs-line  m-tabs-line--right" role="tablist">
                <!-- Data ferma -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true, 'active': current == 'data', 'show': current == 'data'}" 
                        role="tab"
                        @click="$emit('current', 'data')"
                    >
                        <img :src="$app.url + 'img/icons/details.png'" style="height:28px" />
                        <span style="margin-left: 4px">{{ __('Ferma') }}</span>
                    </a>
                </li>
                <!-- Vacile -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}" 
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true, 'active': current == 'cow', 'show': current == 'cow'}"
                        role="tab"
                        @click="$emit('current', 'cow')"
                    >
                        <img :src="$app.url + 'img/icons/cow.png'" style="height:28px" />
                        <span style="margin-left: 4px">{{ __('Vaci') }}</span>
                    </a>
                </li>
                <!-- Taurii -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}" 
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true, 'active': current == 'sire', 'show': current == 'sire'}"
                        role="tab"
                        @click="$emit('current', 'sire')"
                    >
                        <img :src="$app.url + 'img/icons/bull.png'" style="height:28px" />
                        <span style="margin-left: 4px">{{ __('Tauri') }}</span>
                    </a>
                </li>
                <!-- Utilizatori -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}" 
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true, 'active': current == 'users', 'show': current == 'users'}"
                        role="tab"
                        @click="$emit('current', 'users')"
                    >
                        <img :src="$app.url + 'img/icons/users.png'" style="height:28px" />
                        <span style="margin-left: 4px">{{ __('Utilizatori') }}</span>
                    </a>
                </li>
                <!-- Ore mulsori -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true, 'active': current == 'mulsori', 'show': current == 'mulsori'}" 
                        role="tab"
                        @click="$emit('current', 'mulsori')"
                    >
                        <img :src="$app.url + 'img/icons/clock.png'" style="height:28px" />
                        <span style="margin-left: 4px">{{ __('Ore mulsori') }}</span>
                    </a>
                </li>
                <!-- Inapoi -->
                <li 
                    :class="{'nav-item': true, 'm-tabs__item': true}"
                    style="cursor:pointer"
                >
                    <a 
                        :class="{'nav-link': true, 'm-tabs__link': true}"
                        @click="$router.push({name: 'farms'})"
                    >
                        <img :src="$app.url + 'img/icons/farm.png'" style="height:28px" />
                        {{ __('Ferme') }}
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
