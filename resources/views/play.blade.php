
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ mix('css/fontawesome.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"><style type="text/css">
	input {
		margin: 8px;
	}
</style>

</head>

<body>

        <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-centered"> Update  profile </p>
          <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
          
          <form action="{{ route('update', 1) }}" method="PUT" enctype="multipart/form-data" > <!-- Form tag open -->
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
                          <input class="input" type="text" name="name" autofocus="" required>
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
                          <input class="input" type="email" name="email" autofocus="" required>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="file has-name is-fullwidth">
                  <label class="file-label">
                    <input class="file-input" type="file" name="image">
                    <span class="file-cta">
                      <span class="file-icon">
                        <i class="fas fa-upload"></i>
                      </span>
                      <span class="file-label">
                        Choose a file…
                      </span>
                    </span>
                    <span class="file-name">
                      
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
                          <input class="input" type="text" name="title" autofocus="" required>
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
                </div>

              </div>
              <footer class="card-footer">
                <button  class="card-footer-item has-background-info has-text-white" type="submit"> <i class="fas fa-save fa-lg  has-text-white"> Update </i>  </button>

                <a class="card-footer-item has-background-info has-text-white"> <i class="fas fa-times has-text-white"> Cancel </i> </a>
              </footer>
            </div>
          </form>
        </section>
      </div>
    </div>




</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</html>























