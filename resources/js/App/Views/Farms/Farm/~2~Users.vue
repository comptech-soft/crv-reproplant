<template>
    <div v-if="farm">
        <div class="m-alert m-alert--icon alert alert-info m-alert--square m-alert--outline" role="alert">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                <strong>{{ __('Atenție') }}.</strong> 
                {{ __('Aici se vizualizează lista utilizatorilor, se definesc și se editează utilizatorii fermei :nume:.', {nume: farm.farm}) }}
            </div>
            <div v-if="! visible" class="m-alert__actions" style="width: 160px;">
                <button type="button" class="btn btn-warning btn-sm m-btn m-btn--wide" @click="showForm('insert', null)">
                    {{ __('Adaugă utilizator') }}
                </button>
            </div>
        </div>

        <div v-if="visible">
            <user-form 
                :farm="farm"
                :action="action"
                :old="record"
                @cancel="hideForm"
            >
            </user-form>
        </div>

        <div v-else>
            <user-list 
                :farm="farm"
                @action="onClickAction"
            >
            </user-list>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            farm: {required: true},
        },

        data(){
            return {
                visible: false,
                action: null,
                record: null,
            }
        },

        methods: {
            showForm(action, record)
            {
                this.visible = true
                this.action = action
                this.record = record
            },

            hideForm()
            {
                this.visible = false
                this.action = null
                this.record = null
            },

            onClickAction(e)
            {
                this.showForm(e.action, e.record)
            }
        },

        components: {
            'user-form': require('./~2~1~Form'),
            'user-list': require('./~2~2~List')
        }
    }
</script>