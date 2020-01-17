<style lang="scss" scoped>
@charset "utf-8";
@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";
.box
	{
	box-shadow: 6px 6px 3px $black;
	cursor: pointer;
}
.card-footer-item, .fa-trash
	{
	cursor: pointer;
}
.sticky
	{
	@include position(0px, sticky);
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

		<div class="modal is-active" v-if='isActive'>
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title has-text-centered"> Work-Sheet </p>
					<button class="delete" aria-label="close" v-on:click="addActiveClass" @click="totalBagData"></button>
				</header>
				<section class="modal-card-body">
					<form v-on:submit.prevent="savedData"> <!-- Form tag open -->
						<div class="card">
						<!-- header class="card-header" >
							// tags goes here 
						</header -->
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

											<td>    <input class="input" type="number" placeholder="Type here" v-model.number.trim="inventoryData.weight"> </td>

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
						<footer class="card-footer">
							<button class="card-footer-item has-background-info has-text-white " value="submit"> <i class="fas fa-save fa-lg  has-text-white" @click="totalBagData"> Save </i> </button>

							<a class="card-footer-item has-background-info has-text-white" v-on:click="addInventoryData">   <i class="fas fa-plus  has-text-white"> Add-Row</i> </a>

							<a class="card-footer-item has-background-info has-text-white" @click="openClose = !openClose"> <i class="fa "> {{ openClose ? 'Less' : 'More' }} </i> </a>

							<a class="card-footer-item has-background-info has-text-white" v-on:click="addActiveClass"> <i class="fas fa-times has-text-white" @click="totalBagData"> Cancel </i> </a>
						</footer>
					</div>

				</form> <!-- form tag close -->
			</section>

			<footer class="modal-card-foot modal-card-title has-text-centered" >
				<p class="modal-card-title has-text-centered"> {{ getBagTotal }} </p>
			</footer>
		</div>
	</div>

	<!-- Show modal button --> 
	<div class="box has-text-centered has-background-info" v-on:click="addActiveClass">
		<h4 class="title is-4 has-text-white"> Work-Sheet</h4>
		<i class="fas fa-plus fa-10x has-text-white"> </i> 
	</div>

</div>

</template>


<script>
import classToggler from '../../mixins/classToggler'
import Landing from '../landing-page.vue'
import { required, minLength } from 'vuelidate/lib/validators'

export default{
	name: "work-sheet",

	components: 
	{
		'landing-page': Landing,
	},

	mixins: [
	classToggler
	],

	data() {
		return{

			openClose: false,
			status: null,

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


	validations: {
		inventoryData: {
			weight: {
				required,
				minLength: minLength(1)
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

		totalBagData: function(value) {
			this.$emit('totalBag', this.inventoryTotal.bag)
		},

		savedData(index, value) {
			let api = '/api/inventory'
			let total_bags
			let total_weight
			let total_discount

			let weight = this.inventoryTotal.weight+"Kg"
			let discount = this.inventoryTotal.discount+"Kg"

			this.axios.post(api, {
				total_weight: weight,
				total_discount: discount,
				total_bags: this.inventoryTotal.bag,
			})

			.then((response) => {
				let arrayLength = this.inventoryData.length
				this.inventoryData.splice(index, arrayLength)
				this.status = true
				this.$emit('statusMethod', this.status)
				this.isActive = false
			})

			.catch(function (error) {
				this.status = false
				this.$emit('statusMethod', this.status)
			});
		},

	},

	computed: {
    // a computed getter
    getWeightTotal: function () {
    	let inventoryData = this.inventoryData
    	let inventoryDataCount = this.inventoryData.length
    	let i
    	let holder = []
    	let sum

    	for (i=0; i<inventoryDataCount; i++) { 
    		holder.push(inventoryData[i].weight)
    	}

        // Getting sum of weight
        sum = holder.reduce(function(a, b){
        	return a + b
        }, 0);

        this.inventoryTotal.weight = sum
        return this.inventoryTotal.weight
    },

    getDiscountField: function () {
    	let inventoryData  = this.inventoryData;
    	let inventoryDataCount = this.inventoryData.length
    	let i
    	let holder = []
    	let moisture 
    	let sum

    	for (i=0; i<inventoryDataCount; i++) {
    		moisture = this.inventoryData[i].moisture
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
    	let i
    	let holder = []
    	let moisture 
    	let sum

    	for (i=0; i<inventoryDataCount; i++) {   		
    		moisture = this.inventoryData[i].moisture
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
        sum = holder.reduce(function(a, b){
        	return a + b
        }, 0);

        this.inventoryTotal.discount = sum
        return this.inventoryTotal.discount
    }, // function calibrace close
    
    getBagTotal: function() { 
    	let inventoryTotalBags
    	let convertToWhole
    	let remainingKg
    	let oneBag = 64
    	let calculate
    	let totalWeightWithDiscount

    	inventoryTotalBags = (this.inventoryTotal.weight - this.inventoryTotal.discount) / oneBag
    	convertToWhole = parseInt(inventoryTotalBags)
    	calculate = oneBag * convertToWhole
    	totalWeightWithDiscount = this.inventoryTotal.weight - this.inventoryTotal.discount
    	remainingKg = totalWeightWithDiscount - calculate
    	this.inventoryTotal.bag = convertToWhole+"Bag"  +" Plus "+ " " +  remainingKg+"Kg"
    	return this.inventoryTotal.bag
    } // function close
    } // Computed closing calibrace
}
</script>