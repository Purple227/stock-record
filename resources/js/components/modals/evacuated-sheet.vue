<template>

	<div class="">

		<div class="modal is-active" v-if='isActive'>
			<div class="modal-background"></div>
			<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">Modal title</p>
					<button class="delete" aria-label="close" v-on:click="addActiveClass"></button>
				</header>
				<section class="modal-card-body">
					<!-- Content ... -->
				</section>
				<footer class="modal-card-foot">
					<button class="button is-success">Save changes</button>
					<button class="button" v-on:click="addActiveClass">Cancel</button>
				</footer>
			</div>
		</div>




<button class="button is-white has-text-info is-rounded" @click="addActiveClass"> Evacuate Stocks</button>

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
    //
  }
},

}
</script>

