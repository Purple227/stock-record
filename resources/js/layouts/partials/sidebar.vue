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

<div class="dropdown menu"  v-bind:class="{ 'is-active': isActive }" v-on-clickaway="away" @click="addActiveClass">
  <div class="dropdown-trigger">
    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
      <span class="icon">
        <i class="fas fa-bars has-text-black fa-lg" aria-hidden="true"></i>
      </span>
    </button>
  </div>
  <div class="dropdown-menu" id="dropdown-menu" role="menu">
    <div class="dropdown-content">
      <a href="#" class="dropdown-item">
        Dropdown item
      </a>
      <a class="dropdown-item">
        Other dropdown item
      </a>
      <a href="#" class="dropdown-item is-active">
        Active dropdown item
      </a>
      <a href="#" class="dropdown-item">
        Other dropdown item
      </a>
    </div>
  </div>
</div>

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




































