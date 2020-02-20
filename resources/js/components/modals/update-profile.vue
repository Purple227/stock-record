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

    <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-centered"> Update {{update.name}} profile </p>
          <button class="delete" aria-label="close" v-on:click="home"></button>
        </header>
        <section class="modal-card-body">

          <div class="" v-if="errors">
            <div class="notification is-black is-small" >
              <button class="delete" @click="clearError">></button>
              <ul>
              <li>{{ errors.name }}</li>
              <li>{{ errors.title }}</li>
              <li>{{ errors.description }}</li>
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
                          <input class="input" type="text" v-model="update.name" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.update.name.$invalid">
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

                <div class="file has-name is-fullwidth">
                  <label class="file-label">
                    <input class="file-input" type="file" @change="fileChange">
                    <span class="file-cta">
                      <span class="file-icon">
                        <i class="fas fa-upload"></i>
                      </span>
                      <span class="file-label">
                        Choose a file…
                      </span>
                    </span>
                    <span class="file-name">
                      {{ imageName || update.image}}
                    </span>
                  </label>
                </div>

                <div class="field" style="margin-top: 18px;">
                  <div class="field-label"></div>
                  <div class="field-body">
                    <div class="field is-expanded">
                      <div class="field has-addons">
                        <p class="control">
                          <a class="button is-static is-bold has-text-black">
                            Title
                          </a>
                        </p>
                        <p class="control is-expanded has-icons-right">
                          <input class="input" type="text" v-model="update.title" autofocus="" required>
                          <span class="icon is-small is-right" v-if="$v.update.title.$invalid">
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


                <div class="field has-icons-right">
                  <label class="label">Description</label>
                  <div class="control">
                    <textarea class="textarea" v-model="update.description" required> </textarea>
                  </div>
                  <p class="help is-danger" v-if="$v.update.description.$invalid">Not less than {{ $v.update.description.$params.minLength.min }} characters</p>
                    <p class="help is-info" v-else>You straight</p>
                </div>

              </div>
              <footer class="card-footer">
                <button  class="card-footer-item has-background-info has-text-white" type="submit"> <i class="fas fa-save fa-lg  has-text-white"> Update </i>  </button>

                <a class="card-footer-item has-background-info has-text-white"> <i class="fas fa-times has-text-white" @click="home"> Cancel </i> </a>
              </footer>
            </div>
          </form>
        </section>
      </div>
    </div>

</template>


<script>
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import classToggler from '../../mixins/classToggler'

export default{

 mixins: [
 classToggler
 ],

 data() {
  return{
    update:{
      name:null,
      image:null,
      title:null,
      description: null,
    },

    errors: null,
    imageName: null,
  }
},

validations: {
  update: {
    name: {
      required,
      minLength: minLength(3),
      maxLength: maxLength(20)
    },

    title: {
      required,
      minLength: minLength(3),
      maxLength: maxLength(20)
    },
    description: {
      required,
      minLength: minLength(150),
      maxLength: maxLength(374)
    },

  }
},

created() {
  this.getUserProfile()
},


methods: {

  clearError() {
      this.errors = null
  },

  fileChange(e) {
    this.imageName = e.target.files[0].name
    this.update.image = e.target.files[0]
  },

  home() {
    this.$router.push({name:'home'})
  },

  submit(e) {
    let api = "user/update"

    const config = {
      headers: { 'content-type': 'application/x-www-form-urlencoded' }
    }

    let formData = new FormData();
    formData.append("_method", "put");
    formData.append('file', this.update.image);
    formData.append('name', this.update.name);
    formData.append('title', this.update.title);
    formData.append('description', this.update.description);

    this.axios.post(api, formData, config).then((response) => {
            //will make a decision as a progress
            this.$router.push({name:'home'})
          }).catch(error=>{
            this.errors = error.response.data.errors
          })
        },

        getUserProfile() {
          let api_url = "user/authId/edit"
          this.axios
          .get(api_url).then((response) => {
            this.update = response.data
          })
        },

      }

    }
    </script>
