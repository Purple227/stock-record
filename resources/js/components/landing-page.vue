<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_responsive.scss";

.box
{
  box-shadow: 6px 6px 3px $black;
}

</style>


<template>



  <div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->

    <div class="column">  <!-- First column tag start -->
      <work-sheet @totalBag="updatedBag"> </work-sheet>
    </div>  <!-- First column tag end -->


    <div class="column">  <!-- Second column tag start -->
     <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Graded Stocks Today </h2>
      <h1 class="title is-bold has-text-black" v-text="totalBag">  </h1>
    </div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Total Graded In Store </h2>
      <h1 class="title is-bold has-text-black">200</h1>
    </div>
  </div>  <!-- Second column tag end -->



  <div class="column">  <!-- Third column tag start -->
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Stocks Evacuated Today </h2>
  		<h1 class="title is-bold has-text-black">45</h1>
  	</div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Ungraded Stocks Today </h2>
      <h1 class="title is-bold has-text-black">218</h1>
    </div>
    <button class="button is-link is-pulled-right is-rounded"> Download Full Report </button>
  </div>  <!-- Third column tag end -->

</div>  <!-- Columns wrapper -->

</template>


<script>
import WorkSheetModal from './modals/work-sheet.vue'

export default {
  name: "landing-page",

 components: 
  {
    'work-sheet': WorkSheetModal,
  },

  data() {

   return{
    myStyle: {
     marginTop: '4%',
   },

   totalBag: null,
  } // Return calibrace close
  }, // data calibrace close

  methods: {
    updatedBag: function(value) {
      this.totalBag = value
    }

  }// meyhod calibrace close

}

</script>


























