<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_responsive.scss";


.box
  {
  box-shadow: 8px 8px 4px $black;
}


</style>


<template>

<div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->


  <div class="column">  <!-- First column tag start -->
<div class="box has-text-centered has-background-info">
<h4 class="title is-4 has-text-white"> Work-Sheet</h4>
  <i class="fas fa-plus fa-10x has-text-white"> </i> 
</div>
  </div>  <!-- First column tag end -->


  <div class="column">  <!-- Second column tag start -->
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Starting Stocks Before Delivery </h2>
  		<h1 class="title is-bold has-text-black">178</h1>
  	</div>
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Stocks Recieved Today </h2>
  		<h1 class="title is-bold has-text-black">200</h1>
  	</div>
  </div>  <!-- Second column tag end -->



  <div class="column third_column">  <!-- Third column tag start -->
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Remaining Stocks After Delivery </h2>
  		<h1 class="title is-bold has-text-black">45</h1>
  	</div>
    <div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Stocks Dispatch Today </h2>
  		<h1 class="title is-bold has-text-black">218</h1>
  	</div>
  </div>  <!-- Third column tag end -->

</div>  <!-- Columns wrapper -->

</template>

<script>

export default {

data() {

	return{
		myStyle: {
			marginTop: '6%',
		},

		}
	},

}

</script>


























