<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<form id="idForm" class="form-inline">
	<div class="col-md-1">
		<label class="control-label pull-right">Username : </label>
	</div>
	<div class="col-md-2">
		<input type="text" class="form-control" name="username">
	</div>
	<div class="col-md-1">
		<label class="control-label pull-right">Lastname : </label>
	</div>
	<div class="col-md-2">
		<input type="text" class="form-control" name="lastname">
	</div>
	<input type="text" class="form-control" name="_token" value="{{ csrf_token() }}">
	<button type="submit" class="btn btn-primary">Save</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
$("#idForm").submit(function(e) {
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
           type: "POST",
           url: 'http://localhost/dilok/soap?wsdl&services=customerV3',
           data: form.serialize(),
           success: function(data)
           {
               console.log(data);
           }
         });

    e.preventDefault();
});
</script>