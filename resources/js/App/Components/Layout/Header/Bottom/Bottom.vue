<template>
    <div class="m-header__bottom">
		<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
			<div class="m-stack m-stack--ver m-stack--desktop">
				<horizontal-menu></horizontal-menu>
				<search></search>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        components: {
			'horizontal-menu': require('./~components/Menu'),
			'search': require('./~components/Search'),
		},
		
		name: 'app-header-bottom'
    }
</script>