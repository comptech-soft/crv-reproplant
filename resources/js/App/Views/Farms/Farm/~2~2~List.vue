<template>
    <div v-if="farm && dt" style="position: relative">
        <div 
            v-if="dt.loading"
            class="m-spinner m-spinner--brand text-center" 
            style="width:19.5px; margin:0 auto; display:block; position: absolute; left: calc(50% - 10px)"
        >
        </div>

    <div class="m-widget3">
        <div 
            class="m-widget3__item"
            v-for="(user, indexUser) in records"
            :key="'item-user-' + user.id + '-' + indexUser"
        >
            <div class="m-widget3__header" style="width:100%">
                
                <!-- 
                    avatarul
                    daca nu avem punem ceva default 
                -->
                <div class="m-widget3__user-img" style="width:0%">
                    <img v-if="! user.avatar_url" class="m-widget3__img" :src="$app.url + 'img/users/user1.jpg'" alt="">
                </div>

                <!-- numele, emailul, numarul de telefon -->
                <div class="m-widget3__info" style="width:80%">
                    <span class="m-widget3__username">
                        {{ userInfos(user) }}
                    </span>
                    <br>
                    <span class="m-widget3__time">
                        {{ __('Ultima actualizare: :date:', {date: datetime.humanFromNow(user.updated_at)}) }}
                    </span>
                </div>

                <!-- rolul -->
                <span class="m-widget3__status m--font-info" style="width:20%; float: none; text-align: right">
                    {{ userRole(user) }}
                </span>
            </div>

            <div class="m-widget3__body">
                <p class="m-widget3__text">
                    <a 
                        href="javascript:void(0);" 
                        class="btn btn-sm btn-outline-primary m-btn m-btn--icon"
                        @click="$emit('action', {action: 'update', record: user})"
                    >
                        <span>
                            <i class="la la-pencil"></i>
                            <span>{{ __('Editează') }}</span>
                        </span>
                    </a>
                    <a 
                        href="javascript:void(0);" 
                        class="btn btn-sm btn-outline-warning m-btn m-btn--icon"
                        @click="$emit('action', {action: 'change-password', record: user})"
                    >
                        <span>
                            <i class="la la-key"></i>
                            <span>{{ __('Schimbă parola') }}</span>
                        </span>
                    </a>
                    <a 
                        href="javascript:void(0);" 
                        class="btn btn-sm btn-outline-danger m-btn m-btn--icon"
                        @click="$emit('action', {action: 'delete', record: user})"
                    >
                        <span>
                            <i class="la la-trash"></i>
                            <span>{{ __('Șterge') }}</span>
                        </span>
                    </a>
                </p>
            </div>
        </div>
    </div>
    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'

    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
                dt: null,
            }
        },

        mounted()
        {
            this.dt = new AppCore.DatatableManager('grid-farm-users', {
                model: '\\App\\Models\\Farms\\Users\\User',
                grid: {
                    search_by_fields: [],
                }
            }, this)

            this.dt.addFilter('farm_id', {
                value: this.farm.id,
                where: 'farms_users.farm_id=[value]',
            }).populate()
        },

        methods: {
            userInfos(user)
            {
                let r = [];
                if(user.user.full_name)
                {
                    r.push(user.user.full_name);
                }
                if(user.user.email)
                {
                    r.push(user.user.email);
                }
                if(user.phone)
                {
                    r.push(user.phone);
                }
                return r.join(', ')
            },

            userRole(user)
            {
                if( user.user.roles.length == 0)
                {
                    return '-'
                }
                else
                {
                    return user.user.roles[0].name
                }
            }
        },

        computed: {
            records()
            {
                return this.dt.records
            }
        }
    }
</script>