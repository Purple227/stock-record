<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";

.card-footer-item, .fa-trash
{
	cursor: pointer;
}

</style>


<template>

	<div class="">


		<div class="modal is-active" v-if="isActive">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title has-text-centered"> Arrived-Sheet </p>
					<button class="delete" aria-label="close" v-on:click="addActiveClass" @click="cancelStatus"></button>
				</header>
				<section class="modal-card-body">
					<form v-on:submit.prevent="savedData"> <!-- Form tag open -->
						<div class="field">
							<div class="field-label"></div>
							<div class="field-body">
								<div class="field is-expanded">
									<div class="field has-addons">
										<p class="control">
											<a class="button is-static is-bold has-text-black">
												Broker Name
											</a>
										</p>
										<p class="control is-expanded">
											<input class="input" type="text" v-model="broker" placeholder="Enter broker name here" autofocus="" required>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
						<!--header class="card-header" >
						</header-->
						<div class="card-content">
							<div class="content">

								<table class="table is-bordered">
									<thead>
										<tr>
											<th><abbr title="Serial Number">S/N</abbr></th>
											<th> Weight </th>
											<th> Moisture </th>
											<th> Discount </th>
										</tr>
									</thead>

									<tbody>
										<tr v-for="(inventoryData, index) in inventoryData" :key="index">
											<th> {{ index+1 }}</th>

											<td>    <input class="input" type="number" placeholder="Type here" v-model.number.trim="inventoryData.weight" required> </td>

											<td>    <input class="input" type="number" placeholder="Type here" v-model.number.trim="inventoryData.moisture"> </td>				
											<td>    <input class="input" type="string" v-model="inventoryData.discount" disabled=""> </td>	

											<td>
												<i class="fas fa-trash has-text-info" v-on:click="removeinventoryData(index);"></i> </span>
											</td>										
										</tr>
									</tbody>

								</table>

								<table class="table is-bordered is-centered" v-show="openClose">

									<thead>
										<tr>
											<th> Total</th>
											<th> Weight </th>
											<th> Moisture </th>
											<th> Discount </th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<th>1</th>

											<td>    <input class="input" type="number" v-bind:value="getWeightTotal" disabled="">  </td>

											<td> <input class="input" type="number"  disabled="" >  </td>

											<td>    <input class="input" type="number" disabled="" v-bind:value="getDiscountTotal"> </td>											
										</tr>
									</tbody>
								</table>

							</div>
						</div>
						<footer class="card-footer sticky">
							<button class="card-footer-item has-background-info has-text-white " value="submit"> <i class="fas fa-save fa-lg  has-text-white" disabled> Save </i> </button>

							<a class="card-footer-item has-background-info has-text-white" v-on:click="addInventoryData">   <i class="fas fa-plus  has-text-white"> Add-Row</i> </a>

							<a class="card-footer-item has-background-info has-text-white" @click="openClose = !openClose"> <i class="fa "> {{ openClose ? 'Less' : 'More' }} </i> </a>

							<a class="card-footer-item has-background-info has-text-white" v-on:click="addActiveClass"> <i class="fas fa-times has-text-white" @click="cancelStatus"> Cancel </i> </a>
						</footer> 
					</div>

				</form> <!-- form tag close -->
			</section>

			<footer class="modal-card-foot modal-card-title has-text-centered" >
				<p class="modal-card-title has-text-centered"> {{ getBagTotal }} </p>
			</footer>
		</div>
	</div>



<button class="button is-info has-text-white is-rounded" @click="addActiveClass"> Arrived Stocks</button>

</div>

</template>


<script>
import classToggler from '../../mixins/classToggler'

export default{
name: "arrive-sheet",

mixins: [
 classToggler
 ],

	data() {
		return{

			openClose: false,
			status: null,
			broker: null,

			inventoryData: [{
				weight: null,
				moisture: null,
				discount: null,
			}],

			inventoryTotal: {
				weight: null,
				discount: null,
				bag: null,
			},

		}
	},

	methods: {
		addInventoryData () {
			this.inventoryData.push({
				weight: null,
				moisture: null,
				discount: null,
			})
		},

		removeinventoryData: function(index) {
			this.inventoryData.splice(index, 1);
		},

		cancelStatus: function(value) {
			this.status = false
			this.$emit('triggerArrivedStatus', this.status)
		},

		savedData(index, value) {
			let api = '/api/arrived'
			let total_bags
			let total_weight
			let total_discount

			let weight = this.inventoryTotal.weight+"Kg"
			let discount = this.inventoryTotal.discount+"Kg"

			this.axios.post(api, {
				total_weight: weight,
				total_discount: discount,
				total_bags: this.inventoryTotal.bag,
				broker: this.broker
			}).then((response) => {
				let arrayLength = this.inventoryData.length
				this.inventoryData.splice(index, arrayLength)
				this.broker = null
				this.status = true
				this.$emit('triggerArrivedStatus', this.status)
				this.isActive = false
			}).catch(function (error) {
				this.status = false
				this.$emit('triggerArrivedStatus', this.status)
			});
		},

	},

	computed: {
    // a computed getter
    getWeightTotal: function () {
    	let inventoryData = this.inventoryData
    	let inventoryDataCount = this.inventoryData.length
    	let holder = []

    	for (let i=0; i<inventoryDataCount; i++) { 
    		holder.push(parseInt(inventoryData[i].weight))
    	}

        // Getting sum of weight
        let sum = holder.reduce(function(a, b){
        	return a + b
        }, 0);

        this.inventoryTotal.weight = sum
        return this.inventoryTotal.weight
    },

    getDiscountField: function () {
    	let inventoryData  = this.inventoryData;
    	let inventoryDataCount = this.inventoryData.length
    	let holder = []

    	for (let i=0; i<inventoryDataCount; i++) {
    		let moisture = this.inventoryData[i].moisture
    		if (moisture ==10 || moisture == 11 || moisture == 12 || moisture ==13) {
    			holder.push(inventoryData[i].discount = "1kg")
    		} else if (moisture == 14 || moisture == 15 || moisture ==16) {
    			holder.push(inventoryData[i].discount = "2kg")
    		} else if(moisture == 18) {
    			holder.push(inventoryData[i].discount = "3kg")
    		} else if (moisture == 20) {
    			holder.push(inventoryData[i].discount = "4kg")
    		} else {
    			holder.push(inventoryData[i].discount = "0kg")
    		}
    	} // For loops end    

    	this.inventoryData.discount = holder
    	return this.inventoryData.discount
    }, // function calibrace close

    getDiscountTotal: function () {
    	let inventoryData  = this.inventoryData;
    	let inventoryDataCount = this.inventoryData.length
    	let holder = []

    	for (let i=0; i<inventoryDataCount; i++) {   		
    		let moisture = this.inventoryData[i].moisture
    		if (moisture ==10 || moisture == 11 || moisture == 12 || moisture ==13) {
    			holder.push(parseFloat(inventoryData[i].discount = "1kg"))
    		} else if (moisture == 14 || moisture == 15 || moisture ==16) {
    			holder.push(parseFloat(inventoryData[i].discount = "2kg"))
    		} else if(moisture == 18) {
    			holder.push(parseFloat(inventoryData[i].discount = "3kg"))
    		} else if (moisture == 20) {
    			holder.push(parseFloat(inventoryData[i].discount = "4kg"))
    		} else {
    			holder.push(parseFloat(inventoryData[i].discount = "0kg"))
    		}
    	} // For loops end   

        // Getting sum of weight
        let sum = holder.reduce(function(a, b){
        	return a + b
        }, 0);

        this.inventoryTotal.discount = sum
        return this.inventoryTotal.discount
    }, // function calibrace close
    
    getBagTotal: function() { 
    	let oneBag = 64

    	let inventoryTotalBags = (this.inventoryTotal.weight - this.inventoryTotal.discount) / oneBag
    	let convertToWhole = parseInt(inventoryTotalBags)
    	let calculate = oneBag * convertToWhole
    	let totalWeightWithDiscount = this.inventoryTotal.weight - this.inventoryTotal.discount
    	let remainingKg = totalWeightWithDiscount - calculate
    	let totalBag = convertToWhole+"Bag"  +" Plus "+ " " +  remainingKg+"Kg"
    	totalBag = totalBag.replace(/NaN/g, "0")
    	this.inventoryTotal.bag = totalBag


    	//this to calculate overall stocks 
    	this.inventoryTotal.bagInNumber = convertToWhole+"."+remainingKg

    	return this.inventoryTotal.bag
    } // function close
    } // Computed closing calibrace
}
</script>