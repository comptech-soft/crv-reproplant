<template>
    <div class="m-widget3__header" style="width:100%">
        <div class="m-widget3__info" style="width:100%">
            <div class="row">
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Crotalie') }}<br/>
                        <span class="value">{{ cow.animal.matricol_number }}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Număr scurt') }}<br/>
                        <span class="value">{{ cow.short_number || '-'}}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Număr intern') }}<br/>
                        <span class="value">{{ cow.internal_number || '-'}}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Data nașterii') }}<br/>
                        <span class="value">{{ cow.animal.birth_date || '-'}}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Data ultimei fătări')  }}<br/>
                        <span class="value">{{ cow.animal.last_calving_date || '-'}}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Paritate')  }}<br/>
                        <span class="value">{{ cow.animal.parity || '-'}}</span>
                    </span>
                </div>
                <div class="col">
                    <span class="m-widget3__username">
                        {{ __('Rasa')  }}<br/>
                        <span class="value">{{ cow.animal.breed_id ? cow.animal.breed.breed + ' (' + cow.animal.breed.code + ')' : '-'}}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cow: {required: true}
        }
    }
</script>

<style lang="scss" scoped>
    .m-widget3__header
    {
        display: block !important;
        .m-widget3__info
        {
            display: block !important;
            padding: 1rem 0 !important;
            .m-widget3__username
            {
                font-size: 0.85rem;
                color: #716aca;
                span.value
                {
                    font-weight: 100;
                    font-size: 1rem;
                    color: #000;
                }
            }
        }
    }
</style>