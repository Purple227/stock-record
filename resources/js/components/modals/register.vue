<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";

.card-footer-item
{
  cursor: pointer;
}

</style>


<template>

  <div> 


    <div class="modal is-active" v-if='isActive'>
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-centered"> Register </p>
          <button class="delete" aria-label="close" v-on:click="addActiveClass"></button>
        </header>
        <section class="modal-card-body">

          <div class="" v-if="register.errors">
            <div class="notification is-black is-small" >
              <button class="delete" @click="clearError">></button>
              <ul>
              <li>{{register.errors.email[0]}}</li>
              <li>{{register.errors.password[0]}}</li>
              <li>{{register.errors.name[0]}}</li>
            </ul>
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
                            Name
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="text" v-model="register.name" placeholder="Enter name here" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.register.name.$invalid">
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
                            Email
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="email" v-model="register.email" placeholder="Enter mail here" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.register.email.$invalid">
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
                          <input class="input" type="password" v-model="register.password" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.register.password.$invalid">
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
                            Repeat Password
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="password" v-model="register.passwordConfirmation" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.register.passwordConfirmation.$invalid">
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

              </div>
              <footer class="card-footer">
                <button  class="card-footer-item has-background-info has-text-white" type="submit"> <i class="fas fa-save fa-lg  has-text-white"> Register </i>  </button>

                <a class="card-footer-item has-background-info has-text-white"> <i class="fas fa-times fa-sm has-text-white" @click="addActiveClass"> Cancel </i> </a>
              </footer>
            </div>
          </form>
        </section>
        <footer class="modal-card-foot modal-card-title has-text-centered" >
          <p class="modal-card-title has-text-centered is-small"> Already registered <a @click="addActiveClass"> Login </a> instead </p>
        </footer>
      </div>
    </div>


    <a class="has-text-info" @click="addActiveClass"> register </a>

  </div>

</template>


<script>
import { required, minLength, maxLength, sameAs, email } from 'vuelidate/lib/validators'
import classToggler from '../../mixins/classToggler'

export default{

 mixins: [
 classToggler
 ],

  data() {
    return{
      register: {
        name: null,
        email: null,
        password: null,
        passwordConfirmation: null,
        errors: null,
      },
    }
  },

  validations: {
    register: {
      name: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(20)
      },
      email: {
        required,
        email,
        maxLength: maxLength(255)
      },
      password: {
        required,
        minLength: minLength(6)
      },
      passwordConfirmation: {
        sameAsPassword: sameAs('password')
      },
    }
  },


  methods: {

    clearError() {
        this.register.errors = null
    },

    submit() {
      let api = "api/register"

      this.axios.post(api, {
        name: this.register.name,
        email: this.register.email,
        password: this.register.password,
        password_confirmation: this.register.passwordConfirmation
      }).then((response) => {
            //will make a decision as a progress
            this.$router.go()
          }).catch(error=>{
              this.register.errors = error.response.data.errors
          })
        }
      }

    }
    </script>
