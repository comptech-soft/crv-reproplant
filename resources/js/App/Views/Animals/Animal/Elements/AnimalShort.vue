<template>
    <div class="animal-short-container">
        <span class="animal-short-caption">{{ caption }}</span>
        <div v-if="animal">
            <div class="animal-short-long-name">
                <a href="javascript:void(0);" @click="onClick">
                    <span class="m-badge m-badge--brand m-badge--wide m-badge--rounded" v-if="animal.long_name" v-html="animal.long_name">
                    </span>
                    <span v-else class="m--font-info">{{ __('Necompletat') }}</span>
                </a>
            </div>
            <div class="animal-short-interbull_code">
                <span v-if="animal.interbull_code">
                    {{ animal.interbull_code}}
                </span>
                <span v-else class="m--font-info">{{ __('Necompletat') }}</span>
            </div>
        </div>
        <div v-else>
            <span class="m--font-warning">{{ __('Necunoscut') }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            caption: {required: true},
            animal: {required: true}
        },

        methods: {
            onClick()
            {
                this.$router.push({name: 'animal', params: {id: this.animal.id}})
            }
        }
    }
</script>

<style lang="scss" scoped>
    .animal-short-container
    {
        margin-bottom: 10px;
        .animal-short-caption
        {
            font-weight: bold;
        }
        .animal-short-long-name
        {
            a
            {
                &:hover
                {
                    span
                    {
                        text-decoration: underline;
                    }
                }
            }
        }
    }
</style>