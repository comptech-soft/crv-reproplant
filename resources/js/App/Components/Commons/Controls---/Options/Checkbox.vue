<template>
    <div :class="form_group_class">
        <label class="m-checkbox m-checkbox--focus">
            <input 
                :id="id"
                :class="form_control_class" 
                :name="get_control_name" 
                :checked="value"
                type="checkbox"

                @change="onChange"
            /> 
                {{ caption }}
            <span></span>
        </label>
    </div>
</template>

<script>
    export default
    {
        
        mixins:
        [
            require('./../~Mixins/~Props'),
            require('./../~Mixins/~Computed'),  
            require('./~Props'),
            require('./~Computed'),  
            require('./~Methods'),  
        ],


        name: 'check-box'
    }
</script>