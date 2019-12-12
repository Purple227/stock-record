<style lang="scss">
@import "../../../sass/bulma.scss";

.icons-wrapper {
  display:flex; 
  flex-direction:column; 
  justify-content:center;
  min-height:50vh;
  position: relative;
}

.padding
{
	padding: auto;

	@include tablet_mobile
	{
		padding-right: 13px;
	}
}


.menu
{
	margin-bottom: 65%;	
	margin-left: 30%;
}

.icon_spacing
{	
	margin: 50%;
}

.sticky
{
  position: sticky;
  top: 0px;
}


</style>



<template>
	<div class="sticky">

 <center>

<span class="icon has-text-info menu">
<i class="fas fa-bars has-text-dark fa-lg "></i> 
</span> 

 <div class="icons-wrapper">

<router-link :to="{ name: 'home' }" active-class='is-active'> 
  <i class="fas fa-home icon has-text-info icon_spacing"></i>
</router-link>

<span class="icon has-text-info icon_spacing">
  <i class="fas fa-history "></i>
</span>

<span class="icon has-text-info icon_spacing">
  <i class="fas fa-users "></i>
</span>

<span class="icon has-text-info icon_spacing">
  <i class="fas fa-info-circle "></i>
</span>

 </div>

 </center>
</div>

</template>


<script>

import dynamicClassToggler from '../../mixins/dynamic-class-handler'

export default {

mixins: [
	dynamicClassToggler
],

  data() {
    return {
      
    }
  },

}
</script>




































