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

</style>


<template>

	<div class="container">  <!-- Container tag open -->

<div class="columns is-mobile">  <!-- Columns wrapper -->

  <div class="column is-1-desktop first_column is-3-mobile">  <!-- First column tag end -->
	    <sidebar> </sidebar>
  </div>  <!-- First column tag end -->

  <div class="column is-11-desktop is-9-mobile second_column">  <!-- Second column tag start -->
    <navbar> </navbar>
    <router-view> </router-view>
  </div>   <!-- Second column tag end -->

</div>   <!-- Columns wrapper -->

</div>  <!-- Container tag close -->

</template>


<script>

import Navbar from './partials/navbar.vue'
import Sidebar from './partials/sidebar.vue'

export default 
{

	name: "app",

	components: 
	{
		'navbar': Navbar,
		'sidebar': Sidebar,
	},

}

</script>