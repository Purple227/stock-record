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

</style>


<template>

	<div class="">

		<div class="modal is-active" v-if='isActive'>
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title has-text-centered"> Work-Sheet </p>
					<button class="delete" aria-label="close" v-on:click="addActiveClass"></button>
				</header>
				<section class="modal-card-body">

					<div class="card">
						<!-- header class="card-header" -->
						<!-- Header content goes here -->
						<!-- /header -->
						<div class="card-content">
							<div class="content">

								<form v-on:submit.prevent="submitForm"> <!-- Form tag open -->

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
											<tr>
												<th>1</th>

												<td>    <input class="input" type="number" placeholder="Type here"> </td>
												<td>    <input class="input" type="number" placeholder="Type here"> </td>					
												<td>    <input class="input" type="number" placeholder="Type here"> </td>											
											</tr>
										</tbody>

									</table>

								</form>  <!-- Form tag close -->

								<table class="table is-bordered">

									<thead>
										<tr>
											<th><abbr title="Serial Number">S/N</abbr></th>
											<th> Total </th>
											<th> Total </th>
											<th> Total </th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<th>1</th>

											<td>    <input class="input" type="number" disabled=""> </td>
											<td>    <input class="input" type="number" disabled=""> </td>					
											<td>    <input class="input" value="767" type="number" disabled=""> </td>											
										</tr>
									</tbody>
								</table>



							</div>
						</div>
						<footer class="card-footer">
							<button  class="card-footer-item has-background-info has-text-white "> <i class="fas fa-save has-text-white"> Save </i> </button>

							<button class="card-footer-item has-background-info has-text-white ">   <i class="fas fa-plus has-text-white"> Add</i> </button>

							<button class="card-footer-item has-background-info has-text-white" v-on:click="addActiveClass"> <i class="fas fa-close has-text-white"> Cancel </i> </button>
						</footer>
					</div>


				</section>

				<!-- footer class="modal-card-foot" -->
				<!-- Blah blah blah -->
				<!-- /footer -->
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
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
import DynamicClassHandler from '../../mixins/dynamic-class-handler'

export default{

	mixins: [
	DynamicClassHandler
	],

	data() {
		return{
			inventoryData: {

			}
		}
	},

}
</script>
