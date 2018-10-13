<template>
    <li :class="item_class">
        <span 
            v-if="is_text"
            class="m-nav__section-text"
        >
            {{ caption }}

        </span>

        <anchor 
            v-else-if="is_link"
            tagClass="m-nav__link"
        >
            <i 
                v-if="item.iconClass" 
                :class="icon_class"
            >
            </i>
            <span class="m-nav__link-title">
                <span class="m-nav__link-wrap">
                    <span v-if="caption" class="m-nav__link-text">
                        {{ caption }}
                    </span>
                    <span v-if="badge" class="m-nav__link-badge">
                        <span class="m-badge m-badge--success">
                            {{ badge }}
                        </span>
                    </span>
                </span>
             </span>
        </anchor>

        <anchor 
            v-else-if="is_button" 
            :class="button_class"

            @click="$emit('click', item.event)"
        >
            {{ caption }}
        </anchor>

        <a 
            v-else-if="is_tab" 
            :class="'nav-link m-tabs__link' + (item.hasOwnProperty('active') && item.active ? ' active' : '')" 
            data-toggle="tab" 
            :href="item.href" 
            role="tab"
        >
            {{ caption }}
        </a>

    </li>
</template>

<script>
    export default
    {
        props:
        {
            item: {type: Object, required: true}
        },

        computed:
        {
            item_class()
            {
                if(this.item.hasOwnProperty('itemClass'))
                {
                    return this.makeClass(this.item.itemClass, {}, true)
                }
                if( this.is_tab )
                {
                    return {
                        'nav-item' : true,
                        'm-tabs__item': true,
                    }
                }
                return {
                    'm-nav__item': true
                }
            },

            icon_class()
            {
                return this.item.hasOwnProperty('iconClass')
                    ? this.makeClass(this.item.iconClass, {}, true)
                    : {}
            },

            button_class()
            {
                return this.item.hasOwnProperty('buttonClass')
                    ? this.makeClass(this.item.buttonClass, {}, true)
                    : {}
            },

            is_text()
            {
                return this.has_type('text')
            },

            is_link()
            {
                return this.has_type('link')
            },

            is_button()
            {
                return this.has_type('button')
            },

            is_tab()
            {
                return this.has_type('tab')
            },

            caption()
            {
                return this.item.hasOwnProperty('caption') ? this.item.caption : ''
            },

            badge()
            {
                return this.item.hasOwnProperty('badge') ? this.item.badge : ''
            },



        },

        methods:
        {
            has_type(type)
            {
                return this.item.hasOwnProperty('type') && (this.item.type == type)
            }
        },

        name: 'dropdown-item'
    }
</script>