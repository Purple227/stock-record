<style lang="scss">
  @import "../../sass/bulma.scss";


.second_column
{
	background-color: #f9f9f9;
}

body {
  display:flex; 
  flex-direction:column; 
  justify-content:center;
  min-height:100vh;
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

	components: 
	{
		Navbar,
		Sidebar,
	},

}

</script>