
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<style type="text/css">
	input {
		margin: 8px;
	}
</style>

</head>

<body>

  <form action="{{url('/api/inventoryEvacuation')}}" method="POST">
    @csrf
  <label> Name: </label> <br>
  <input type="text" name="name"> <br>

  <label> Tonne: </label> <br>
  <input type="text" name="tonne"> <br>

  <label> weight: </label> <br>
  <input type="text" name="weight"> <br>

  <label> Bags: </label> <br>
  <input type="text" name="bags"> <br>

    <input type="submit" value="Submit">

</form>


</body>


</html>























