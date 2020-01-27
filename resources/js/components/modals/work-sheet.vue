<style lang="scss" scoped>


</style>


<template>

<div>

<div class="" v-if=isActive>

	<hi> jkghjgjh </hi>

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
import ArrivedSheet from './arrived-sheet.vue'
import EvacuatedSheet from './evacuated-sheet.vue'

export default{
 
 components: {
 	'arrived-sheet': ArrivedSheet,
 	'evacuated-sheet': EvacuatedSheet,
 },

 mixins: [
 classToggler
 ],


 data() {
  return{
    componentToggle: 'arrived-sheet'
  }
},

}
</script>

