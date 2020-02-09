<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";
@import "~animate.css/animate";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_color.scss";

.second_column
	{
	background-color: $light-grey;
	border: 2px solid $light-grey;
	border-radius: 10px;
}

.v-enter-active
	{
	animation: bounceIn 1.5s; 
}


@keyframes bounceIn
{

50% {
transform: scale(0.5);
} 

100% {
transform: scale(1);
}

}

</style>


<template>

	<div class="container">  <!-- Container tag open -->

<div class="columns is-mobile">  <!-- Columns wrapper -->

  <div class="column is-1-desktop first_column is-3-mobile">  <!-- First column tag end -->
	    <sidebar> </sidebar>
  </div>  <!-- First column tag end -->

  <div class="column is-11-desktop is-9-mobile second_column">  <!-- Second column tag start -->
    <navbar> </navbar>
    <transition>
	    <router-view v-if="guard"> </router-view>
	    <login v-else> </login>
	</transition>
  </div>   <!-- Second column tag end -->

</div>   <!-- Columns wrapper -->

</div>  <!-- Container tag close -->

</template>


<script>

import Navbar from './partials/navbar.vue'
import Sidebar from './partials/sidebar.vue'
import Login from '../components/modals/login.vue'

export default 
{

	name: "app",

	components: 
	{
		'navbar': Navbar,
		'sidebar': Sidebar,
		'login': Login,
	},

	data() {
		return{
			guard: false,
		}
	},

	mounted() {
		this.loginGuard()
	},

	methods: {

		loginGuard() {
			let api_url = "guard"
			this.axios
			.get(api_url).then((response) => {
				this.guard = response.data
			})
		},

}//method calibrace closes

}

</script>
