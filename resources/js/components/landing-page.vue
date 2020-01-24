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

<div class="" v-if="status == false">
<div class="notification is-black" >
  <button class="delete" @click="status = null "></button>
  Data not saved will be lost if you navigate away from home
</div>
</div>

  <div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->

    <div class="column">  <!-- First column tag start -->
      <work-sheet @totalBag="updatedBag" @statusMethod="checkStatus"> </work-sheet>
    </div>  <!-- First column tag end -->


    <div class="column">  <!-- Second column tag start -->
     <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Stocks Graded Today </h2>
      <h1 class="subtitle is-bold has-text-black"> {{ getTodayRecord }}  </h1>
    </div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Total Graded In Store </h2>
      <h1 class="subtitle is-bold has-text-black"> {{ getTotalRecord }}</h1>
    </div>
  </div>  <!-- Second column tag end -->


  <div class="column">  <!-- Third column tag start -->
  	<div class="box has-text-centered">
  		<h2 class="subtitle has-text-black"> Recently Evacuated </h2>
  		<h1 class="subtitle is-bold has-text-black">None Yet</h1>
  	</div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black"> Total Stocks Evacuated </h2>
      <h1 class="subtitle is-bold has-text-black">None Yet</h1>
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

    totalStock: {
      arrayOfStock: [],
      sumOfStock: null,
    },

    todayStock: {
      sumOfTodayStuck: null,
    },

    myStyle: {
     marginTop: '2%',
   },
   
  } // Return calibrace close
  }, // data calibrace close

  mounted() {
    this.homeInventoryData()
  },

  methods: {

    homeInventoryData() {
      let api_url = "/api/home"
      this.axios
      .get(api_url).then((response) => {
        this.totalStock.arrayOfStock = response.data
      })
    },

    updatedBag: function(value) {
      this.totalBag = value
    },

    checkStatus: function(value) {
      this.status = value
    },

  },// method calibrace close


    computed: {
    // a computed getter
      getTotalRecord: function () {
        let oneBag = 64

      let weight = this.totalStock.arrayOfStock
      let weightCount = weight.length
      let LoopWeight = []
      for (let i = 0; i < weightCount; i++) {
        LoopWeight.push(parseFloat(weight[i].total_weight))
      }

        // Getting sum of weight
        let weightSum = LoopWeight.reduce(function(a, b){
          return a + b
        }, 0);


      let discount = this.totalStock.arrayOfStock
      let discountCount = weight.length
      let LoopDiscount = []
      for (let i = 0; i < discountCount; i++) {
        LoopDiscount.push(parseFloat(discount[i].total_discount))
      }

        // Getting sum of weight
        let discountSum = LoopDiscount.reduce(function(a, b){
          return a + b
        }, 0);

        let totalBags = (weightSum - discountSum) / oneBag 
        let convertToWhole = parseInt(totalBags)
        let calculate = oneBag * convertToWhole
        let totalWeightWithDiscount = weightSum - discountSum
        let calculateRemainder = totalWeightWithDiscount - calculate

        let overallBag = convertToWhole+"Bag"  +" Plus "+ " " +  calculateRemainder+"Kg"
        return this.totalStock.sumOfStock = overallBag
   },

   getTodayRecord: function () {
      let oneBag = 64
      let todayDate = '2020-01-23'

      let weight = this.totalStock.arrayOfStock
      let weightCount = weight.length
      let LoopWeight = []
      for (let i = 0; i < weightCount; i++) {
        let createdAt = weight[i].created_at
        if(createdAt === todayDate) {
        LoopWeight.push(parseFloat(weight[i].total_weight))
      }
      }

        // Getting sum of weight
        let weightSum = LoopWeight.reduce(function(a, b){
          return a + b
        }, 0);


      let discount = this.totalStock.arrayOfStock
      let discountCount = weight.length
      let LoopDiscount = []
      for (let i = 0; i < discountCount; i++) {
        let createdAt = weight[i].created_at
        if(createdAt === todayDate) {
        LoopDiscount.push(parseFloat(discount[i].total_discount))
      }
      }

        // Getting sum of weight
        let discountSum = LoopDiscount.reduce(function(a, b){
          return a + b
        }, 0);

        let totalBags = (weightSum - discountSum) / oneBag 
        let convertToWhole = parseInt(totalBags)
        let calculate = oneBag * convertToWhole
        let totalWeightWithDiscount = weightSum - discountSum
        let calculateRemainder = totalWeightWithDiscount - calculate

        let overallBag = convertToWhole+"Bag"  +" Plus "+ " " +  calculateRemainder+"Kg"
        return this.todayStock.sumOfTodayStock = overallBag
   }

  } //Computed calibrace closes

}

</script>


























