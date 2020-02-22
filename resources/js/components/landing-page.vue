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
  transition: all 0.6s;
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
        Please stocks not saved will be lost if you navigate out of the homepage.
      </div>
    </div>

    <div class="columns" v-bind:style="myStyle">  <!-- Columns wrapper -->

      <div class="column">  <!-- First column tag start -->

        <div class="buttons is-centered" v-if="workSheet">
        <arrived-sheet @triggerArrivedStatus="statusUpdate"> </arrived-sheet>
        <evacuated-sheet @triggerEvacuateStatus="statusUpdate"> </evacuated-sheet>
        </div>

        <div class="box has-text-centered has-background-info sheet" @click="workSheet = !workSheet">
          <h4 class="title is-4 has-text-white"> Work-Sheet</h4>
          <i class="fas fa-plus fa-10x has-text-white"> </i> 
        </div>

      </div>  <!-- First column tag end -->


      <div class="column">  <!-- Second column tag start -->
       <div class="box has-text-centered">
        <h2 class="subtitle has-text-black is-bold"> Stocks Arrived Today </h2>
        <h1 class="subtitle has-text-black"> {{ getTodayArrivedBags }}  </h1>
      </div>
      <div class="box has-text-centered">
        <h2 class="subtitle has-text-black is-bold"> Total Stocks In Store </h2>
        <h1 class="subtitle has-text-black"> {{ getTotalArrivedBags }}</h1>
      </div>
    </div>  <!-- Second column tag end -->


    <div class="column">  <!-- Third column tag start -->
     <div class="box has-text-centered">
      <h2 class="subtitle has-text-black is-bold"> Stocks Evacuated Today </h2>
      <h1 class="subtitle has-text-black"> {{ getTodayEvacuatedBag }}</h1>
    </div>
    <div class="box has-text-centered">
      <h2 class="subtitle has-text-black is-bold"> Total Stocks Evacuated </h2>
      <h1 class="subtitle has-text-black"> {{ getTotalEvacuatedBag }} </h1>
    </div>
    <button class="button is-link is-pulled-right is-rounded"> Download Full Report </button>
  </div>  <!-- Third column tag end -->

</div>  <!-- Columns wrapper -->
<navbar v-if='false' title="blah blaH blah"></navbar>
</div>

</template>


<script>
import ArrivedSheetModal from './modals/arrived-sheet.vue'
import EvacuatedSheetModal from './modals/evacuated-sheet.vue'
import status from '../mixins/status'
import Navbar from '../layouts/partials/navbar.vue'

export default {
  name: "landing-page",

  mixins: [
  status
 ],

  components: 
  {
    'arrived-sheet': ArrivedSheetModal,
    'evacuated-sheet': EvacuatedSheetModal,
    'navbar': Navbar,
  },

  data() {

   return{

    status: null,
    workSheet: false,
    
    arrived: {
      arrayArrived: [],
      sumArrived: null,
      todayArrivedSum: null
    },

    evacuated: {
      arrayEvacuated: [],
      sumEvacuated: null,
      todayEvacuatedSum: null,
    },

    myStyle: {
     marginTop: '2%',
   },
   
  } // Return calibrace close
  }, // data calibrace close

  created() {
    this.arrivedData()
    this.evacuatedData()
  },

  methods: {

    arrivedData() {
      let api_url = "/api/home/arrived"
      this.axios
      .get(api_url).then((response) => {
        this.arrived.arrayArrived = response.data
      })
    },

    evacuatedData() {
      let api_url = "/api/home/evacuated"
      this.axios
      .get(api_url).then((response) => {
        this.evacuated.arrayEvacuated = response.data
      })
    },


    statusUpdate: function(value) {
      this.status = value
      if(this.status == true) {
        setTimeout(() => {
          this.$router.go()
        }, 500)
      }

    },

  },// method calibrace close

    computed: {
    // a computed getter
      getTotalArrivedBags: function () {
      let oneBag = 64

      let weight = this.arrived.arrayArrived
      let weightCount = weight.length
      let LoopWeight = []
      for (let i = 0; i < weightCount; i++) {
        LoopWeight.push(parseFloat(weight[i].total_weight))
      }

        // Getting sum of weight
        let weightSum = LoopWeight.reduce(function(a, b){
          return a + b
        }, 0);


      let discount = this.arrived.arrayArrived
      let discountCount = weight.length
      let LoopDiscount = []
      for (let i = 0; i < discountCount; i++) {
        LoopDiscount.push(parseFloat(discount[i].total_discount))
      }

        // Getting sum of weight
        let discountSum = LoopDiscount.reduce(function(a, b){
          return a + b
        }, 0);

        let totalBags = parseInt((weightSum - discountSum) / oneBag)
        let calculate = oneBag * totalBags
        let totalWeightWithDiscount = weightSum - discountSum
        let calculateRemainder = totalWeightWithDiscount - calculate

        let overallWeight = totalBags +"."+ calculateRemainder
        overallWeight = parseFloat(overallWeight)

        let sumEvacuated = parseInt(this.evacuated.sumEvacuated)

        let overallBag = overallWeight - sumEvacuated
        overallBag = overallBag//.toFixed(2)

        if (weightSum == 0) {
          return this.arrived.sumArrived = "Nothing In Store"
        } else if (this.evacuated.sumEvacuated == "No Stock Evacuated") {
          overallWeight = overallWeight.toString()
          overallWeight = overallWeight.split(".")
          if (overallWeight.length == 1) {
            overallWeight[1] = 0
          }
          overallWeight = overallWeight[0] +"Bags"  +" Plus "+ " " + overallWeight[1]+"Kg"
          return this.arrived.sumArrived = overallWeight
        } else if (overallBag > 1) {
          overallBag = overallBag.toString()
          overallBag = overallBag.split(".")
          overallBag = overallBag[0] +"Bags"  +" Plus "+ " " + overallBag[1]+"Kg"
          return this.arrived.sumArrived = overallBag
        } else {
          return this.arrived.sumArrived = "You Evacuated Morethan You Have In Store"
        }
   },

   getTodayArrivedBags: function () {
      let oneBag = 64
      let todayDate = this.moment().format('YYYY-MM-DD')
      //let todayDateFormat = todayDate.getFullYear() + "-" + todayDate.getMonth() + "-" + todayDate.getDate()

      let weight = this.arrived.arrayArrived
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


      let discount = this.arrived.arrayArrived
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
        if (totalBags >= 0.1) {
          return this.arrived.todayArrivedSum = overallBag
        } else {
          return this.arrived.todayArrivedSum = "No Stock Added Today"
        }
        
   },

   getTotalEvacuatedBag: function () {
      let oneBag = 64

      let evacuated = this.evacuated.arrayEvacuated
      let evacuatedCount = evacuated.length
      let LoopEvacuated = []
      for (let i = 0; i < evacuatedCount; i++) {
        LoopEvacuated.push(parseFloat(evacuated[i].weight))
      }

        // Getting sum of weight
        let evacuatedSum = LoopEvacuated.reduce(function(a, b){
          return a + b
        }, 0);

        let totalBags = evacuatedSum / oneBag 

        if (totalBags >= 1) {
          return this.evacuated.sumEvacuated = totalBags+"Bags"
        } else {
          return this.evacuated.sumEvacuated = "No Stock Evacuated"
        }
        
   },

   getTodayEvacuatedBag: function () {
      let oneBag = 64
      let todayDate = this.moment().format('YYYY-MM-DD')

      let evacuated = this.evacuated.arrayEvacuated
      let evacuatedCount = evacuated.length
      let LoopEvacuated = []
      for (let i = 0; i < evacuatedCount; i++) {
        let createdAt = evacuated[i].created_at.slice(0,10)
        if(createdAt === todayDate) {
        LoopEvacuated.push(parseFloat(evacuated[i].weight))
      }
      }

        // Getting sum of weight
        let evacuatedSum = LoopEvacuated.reduce(function(a, b){
          return a + b
        }, 0);

        let totalBags = evacuatedSum / oneBag 

        if (totalBags >= 1) {
          return this.evacuated.sumEvacuated = totalBags+"Bags"
        } else {
          return this.evacuated.sumEvacuated = "No Stock Evacuated Today"
        }
        return this.evacuated.todayEvacuatedSum = totalBags+"Bags"
   }

  } //Computed calibrace closes

}

</script>


























