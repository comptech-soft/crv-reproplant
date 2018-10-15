<template>
    <form-box>
        <div class="row">
            <div class="col col-md-6">
                <textbox
                    id="name"
                    :label="__('Numele țării')"
                    :placeholder="__('Numele țării')"
                    maxlength="128"
                    :disabled="action == 'delete'"
                    v-model="record.name"
                    :errors="errors"
                >
                </textbox>
            </div>
            <div class="col col-md-6">
                <textbox
                    id="code"
                    :label="__('Codul țării')"
                    :placeholder="__('Codul țării')"
                    maxlength="2"
                    :disabled="action == 'delete'"
                    v-model="record.code"
                    :errors="errors"
                >
                </textbox>
            </div>
        </div>
    </form-box>
</template>

<script>
    export default {    
        
        data()
        {
            return {
                errors: null,
                action: null,
                record: {
                    id: null,
                    name: '',
                    code: '',
                    icon: '',
                }
            }
        }
    }
</script>