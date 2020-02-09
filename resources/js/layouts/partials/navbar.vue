
<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";

.image 
{
  cursor: pointer;
}


</style>


<template>

  <div> 



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

        <div class="dropdown is-right" v-bind:class="{ 'is-active': isActive }" v-on-clickaway="away" @click="addActiveClass">
          <div class="dropdown-trigger">
            <div>
              <figure class="image is-48x48">
                <img class="is-rounded" src="/images/profile_pic.jpg">
              </figure>
            </div>
          </div>
          <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content">

              <a href="#" class="dropdown-item">
                Update Profile
              </a>

              <hr class="dropdown-divider">

              <a class="dropdown-item" @click="logout">
                Logout
              </a>

            </div>
          </div>
        </div>

      </div>

    </nav>

    <div class="" v-if="status">
      <div class="notification is-black" >
        <button class="delete" @click="status = null"></button>
        Login Succesfull
      </div>
    </div>


  </div>

</template>


<script>
import classToggler from '../../mixins/classToggler'
import Login from '../../components/modals/login.vue'

export default{

 mixins: [
 classToggler
 ],

 components: {
  'login': Login,
},

data() {
  return{
    todayDate: new Date(),
    status: false,
  }
},

methods: {
  logout() {
    let api = "logout"
    this.axios.post(api, {
    }).then((response) => {
      this.$router.go()
            //will make a decision as a progress
            this.$router.go()
          }).catch(function (error) {
            console.log(error)
          });
        }
      },

    }
    </script>






































