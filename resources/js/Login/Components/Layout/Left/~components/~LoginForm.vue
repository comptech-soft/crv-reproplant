<template>
    <div v-if="formManager" class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">
                {{ __('Intră în platforma CRV Reproplant') }}
            </h3>
        </div>
        
        <form-box
            formClass="m-login__form"
            :formManager="formManager"
        >
        
            <textbox
                id="email"
                :placeholder="__('Adresa de email')"
                v-model="record.email"
                :errors="formManager.errors"
            >
            </textbox>
            
            <passwordbox
                id="password"
                :placeholder="__('Parola')" 
                v-model="record.password"
                :errors="formManager.errors"
            >
            </passwordbox>
         
            <div class="row m-login__form-sub">
                
                <div class="col m--align-left">
                    <checkbox
                        :caption="__('Ține-mă minte')"
                        v-model="record.remember"
                        >
                    </checkbox>
                </div>

                <div class="col m--align-right">
                    <a href="javascript:;" id="m_login_forget_password" class="m-link">
                        {{ __('Ai uitat parola?') }}
                    </a>
                </div>
            </div>
                
            <div class="m-login__form-action">
                <button 
                    type="button"
                    id="m_login_signin_submit" 
                    class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                    @click.prevent="onSubmit"
                >
                    {{ __('Intră') }}
                </button>
            </div>
        </form-box>
    </div>                
</template>

<script>
    import AppCore from 'comptechsoft-app-starter'

    export default {
        data(){
            return {
                formManager: null,
                record: {
                    email: 'ovidiu.andrus@comptech.ro',
                    password: 'babalean',
                    remember: 0,
                }
            }
        },

        methods:
        {
            onSubmit()
            {
                this.formManager.onClickSubmit(
                    'login', 
                    {
                        email: 'required|email',
                        password: 'required'
                    },
                    data => {
                        this.notySuccess(this.__('Salut :name: !<br/>Bine ai venit!', {name: data.result.payload.user.full_name}))
                        this.redirectTo(this.$app.url, 500)
                    }
                )
            }
            
        },

        mounted()
        {
            this.formManager = new AppCore.FormManager('login-form', this)
        }
    }
</script>