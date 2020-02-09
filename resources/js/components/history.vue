<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import '~bulma-calendar/dist/css/bulma-calendar.min.css';
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_responsive.scss";


</style>

<template>

<div>

<div class="buttons has-addons is-right" v-bind:style="myStyle">
  <button class="button is-rounded"  @click="arrivedComponent"> Arrived Table </button>
  <button class="button is-rounded" @click="evacuateComponent"> Evacuated Table </button>
</div>

<keep-alive>
 <component v-bind:is="componentToggle"></component>
</keep-alive>

</div>

</template>


<script>
import Arrived from './history/arrived.vue'
import Evacuate from './history/evacuate.vue'

export default{
	name: 'history',

	components: {
		'arrived': Arrived,
		'evacuate': Evacuate
	},

	data() {
		return{
			componentToggle: 'arrived',
			myStyle: {
				marginTop: '2%',
			},
		}
	},

	methods: {

		arrivedComponent() {
			this.componentToggle = 'arrived'
		},

		evacuateComponent: function() {
			this.componentToggle = 'evacuate'
		},

	},

}
</script>


