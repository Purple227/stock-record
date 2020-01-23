
<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";


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
            <span class="is-bold">{{ todayDate | moment("DD MMM") }}</span>
          </button>
        </p>
      </div>
    </div>



    <div class="level-item has-text-centered">
      <div>
      <figure class="image is-48x48">
        <img class="is-rounded" src="/images/logo.png">
      </figure>  
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
import classToggler from '../../mixins/classToggler'

export default{

 mixins: [
 classToggler
 ],

 data() {
  return{
    todayDate: new Date(),
  }
},

}
</script>






































