<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_responsive.scss";

.wrapper
  {
  display:flex; 
  flex-direction:column; 
  justify-content:center;
  position: relative;
  min-height: 50vh;
}

i
  {
  cursor: pointer;
}

</style>


<template>



  <div class="wrapper" v-bind:style="myStyle">  <!-- Div wrapper -->

    <div class="" v-if="status">
      <div class="notification is-black" >
        <button class="delete" @click="status = null "></button>
        Task deleted succesfully
      </div>
    </div>

    <div class="" v-if="status == false">
      <div class="notification is-black" >
        <button class="delete" @click="status = null "></button>
        Task cancelled
      </div>
    </div>

    <div class="card"> <!-- Card tag open -->
      <header class="card-header">
        <p class="card-header-title is-centered">
          Inventory Datas
        </p>
      </header>
      <div class="card-content">
        <div class="content table-container">

          <!-- Main container -->
          <nav class="level is-mobile">
            <!-- Left side -->
            <div class="level-left">
              <div class="level-item">
                <!-- Design flow will get in here -->
              </div>
            </div> <!-- Level left tag close -->

            <!-- Right side -->
            <div class="level-right">
              <p class="level-item">
                <!-- Design flow will get in here -->
              </p>
            </div>
          </nav>

          <table class="table is-bordered "> 

            <thead>
              <tr>
                <th><abbr title="Number">No.</abbr></th>
                <th>Weight</th>
                <th>Discount</th>
                <th>Bags</th>
                <th>Added On
                  <th>Action</th>
                </tr>
              </thead>

              <tfoot>
                <tr>
                  <th><abbr title="Number">No.</abbr></th>
                  <th>Weight</th>
                  <th>Discount</th>
                  <th>Bags</th>
                  <th>added On </th>
                  <th>Action</th>
                </tr>
              </tfoot>

              <tbody>

                <tr v-for="(inventory, index) in inventories" :key="index">

                  <th class="has-text-info"> {{ index+1 }} </th>
                  <td class=""> {{ inventory.total_weight }} </td>
                  <td class="is_hidden_mobile_tablet"> {{ inventory.total_discount}} </td>
                  <td class="is_hidden_mobile_tablet"> {{ inventory.total_bags}} </td>
                  <td class="is_hidden_mobile_tablet"> {{ inventory.created_at}} </td>

                  <td class="has-text-centered"> 
                    <div class="modal is-active is-rounded" v-if='isActive'>
                      <div class="modal-background"></div>
                      <div class="modal-card">
                        <section class="modal-card-body">
                          <div class="card-content">
                            <p class="subtitle"> Are You Sure </p>
                          </div>
                          <footer class="card-footer">
                            <a class="card-footer-item is-bold has-text-danger" v-on:click="deleteData(inventory.id, index)">Delete</a>
                            <a class="card-footer-item is-bold has-text-info" v-on:click="isActive = false, status = false">Cancel</a>
                          </footer>
                        </section>
                      </div>
                    </div>
                    <i class="fas fa-trash has-text-info" v-on:click="addActiveClass"></i>
                  </td>

                </tr>

              </tbody>

            </table>

          </div>
        </div>
        <footer class="card-footer">
          <a class="card-footer-item is-bold" @click="getInventoryData(pagination.previousPageUrl)">Previous</a>
          <a class="card-footer-item is-bold" @click="getInventoryData(pagination.nextPageUrl)">Next</a>
        </footer>
      </div>

    </div>  <!-- Div wrapper -->

  </template>


  <script>
  import classToggler from '../mixins/classToggler'

  export default {
    name: "history",

    mixins: [
    classToggler
    ],

    data() {

     return{

      status: null,

      inventories: [],

      pagination: {
        nextPageUrl: null,
        previousPageUrl: null, 
      },

      myStyle: {
       marginTop: '4%',
     },

  } // Return calibrace close
  }, // data calibrace close

  mounted() {
    this.getInventoryData()
  },

  methods: {
    getInventoryData(api) {
      let api_url = api || "/api/inventory"
      this.axios
      .get(api_url).then((response) => {
        this.inventories = response.data.data

        let nextPageUrl = response.data.next_page_url
        this.pagination.nextPageUrl = nextPageUrl ? nextPageUrl.slice(21) : null

        let previousPageUrl = response.data.prev_page_url
        this.pagination.previousPageUrl =  previousPageUrl ? previousPageUrl.slice(21) : null
      })
    },


    nextPage() {
      this.formStep.step++;
    },

    prevousPage() {
      this.formStep.step--;
    },

    deleteData(id, index) {
      let api = 'api/inventory/' + id

      this.axios.delete(api)

      .then((response) => {
        this.inventories.splice(index, 1);
        this.status = true
        this.isActive = false
      })

      .catch(function (error) {
        this.status = false
      });

    }
  }

}

</script>


























