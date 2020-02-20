
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
		<div class="modal is-active">
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title has-text-centered"> Update {{editedData.name}} Stocks </p>
					<button class="delete" aria-label="close" v-on:click="historyHome"></button>
				</header>
				<section class="modal-card-body">
				<form v-on:submit.prevent="updateEvacuatedData"> <!-- Form tag open -->
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
											<input class="input" type="text" v-model="editedData.name" placeholder="Enter exporter name here" autofocus="" required>
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

											<td> <input class="input" type="number" v-model.number="editedData.tonne" required>  </td>

											<td> <input class="input" type="number" v-bind:value="getWeight" disabled="">  </td>
											
										</tr>
									</tbody>
								</table>

						<footer class="card-footer sticky">
							<button class="card-footer-item has-background-info has-text-white " type="submit"> <i class="fas fa-save fa-lg  has-text-white"> Save </i> </button>


							<a class="card-footer-item has-background-info has-text-white" v-on:click="historyHome"> <i class="fas fa-times has-text-white"> Cancel </i> </a>
						</footer>
					</form>
				</section>
				<footer class="modal-card-foot modal-card-title has-text-centered">
					<p class="modal-card-title has-text-centered"> {{ getBag }} </p>
				</footer>
			</div>
		</div>

</template>


<script>
import classToggler from '../../mixins/classToggler'

export default {
	name: 'edit-evacuated',

	mixins: [
	classToggler
	],

	data() {
		return{

			editedData: {
				name: null,
				tonne: null,
				bags: null,
				weight:null,
			},
		}
	},

	created() {
		this.getEditedData()
	},

	methods: {

		historyHome() {
			this.$router.push({name:'history'})
		},

		getEditedData() {
			let contentId= this.$route.params.id;
			let api = '/api/evacuated/' + contentId
			this.axios
			.get(api).then((response) => {
				this.editedData.tonne = response.data.tonne
				this.editedData.name = response.data.name
			})
		},

        updateEvacuatedData() {
          let contentId= this.$route.params.id;
          let api = '/api/evacuated/' + contentId;
		  let weight = this.editedData.weight+"Kg"
          this.axios.put(api, {
          	name: this.editedData.name,
          	tonne: this.editedData.tonne.toString(),
          	bags:this.editedData.bags,
          	weight: weight
          }).then((response) => {
            this.$router.push({name: 'history'});
          });
        }

	},// method calibrace closes here 

 computed: {

    getBag: function () {
    	let oneBag = 64
    	let weighInBag = this.editedData.weight / oneBag
    	let BagInWhole = weighInBag.toFixed(0)
    	return this.editedData.bags = BagInWhole+"Bags"
    },

     getWeight: function () {
      let tonne = 64 * 16
      let weight = this.editedData.tonne * tonne
      weight = weight.toFixed(0)
      return this.editedData.weight = weight      
    },

  },

}

</script>

