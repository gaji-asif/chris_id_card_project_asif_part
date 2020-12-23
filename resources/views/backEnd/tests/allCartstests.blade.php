<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Test Name<br>& Code</th>

				<th>Price</th>
				<th class="text-right">Action</th>
			</tr>
		</thead>
		<tbody>
			

			@if(session('cart'))
			@foreach(session('cart') as $id => $details)
			
			<tr>
				<td>

					<h6>{{ $details['test_name'] }}<br>Code - {{ $details['code'] }}</h6> </td>

					<td>{{ $details['price'] }}</td>
					<td class="text-right"><button type="button" value="{{ $details['idd']}}" data-row-id="{{ $details['idd']}}" data-toggle="tooltip" title="" class="btn btn-danger waves-effect waves-light remove_cart_test btn-sm">
						Remove
					</button></td>
				</tr>
				@endforeach
				@else
				<tr class="text-center"><td colspan="4" align="center" style="text-align: center; margin:0 auto;">No Test Selected Yet</td></tr>
				@endif
			</tbody>
		</table>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$( "button.remove_cart_test" ).click(function(e){
				e.preventDefault();

				var $row = $(this).parent().parent();
				var rowid = $(this).data("row-id");
      //alert(rowid);

      var formData = {
      	id: $(this).attr("value")
      };
      $.ajax({
      	type: "GET",
      	data: formData,
            //dataType: 'json',
            url: 'remove_cart_test',
            success: function(data) {
               //alert(data);
               $row.remove();
              // $(this).closest('tr').remove();
          },
          error: function(data) {
          	console.log('Error:', data);
          }
      });
  });
		});
	</script>	