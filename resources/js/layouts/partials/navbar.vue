<style lang="scss">

@import "../../../sass/bulma.scss";

</style>


<template>

  <nav class="level is-mobile">

    <div class="level-item level-left">
      <div>
        <p class="control">
          <button class="button is-info is-rounded">
            <span class="icon is-small">
              <i class="fas fa-calendar has-text-white"></i>
            </span>
            <span class="is-bold">27</span>
          </button>
        </p>
      </div>
    </div>



    <div class="level-item has-text-centered">
      <div>
       <i class="fas fa-camera fa-lg has-text-info"> </i> 
     </div>
   </div>

   <div class="level-item level-right">
    <div>
      <figure class="image is-48x48">
        <img class="is-rounded" src="/images/profile_pic.jpg">
      </figure>
    </div>
  </div>

</nav>

</template>


<script>
import DynamicClassHandler from '../../mixins/dynamic-class-handler'

export default{

 mixins: [
 DynamicClassHandler
 ],


 data() {
  return{

  }
},

}
</script>






































