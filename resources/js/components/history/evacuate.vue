<style lang="scss" scoped>

@charset "utf-8";
@import "~bulma/bulma";
@import '~bulma-calendar/dist/css/bulma-calendar.min.css';
@import "../../../sass/partials/_reuse.scss";
@import "../../../sass/partials/_responsive.scss";

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



  <div class="wrapper">  <!-- Div wrapper -->

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

    <div class="" v-if="inventories.length == 0">
      <div class="notification is-black" >
        <button class="delete" @click="getInventoryData()"></button>
        No stocks evacuated on <strong> {{ dateSelectedEmpty || todayDate | moment("Do MMM YYYY") }} </strong>
      </div>
    </div>

    <div class="card"> <!-- Card tag open -->
      <header class="card-header">
        <p class="card-header-title is-centered">
          Evacuated Stocks
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
                <th>Exporter Names</th>
                <th>Tonne</th>
                <th>weight</th>
                <th>Bags</th>
                <th>Added On</th>
                 <th>Action</th>
                </tr>
              </thead>

              <tfoot>
                <tr>
                <th><abbr title="Number">No.</abbr></th>
                <th>Exporter Names</th>
                <th>Tonne</th>
                <th>weight</th>
                <th>Bags</th>
                <th>Added On</th>
                 <th>Action</th>
                </tr>
              </tfoot>

              <tbody>
                <!-- deault table section -->
                <tr v-for="(inventory, index) in inventories" :key="index">

                  <th class="has-text-info"> {{ index+1 }} </th>
                  <td> {{ inventory.name }}</td>
                  <td> {{ inventory.tonne }} </td>
                  <td> {{ inventory.weight}} </td>
                  <td> {{ inventory.bags}} </td>
                  <td> {{ inventory.created_at | moment("Do MMM YYYY, hh:mm a") }} </td>

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

                    <!-- Edit Section -->
                    <router-link :to="{name: 'edit-evacuated', params: {id: inventory.id}}" v-bind:style="myStyle">
                    <i class="fas fa-edit has-text-info" ></i>
                    </router-link>
                    <!-- Edit Section -->
                  </td>
                </tr>

              </tbody>

            </table>

          </div>
        </div>
        <footer class="card-footer">
          <a class="card-footer-item is-bold" @click="getInventoryData(pagination.previousPageUrl)">Previous</a>

          <a class="card-footer-item is-bold" @click="getInventoryData(pagination.dateSelected)"> <input type="date" data-display-mode="dialog"data-show-header="true" data-color="info" data-date-format="YYYY-MM-DD" id="my-element" v-model.lazy="pagination.dateSelected" @click="getInventoryData(pagination.dateSelected)"> <span class="button has-text-info"> Set </span> </a>

          <a class="card-footer-item is-bold" @click="getInventoryData(pagination.nextPageUrl)">Next</a>
        </footer>
      </div>

    </div>  <!-- Div wrapper -->

  </template>


  <script>
  import classToggler from '../../mixins/classToggler'
  import bulmaCalendar from 'bulma-calendar/dist/js/bulma-calendar.min.js'
  import status from '../../mixins/status'

  export default {
    name: "arrived",

    mixins: [
    classToggler, status
    ],

    data() {

     return{

      status: null,
      dateSelectedEmpty: null,
      todayDate: new Date(),
      inventories: [],

      pagination: {
        nextPageUrl: null,
        previousPageUrl: null, 
        dateSelected: null,
      },

      datePicker: {
        dateSelected: null,
      },

      myStyle: {
       marginLeft: '8%',
     },

  } // Return calibrace close
  }, // data calibrace close

  mounted() {
    this.getInventoryData()
    this.bulmaCalendar()
  },

  methods: {
    getInventoryData(api) {
      let api_url = api || "/api/evacuated"
      this.axios
      .get(api_url).then((response) => {
        this.inventories = response.data.data

        let nextPageUrl = response.data.next_page_url
        this.pagination.nextPageUrl = nextPageUrl ? nextPageUrl.slice(21) : null

        let previousPageUrl = response.data.prev_page_url
        this.pagination.previousPageUrl =  previousPageUrl ? previousPageUrl.slice(21) : null
      })
    },

    deleteData(id, index) {
      let api = 'api/evacuated/' + id

      this.axios.delete(api)

      .then((response) => {
        this.inventories.splice(index, 1);
        this.status = true
        this.isActive = false
      })

      .catch(function (error) {
        this.status = false
      });
    },

    bulmaCalendar () {
// Initialize all input of type date//
let calendars = bulmaCalendar.attach('[type="date"]');

// Loop on each calendar initialized
calendars.forEach(calendar => {
  // Add listener to date:selected event
  calendar.on('date:selected', date => {
    console.log(date);
  });
});

// To access to bulmaCalendar instance of an element
let element = document.querySelector('#my-element');
if (element) {
  // bulmaCalendar instance is available as element.bulmaCalendar
  element.bulmaCalendar.on('select', datepicker => {
    let selectedDate = datepicker.data.value()
    selectedDate = selectedDate.replace(/\//g, "-")
    this.dateSelectedEmpty= selectedDate
    this.pagination.dateSelected = "/api/evacuated/date/"+selectedDate
  });
}

}

}

}

</script>
