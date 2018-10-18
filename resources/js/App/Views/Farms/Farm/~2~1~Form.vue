<template>
    <div v-if="farm && fm">

        <div v-if="action=='delete'" class="alert alert-danger alert-dismissible m-alert m-alert--air m-alert--square" role="alert">
            <strong>{{__('Confirmare!')}}</strong> 
            {{ __('Sunteți sigur că doriți ștergerea utilizatorului :name: de la ferma :farm:?', {
                name: old.user.full_name,
                farm: farm.farm,
            }) }}
        </div>

        <form-box :formManager="fm">
            <div v-if="action != 'change-password'" class="row">
                <div class="col col-md-2">
                    <simple-select
                        id="role"
                        :label="__('Rolul')"
                        :ajax="ajax_roles"
                        :disabled="action == 'delete'"
                        v-model="record.role"
                        :errors="fm.errors"
                    >
                    </simple-select>
                </div>
                <div class="col col-md-5">                
                    <textbox
                        id="last_name"
                        :label="__('Nume')"
                        :placeholder="__('Nume')"
                        maxlength="191"
                        :disabled="action == 'delete'"
                        v-model="record.last_name"
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
                <div class="col col-md-5">
                    <textbox
                        id="first_name"
                        :label="__('Prenume')"
                        :placeholder="__('Prenume')"
                        maxlength="191"
                        :disabled="action == 'delete'"
                        v-model="record.first_name"
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
            </div>

            <div v-if="action != 'change-password'" class="row">
                <div class="col col-md-6">                
                    <textbox
                        id="email"
                        :label="__('Adresa de email')"
                        :placeholder="__('Adresa de email')"
                        maxlength="191"
                        :disabled="action == 'delete'"
                        v-model="record.email"
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
                <div class="col col-md-6">
                    <textbox
                        id="phone"
                        :label="__('Telefon')"
                        :placeholder="__('Telefon')"
                        maxlength="64"
                        :disabled="action == 'delete'"
                        v-model="record.phone"
                        :errors="fm.errors"
                    >
                    </textbox>
                </div>
            </div>

            <div class="row" v-if="(action == 'insert') || (action == 'change-password')">
                <div class="col col-md-6">                
                    <passwordbox
                        id="password"
                        :label="__('Parola')"
                        :placeholder="__('Parola')"
                        maxlength="32"
                        :disabled="action == 'delete'"
                        v-model="record.password"
                        :errors="fm.errors"
                    >
                    </passwordbox>
                </div>
            </div>
        </form-box>

        <div class="row">
            <div class="col">
                <button 
                    type="button" 
                    :class="buttonType + (fm.submitting ? ' m-loader m-loader--light m-loader--right': '')" 
                    @click="save"
                >
                    <i :class="buttonIcon"></i>
                    {{ __(buttonCaption) }}
                </button>
                <button 
                    type="button" 
                    class="btn btn-secondary" 
                    @click="$emit('cancel')"
                >
                    <i class="la la-times"></i>
                    {{ __('Renunță') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>

    import AppCore from 'comptechsoft-app-starter'

    export default {
        props: {
            farm: {required: true},
            action: {required: true},
            old: {required: true},
        },

        data()
        {
            return {
                fm: null,
                record: {
                    id: null,
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    password: '',
                    role: '',
                }
            }
        },

        methods: {
            fillRecord()
            {
                _.each(this.record, (value, field) => this.record[field] = this.old[field])
                this.record.first_name = this.old.user.first_name
                this.record.last_name = this.old.user.last_name
                this.record.email = this.old.user.email
                this.record.role = this.old.user.roles[0].id
            },

            save()
            {
                this.fm.onClickSubmit(
                    'farms/save-user', 
                    this.rules,
                    data => {
                        if(data.success)
                        {
                            this.notySuccess(data.result.message)
                            this.$emit('cancel')
                        }
                        else
                        {
                            this.notyError(data.result.message)
                        }
                    }
                )
            }
        },

        computed: {

            rules()
            {
                if(this.action == 'delete')
                {
                    return null
                }
                let r = {
                    first_name: 'required',
                    last_name: 'required',
                    email: 'required|email',
                    role: 'required',
                }
                if( (this.action == 'insert') || (this.action == 'change-password') )
                {
                    r['password'] = 'required'
                }
                return r
            },

            ajax_roles()
            {
                return {
                    endpoint: 'api/get-datatable-rows',
                    data: {
                        model: '\\Comptechsoft\\Helpers\\Models\\Cartalyst\\Roles\\Role',
                        order_by: {field: 'roles.name', dir: 'asc'},
                        filter_by_fields: {
                            type: {
                                value: 'ferma',
                                where: 'roles.type=[value]'
                            }
                        }
                    },
                    map: {id: 'id', text: 'name'}
                }
            },
        },

        mounted()
        {
            if( this.action != 'insert')
            {
                this.fillRecord()
            }
            this.fm = new AppCore.FormManager('farm-users-form', this)
            this.fm.getData = () => {
                return {
                    action: this.action,
                    record: this.record,
                    farm_id: this.farm.id,
                    old: this.old
                }
            }
        }
    }
</script>