
<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";

.card-footer-item 
{
	cursor: pointer;
}

</style>

<template>

	<div class="">

	<form v-on:submit.prevent="addEvacuatedData"> <!-- Form tag open -->

		<div class="modal is-active" v-if='isActive'>
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title has-text-centered">Evacuated Sheet </p>
					<button class="delete" aria-label="close" v-on:click="addActiveClass" @click="evacuateStatus"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
						<div class="field">
							<div class="field-label"></div>
							<div class="field-body">
								<div class="field is-expanded">
									<div class="field has-addons">
										<p class="control">
											<a class="button is-static is-bold has-text-black">
												Exporter Name
											</a>
										</p>
										<p class="control is-expanded">
											<input class="input" type="text" v-model="evacuated.exporterName" placeholder="Enter exporter name here" autofocus="" required>
										</p>
									</div>
								</div>
							</div>
						</div>

								<table class="table is-bordered is-fullwidth is-centered">

									<thead>
										<tr>
											<th> Tonne</th>
											<th> Weight </th>
										</tr>
									</thead>

									<tbody>
										<tr>

											<td> <input class="input" type="number" v-model.number="evacuated.tonne">  </td>

											<td> <input class="input" type="number" v-bind:value="getWeight" disabled="">  </td>
											
										</tr>
									</tbody>
								</table>

						<footer class="card-footer sticky">
							<button class="card-footer-item has-background-info has-text-white " value="submit"> <i class="fas fa-save fa-lg  has-text-white"> Save </i> </button>


							<a class="card-footer-item has-background-info has-text-white" v-on:click="addActiveClass"> <i class="fas fa-times has-text-white"> Cancel </i> </a>
						</footer>

				</section>
				<footer class="modal-card-foot modal-card-title has-text-centered">
					<p class="modal-card-title has-text-centered"> {{ getBag }} </p>
				</footer>
			</div>
		</div>

</form> <!-- form tag close -->


<button class="button is-info has-text-white is-rounded" @click="addActiveClass"> Evacuate Stocks</button>

	</div>

</template>

<script>
import classToggler from '../../mixins/classToggler'

export default{
name: "evacuated-sheet",

 mixins: [
 classToggler
 ],

 data() {
  return{

  	status: null,

    evacuated: {
    	exporterName: null,
    	tonne: null,
    	bags: null,
    	weight: null,
    },
  }
},

	methods: {
		addEvacuatedData() {
			let api = "/api/evacuated"

			this.axios.post(api, {
				name: this.evacuated.exporterName,
				tonne: this.evacuated.tonne.toString(),
				bags: this.evacuated.bags,
				weight: this.evacuated.weight
			}).then((response) => {
    			this.evacuated.exporterName = null
    			this.evacuated.tonne = null
    			this.evacuated.bags = null
    			this.evacuated.weight = null
    			this.status = true
    			this.$emit('triggerEvacuateStatus', this.status)
    			this.isActive = false
  			}).catch(function (error) {
				//error code goes here
			});
			
			},// function calibrace close here

		evacuateStatus: function(value) {
			this.status = false
			this.$emit('triggerEvacuateStatus', this.status)
		},

	},


  computed: {

    getBag: function () {
    	let oneBag = 64
    	let weighInBag = this.evacuated.weight / oneBag
    	let BagInWhole = weighInBag.toFixed(0)
    	return this.evacuated.bags = BagInWhole+"Bags"
    },

     getWeight: function () {
      let tonne = 64 * 16
      let weight = this.evacuated.tonne * tonne
      weight = weight.toFixed(0)
      return this.evacuated.weight = weight      
    },

  },

}
</script>

