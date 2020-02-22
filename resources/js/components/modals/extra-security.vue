<style lang="scss" scoped>

.card-footer-item, .fas
  {
  cursor: pointer;
}

</style>


<template>

  <div class="">

    <div class="modal is-active" v-if='isActive'>
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-centered"> Security Checked</p>
          <button class="delete" aria-label="close" @click="cancelStatus"></button>
        </header>
        <section class="modal-card-body">

          <div class="" v-if="moreEyeBalls">
            <div class="notification is-black is-small" >
              <button class="delete" @click="clearError">></button>
              {{moreEyeBalls}}
            </div>
          </div>

          <form v-on:submit.prevent="submit"> <!-- Form tag open -->
            <div class="card">
                <!--header class="card-header">
                    <p class="card-header-title">
                    //Content
                </p>
              </header-->

              <div class="card-content">

                <div class="field">
                  <div class="field-label"></div>
                  <div class="field-body">
                    <div class="field is-expanded">
                      <div class="field has-addons">
                        <p class="control">
                          <a class="button is-static is-bold has-text-black">
                            Enter Password
                          </a>
                        </p>
                        <p class="control is-expanded">
                          <input class="input" type="password" v-model="password" autofocus="" required>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <footer class="card-footer">
                <button  class="card-footer-item has-background-info has-text-white" > <i class="fas fa-sign-in-alt fa-lg  has-text-white"> Bridge </i>  </button>

                <a  class="card-footer-item has-background-info has-text-white"  v-on:click="cancelStatus"> <i class="fas fa-sign-in-alt   has-text-white"> Cancel </i>  </a>
              </footer>
            </div>
          </form>
        </section>
        <!--footer class="modal-card-foot modal-card-title has-text-centered" >
          
        </footer-->
      </div>
    </div>


    <i class="fas fa-edit has-text-info" v-on:click="addActiveClass"></i>

  </div>

</template>


<script>
import classToggler from '../../mixins/classToggler'

export default{

  props: ['getId'],

  mixins: [
  classToggler
  ],

  data() {
    return{
      password: null,
      status: null,
      bridge: null,
      moreEyeBalls: null,
      getProps: this.getId,
    }
  },


  methods: {
    clearError() {
      this.moreEyeBalls = null
    },

    cancelStatus: function(value) {
      this.status = false
      this.$emit('setStatus', this.status, this.getProps)
      this.isActive = false
    },

    submit(value, arrayIndex) {

      let api = "user"

      this.axios.post(api, {
        password: this.password
      }).then((response) => {
        this.bridge = response.data
        if (this.bridge == true) {
          this.status = true
          this.$emit('setStatus', this.status, this.getProps)
          this.isActive = false
        } else if(this.bridge == false) {
          this.moreEyeBalls = 'The Dark Force Await Your Coming'
        }
      })
        } //submitForm function calibrace closes

      },//Method calibrace end here


    }
    </script>

