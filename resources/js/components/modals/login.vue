<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";

/* "OFF" Text */
/* Hide default input */
.toggle input {
  display: none;
}

/* The container and background */
.toggle {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 35px;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: $black;
  border: 1px solid $light-grey;
  border-radius: 5px;
  transition: all 0.4s;
}

/* The sliding button */
.slider:before {
  position: absolute;
  content: "";
  width: 30px;
  height: 28px;
  left: 2px;
  top: 2px;
  background-color: $white;
  border-radius: 5px;
  transition: all 0.4s;
}

/* On checked */
input:checked + .slider {
  background-color: $light-blue;
}
input:checked + .slider:before {
  transform: translateX(40px);
}

/* "OFF" Text */
.slider:after {
  position: absolute;
  content: "OFF";
  top: 6px;
  right: 5px;
  color: #fff;
  font-size: 0.9em;
  font-weight: bold;
}

/* "ON" Text */
input:checked + .slider:after {
  content: "ON";
  left: 10px;
}

.card-footer-item
{
  cursor: pointer;
}

</style>


<template>

  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title has-text-centered"> Login </p>
        <!-- button class="delete" aria-label="close" @click="home"></button-->
      </header>
      <section class="modal-card-body">
        
        <div class="" v-if="login.errors">
          <div class="notification is-black is-small" >
            <button class="delete" @click="clearError">></button>
            {{login.errors}}
          </div>
        </div>

        <form v-on:submit.prevent="submitForm"> <!-- Form tag open -->
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
                            Email
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="email" v-model="login.email" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.login.email.$invalid">
                            <i class="fas fa-exclamation-triangle has-text-danger"></i>
                          </span>
                          <span class="icon is-small is-right" v-else>
                            <i class="fas fa-check has-text-info"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field">
                  <div class="field-label"></div>
                  <div class="field-body">
                    <div class="field is-expanded">
                      <div class="field has-addons">
                        <p class="control">
                          <a class="button is-static is-bold has-text-black">
                            Password
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="password" v-model="login.password" required>
                          <span class="icon is-small is-right" v-if="$v.login.password.$invalid">
                            <i class="fas fa-exclamation-triangle has-text-danger"></i>
                          </span>
                          <span class="icon is-small is-right" v-else>
                            <i class="fas fa-check has-text-info"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field has-addons has-addons-centered">
                  <p class="control">
                    <a class="button is-static is-bold has-text-black">
                      Remember Me
                    </a>
                    <label class="checkbox toggle">
                      <input type="checkbox" v-model="login.remember" true-value="on" false-value="off" >
                      <span class="slider"></span>
                    </label>
                  </p>
                </div>


              </div>
              <footer class="card-footer">
                <button  class="card-footer-item has-background-info has-text-white" > <i class="fas fa-sign-in-alt fa-lg  has-text-white"> Login </i>  </button>
              </footer>
            </div>
          </form>
        </section>
        <footer class="modal-card-foot modal-card-title has-text-centered" >
          <p class="modal-card-title has-text-centered is-small is-block"> Haven't register <register class="is-inline"> </register> instead </p>
        </footer>
      </div>
    </div>

  </template>


  <script>
  import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
  import Register from './register.vue'
  import Navbar from '../../layouts/partials/navbar.vue'

  export default{

  components: {
    'register': Register,
    'navbar': Navbar,
  },

    data() {
      return{
        login: {
          email: null,
          password: null,
          remember: null,
          errors: null,
        },
        status: null,
      }
    },

    validations: {
      login: {

        email: {
          required,
          email,
          maxLength: maxLength(255)
        },
        password: {
          required,
          minLength: minLength(6)
        },

      }
    },


    methods: {
      clearError() {
        this.login.errors = null
      },

      submitForm() {

        let api = "/login"
        let errors 

        this.axios.post(api, {
          email: this.login.email,
          password: this.login.password,
          remember: this.login.remember,
        }).then((response) => {
            //will make a decision as a progress
            this.$router.go()
          }).catch(error=>{
            if(error.response.status==422){
              this.login.errors = error.response.data.errors.email[0]
            }
          })
        } //submitForm function calibrace closes

      }

    }
    </script>

