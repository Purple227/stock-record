<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";

@import "../../../sass/partials/_reuse.scss";

@import "../../../sass/partials/_responsive.scss";

.icons-wrapper {
  @extend .center;
}

.sticky
{
  @include position(0px, sticky);
}

.dropdown
{
	margin-bottom: 65%;	
}

.button
{
  margin-left: 20%;
}

.icon_spacing
{	
	margin: 50%;
}


</style>



<template>
	<div class="sticky">

 <center>


<div class="dropdown" v-bind:class="{ 'is-active': isActive }" v-on-clickaway="away" @click="addActiveClass">
  <div class="dropdown-trigger">
    <button class="button is-rounded" aria-haspopup="true" aria-controls="dropdown-menu">
      <span class="icon">
        <i class="fas fa-bars has-text-black fa-lg" aria-hidden="true"></i>
      </span>
    </button>
  </div>
  <div class="dropdown-menu" id="dropdown-menu" role="menu">
    <div class="dropdown-content">

      <a class="dropdown-item"> 
        Contact The Developer
      </a>      

    </div>
  </div>
</div>

 <div class="icons-wrapper">

<router-link :to="{ name: 'home' }" active-class='is-active'> 
  <i class="fas fa-home icon has-text-info icon_spacing"></i>
</router-link>

<router-link :to="{ name: 'history' }" active-class='is-active'>
  <i class="fas fa-history icon has-text-info icon_spacing"></i>
</router-link>

<router-link :to="{name: 'user-profile'}" active-class='is-active'>
  <i class="fas fa-users icon has-text-info icon_spacing"></i>
</router-link>

<router-link :to="{name: 'about'}" active-class='is-active'>
  <i class="fas fa-info-circle icon has-text-info icon_spacing"></i>
</router-link>

 </div>

 </center>
</div>

</template>


<script>

import classToggler from '../../mixins/classToggler'

export default {

  mixins: [
  classToggler
  ],

  data() {
    return {

    }
  },

}
</script>




































