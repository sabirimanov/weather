<form method="POST">
	@csrf
	<div class="form-group">
		<input type="text" required class="form-control date-input" id="date" name="date" value="{{ date('Y-m-d', strtotime('yesterday')) }}">
	</div>
	<button type="submit" class="btn btn-primary">Retrieve data</button>
</form>