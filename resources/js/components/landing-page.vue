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

  <div class="">

<div class="" v-if="status">
<div class="notification is-black" >
  <button class="delete" @click="status = false"></button>
  Task added succesfull tap or click <router-link :to="{ name: 'history' }"> <i class="fas fa-history ">history</i> </router-link> for review
</div>
</div>

  <div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->

    <div class="column">  <!-- First column tag start -->
      <work-sheet @totalBag="updatedBag" @statusMethod="checkStatus"> </work-sheet>
    </div>  <!-- First column tag end -->


    <div class="column">  <!-- Second column tag start -->
     <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Recently Graded Stocks </h2>
      <h1 class="subtitle is-bold has-text-black"> {{ totalBag }}  </h1>
    </div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Graded In Store </h2>
      <h1 class="subtitle is-bold has-text-black">200</h1>
    </div>
  </div>  <!-- Second column tag end -->


  <div class="column">  <!-- Third column tag start -->
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Recently Evacuated </h2>
  		<h1 class="subtitle is-bold has-text-black">45</h1>
  	</div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Total Stocks Evacuated </h2>
      <h1 class="subtitle is-bold has-text-black">218</h1>
    </div>
    <button class="button is-link is-pulled-right is-rounded"> Download Full Report </button>
  </div>  <!-- Third column tag end -->

</div>  <!-- Columns wrapper -->

</div>

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

    status: null,

    totalBag: "No Recent Entry",

    myStyle: {
     marginTop: '2%',
   },

   
  } // Return calibrace close
  }, // data calibrace close

  methods: {
    updatedBag: function(value) {
      this.totalBag = value
    },

    checkStatus: function(value) {
      this.status = value
    }

  }// method calibrace close

}

</script>


























