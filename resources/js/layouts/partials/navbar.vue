
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
              <img class="is-rounded" src="/images/profile_pic.jpg" alt='drop-down'>
            </figure>
          </div>
        </div>
        <div class="dropdown-menu" id="dropdown-menu" role="menu">
          <div class="dropdown-content">

            <router-link class="dropdown-item" :to="{ name: 'user-update' }" active-class='is-active'> 
              Update Profile
            </router-link>

            <hr class="dropdown-divider">

            <a class="dropdown-item" @click="logout">
              Logout {{title}}
            </a>

          </div>
        </div>
      </div>

    </div>

  </nav>

</template>


<script>
import classToggler from '../../mixins/classToggler'
import UpdateProfile from '../../components/modals/update-profile.vue'
import Landing from '../../components/landing-page.vue'

export default{

 mixins: [
 classToggler
 ],

 components: {
  'update-profile': UpdateProfile,
  'landing-page': Landing
},

props: ['title'],

data() {
  return{
    todayDate: new Date(),
    imagePath:null,
  }
},

created() {
  this.getUserProfile()
},

methods: {

  logout() {
    let api = "logout"
    this.axios.post(api, {
    }).then((response) => {
      history.go();
    }).catch(function (error) {
      console.log(error)
    });
  },

  getUserProfile() {
    let api_url = "user/authId"
    this.axios
    .get(api_url).then((response) => {
      this.imagePath = response.data.image
    })
  },

      },// method calibrace closes here

      computed: {
    // a computed getter
    getImagePath: function () {
      // `this` points to the vm instance
      let originalPath = this.imagePath
      let laravelRootPath = 'Storage/'
      let completePath = laravelRootPath + originalPath
      return this.imagePath = completePath
    }
  }

}
</script>






































