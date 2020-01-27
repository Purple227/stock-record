<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_responsive.scss";

.box
{
  box-shadow: 6px 6px 3px $black;
}

.sheet
{
  cursor: pointer;
}

</style>


<template>

  <div class="">

    <div class="" v-if="status">
      <div class="notification is-black" >
        <button class="delete" @click="status = null"></button>
        Task added succesfull tap or click <router-link :to="{ name: 'history' }"> <i class="fas fa-history ">history</i> </router-link> for review
      </div>
    </div>

    <div class="" v-if="status == false">
      <div class="notification is-black" >
        <button class="delete" @click="status = null "></button>
        Please data not saved will be lost if you navigate out of the homepage.
      </div>
    </div>

    <div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->

      <div class="column">  <!-- First column tag start -->

        <div class="buttons is-centered" v-if="workSheet">
        <arrived-sheet @triggerMethod="statusUpdate"> </arrived-sheet>
        <evacuated-sheet> </evacuated-sheet>
        </div>

        <div class="box has-text-centered has-background-info sheet" @click="workSheet = !workSheet">
          <h4 class="title is-4 has-text-white"> Work-Sheet</h4>
          <i class="fas fa-plus fa-10x has-text-white"> </i> 
        </div>

      </div>  <!-- First column tag end -->


      <div class="column">  <!-- Second column tag start -->
       <div class="box has-text-centered">
        <h2 class="subtitle has-text-black is-bold"> Daily Record </h2>
        <h1 class="subtitle has-text-black"> {{ getTodayRecord }}  </h1>
      </div>
      <div class="box has-text-centered">
        <h2 class="subtitle has-text-black is-bold"> Stock At Hand </h2>
        <h1 class="subtitle has-text-black"> {{ getTotalRecord }}</h1>
      </div>
    </div>  <!-- Second column tag end -->


    <div class="column">  <!-- Third column tag start -->
     <div class="box has-text-centered">
      <h2 class="subtitle has-text-black is-bold"> Evacuated Stock </h2>
      <h1 class="subtitle has-text-black">Working On It</h1>
    </div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black is-bold"> Think Pad </h2>
      <h1 class="subtitle has-text-black">UI strategy</h1>
    </div>
    <button class="button is-link is-pulled-right is-rounded"> Download Full Report </button>
  </div>  <!-- Third column tag end -->

</div>  <!-- Columns wrapper -->

</div>

</template>


<script>
import ArrivedSheetModal from './modals/arrived-sheet.vue'
import EvacuatedSheetModal from './modals/evacuated-sheet.vue'

export default {
  name: "landing-page",

  components: 
  {
    'arrived-sheet': ArrivedSheetModal,
    'evacuated-sheet': EvacuatedSheetModal,
  },

  data() {

   return{

    status: null,
    workSheet: false,

    todayStock: {
      sumOfTodayStuck: null,
    },

    totalStock: {
      arrayOfStock: [],
      sumOfStock: null,
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

    statusUpdate: function(value) {
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
      let todayDate = this.moment().format('YYYY-MM-DD')
      //let todayDateFormat = todayDate.getFullYear() + "-" + todayDate.getMonth() + "-" + todayDate.getDate()

      let weight = this.totalStock.arrayOfStock
      let weightCount = weight.length
      let LoopWeight = []
      for (let i = 0; i < weightCount; i++) {
        let createdAt = weight[i].created_at.slice(0,10)
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
        let createdAt = discount[i].created_at.slice(0,10)
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


























