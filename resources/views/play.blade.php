
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

  <form action="{{url('/api/inventory')}}" method="POST">
    @csrf
  <label> Weight Total: </label> <br>
  <input type="text" name="total_weight"> <br>

  <label> Discount Total: </label> <br>
  <input type="text" name="total_discount"> <br>

  <label> Total Bags: </label> <br>
  <input type="text" name="total_bags"> <br>

    <input type="submit" value="Submit">

</form>


</body>


</html>























