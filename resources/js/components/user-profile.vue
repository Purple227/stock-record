<style lang="scss" scoped>

@charset "utf-8";

@import "~bulma/bulma";
@import "~animate.css/animate";
@import "../../sass/partials/_reuse.scss";
@import "../../sass/partials/_color.scss";

.container {
  margin-top: 25px;
  padding: 25px;
}

</style>


<template>

	<div class="container">


    <div class="columns is-gapless">


      <div class="column is-4">

<!--               <div class="tile is-parent">
        <article class="tile is-child notification is-info">
          <p class="title">Middle tile</p>
          <p class="subtitle">With an image</p>
          <figure class="image is-4by3">
            <img src="https://bulma.io/images/placeholders/640x480.png">
          </figure>
        </article>
      </div> -->

<div class="tile is-ancestor">
        <div class="tile is-parent">
        <article class="tile is-child notification is-info">
          <!--p class="title">Middle tile</p-->
          <p class="subtitle"> {{userData.name}}</p>
          <figure class="image is-4by3">
            <img :src="getImagePath" :alt="userData.name">
          </figure>
        </article>
      </div>
</div>


<!--         <div class="card">
          <div class="card-image">
            <figure class="image is-5by3">
              <img :src="getImagePath" alt="Placeholder image">
            </figure>
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-left">
                <figure class="image is-48x48">
                  <img :src="getImagePath" alt="Placeholder image">
                </figure>
              </div>
              <div class="media-content">
                <p class="title is-4" style="margin-top: 6px;">{{userData.name}}</p>
              </div>
            </div>


  </div>
</div> -->
</div>




<div class="column has-background-white is-marginless">

  <div class="notification is-info is-bold has-text-centered">
   {{userData.title}}
 </div>

 <div class="card-content">
  <div class="content">

    <article class="message is-info">
      <div class="message-body">
        {{userData.description}}
      </div>
    </article>

  </div>
</div>

</div>

</div>


</div>

</template>


<script>

export default 
{

	name: "user-profile",

	data() {
		return{
			userData: {
        name: null,
        image: null,
        title: null,
        description: null,
      }
		}
	},

	created() {
		this.getUserProfile()
	},

	methods: {

		getUserProfile() {
			let api_url = "user/authId"
			this.axios
			.get(api_url).then((response) => {
				this.userData = response.data
			})
		},

},//method calibrace closes

  computed: {
    // a computed getter
    getImagePath: function () {
      // `this` points to the vm instance
      let originalPath = this.userData.image
      let laravelRootPath = 'Storage/'
      let completePath = laravelRootPath + originalPath
      return this.userData.image = completePath
    }
  }

}

</script>
