<template>
    <div 
        v-if="items.length" 
        :class="timeline_class"
    >
        <div class="m-list-timeline__items">
            <div 
                v-for="(item, index) in items" 
                :class="item.itemClass"
            >
                <span class="m-list-timeline__badge"></span>
				<span class="m-list-timeline__text">
                    {{ item.caption }}
                    <span class="m-badge m-badge--success m-badge--wide">pending</span>
                </span>
				<span class="m-list-timeline__time">{{ item.time }}</span>

            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        props: 
        {
            timelineClass: {default: null},
            items: {default: () => []}
        },

        computed:
        {
            timeline_class()
            {
                if( this.timelineClass )
                {
                    return timelineClass
                }
                return {
                    'm-list-timeline': true,
                }
                    // 'm-list-timeline--skin-light
            }
        },

        name: 'timeline'
    }
</script>