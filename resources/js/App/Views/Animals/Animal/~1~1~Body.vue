<template>
    <div class="m-portlet m-portlet--full-height">
        <div class="m-portlet__head" style="background-color: transparent">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text" style="color: #666">
                        {{ __('Pedigree') }}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools" style="align-items: center">
                <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                    <li v-for="base in calculation_bases" class="nav-item m-tabs__item" :key="'calculation-base-' + base.id">
                        <a 
                            :class="{
                                'nav-link': true, 
                                'm-tabs__link': true, 
                                active: base.active,
                            }" 
                            href="javascript:void(0);"
                            @click.prevent="$emit('current', base.id)"
                        >
                            {{ base.text }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col">
                    <general-characteristics 
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </general-characteristics>
                    <other-traits 
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </other-traits>
                </div>
                <div class="col">
                    <pedigree 
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </pedigree>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <breeding-values
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </breeding-values>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <production
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </production>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <functional-traits
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </functional-traits>
                </div>
                <div class="col">
                    <exterior-traits
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </exterior-traits>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <feed-intake
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </feed-intake>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <lifetime-production
                        :animal="animal" 
                        :characteristics="characteristics"
                    >
                    </lifetime-production>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            animal: {required: true},
            calculation_bases: {required: true},
            current: {required: true},
            characteristics: {required: true},
        },

        components:
        {
            'general-characteristics': require('./Characteristics/~1~General'),
            'pedigree': require('./Characteristics/~2~Pedigree'),
            'breeding-values': require('./Characteristics/~3~BreedingValues'),
            'production': require('./Characteristics/~4~Production'),
            'feed-intake': require('./Characteristics/~5~FeedIntake'),
            'lifetime-production': require('./Characteristics/~6~LifetimeProduction'),
            'other-traits': require('./Characteristics/~7~OtherTraits'),
            'functional-traits': require('./Characteristics/~8~FunctionalTraits'),
            'exterior-traits': require('./Characteristics/~9~ExteriorTraits'),
        }

    }
</script>