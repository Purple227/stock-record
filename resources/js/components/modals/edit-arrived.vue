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

	<div class="modal is-active">
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title has-text-centered"> Update {{editedData.name}} Stocks  </p>
				<button class="delete" aria-label="close" @click="cancelStatus"></button>
			</header>
			<section class="modal-card-body">
			<form v-on:submit.prevent="updateArrivedData"> <!-- Form tag open -->
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
									<input class="input" type="text" v-model="editedData.name" autofocus="" required>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
  <!--header class="card-header">
    <p class="card-header-title">
      //Header content
    </p>
</header-->
<div class="card-content">
	<div class="content">


		<table class="table is-bordered is-centered">
			<thead>
				<tr>
					<th> No </th>
					<th> Weight </th>
					<th> Discount </th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<th>1</th>

					<td> <input class="input" type="number" v-model.number.trim="editedData.weight" required> </td>

					<td> <input class="input" type="number" v-model.number.trim="editedData.discount"> </td>	
				</tr>
			</tbody>
		</table>


	</div>
</div>
<footer class="card-footer">
	<button  class="card-footer-item has-background-info has-text-white"> <i class="fas fa-save fa-lg  has-text-white"> Update </i>  </button>
	<a class="card-footer-item has-background-info has-text-white" @click="cancelStatus"> <i class="fas fa-times has-text-white" > Cancel </i> </a>
</footer>
</div>

</form>
</section>
<footer class="modal-card-foot modal-card-title has-text-centered" >
	<p class="modal-card-title has-text-centered"> {{getResult}} </p>
</footer>
</div>
</div>

</template>


<script>
import classToggler from '../../mixins/classToggler'

export default {
	name: 'edit-arrived',

	mixins: [
	classToggler
	],

	props: ['contentId'],

	data() {
		return{

			editedData: {
				weight: null,
				discount: null,
				bags: null,
				name: null,
			},

			getContentId:this.contentId,
			edit: null,
		}
	},

	created() {
		this.getEditedData()
	},

	methods: {

    cancelStatus: function(value, status) {
      this.status = false
      this.edit = false
      this.$emit('editStatus', this.edit, this.status)
    },

		getEditedData() {
			let api = '/api/arrived/' + this.getContentId
			this.axios
			.get(api).then((response) => {
				this.editedData.weight = parseInt(response.data.total_weight)
				this.editedData.discount = parseInt(response.data.total_discount)
				this.editedData.name = response.data.broker
			})
		},

		updateArrivedData() {
			let api = '/api/arrived/' + this.getContentId;
			let weight = this.editedData.weight+"Kg"
			let discount = this.editedData.discount+"Kg"
			this.axios.put(api, {
				broker: this.editedData.name,
				total_weight: weight,
				total_discount: discount,
				total_bags: this.editedData.bags
			}).then((response) => {
				this.status = true
				this.edit = false
                this.$emit('editStatus', this.edit, this.status)
			});
		}

	},// method calibrace closes here 

	computed: {

		getResult: function() {
			let oneBag = 64

			let totalBags = parseInt((this.editedData.weight - this.editedData.discount) / oneBag)

			let calculate = oneBag * totalBags

			let totalWeightWithDiscount = this.editedData.weight - this.editedData.discount

			let calculateRemainder = totalWeightWithDiscount - calculate

			return this.editedData.bags = totalBags+"Bags"  +" Plus "+ " " +  calculateRemainder+"Kg"
		} 
	},

}

</script>
