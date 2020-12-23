@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
.right_margin{
	margin-right: 30px;
	color: #000000;
}
.strong_class{
	font-weight: 500;
	font-size: 16px;
}
.card-block{
	background-color: #f3f3f3;
	
}
.media{
	background-color: #FFFFFF;
	padding: 20px;
	padding-top: 40px;
}
.add_to_cart:hover{
	background-color: #00bcd4;
	color: #000;
}
</style>
<div class="row">
	<div class="col-lg-9">
		<div class="card">
			<div class="card-header">
				<h5>Search Results</h5>
				<div class="pull-right mr-3">
					{{ Form::open(['class' => '', 'files' => true, 'url' => 'search_test', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
					<div class="row" style="margin-bottom: -25px;">


						<div class="form-group col-md-9">

							<input type="text" class="form-control  {{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code') }}" name="search_result" placeholder="Search Tests" />
							@if ($errors->has('code'))
							<span class="invalid-feedback" role="alert" >
								<span class="messages"><strong>{{ $errors->first('code') }}</strong></span>
							</span>
							@endif
						</div>

						<div class="form-group col-md-2 mr-2">
							<button style="padding:6px 8px !important;" type="submit" class="btn btn-primary m-b-0">Search</button>
						</div>
					</div>
					{{ Form::close()}}
				</div>
			</div>
			<div class="card-block">

				<table id="basic-btn" class="table table-bordered nowrap">
					<thead style="display: none;">
						<tr>
							<th>Patient ID</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $all)
						<tr>

							<div class="card-block">
								<div class="media">

									<div class="media-body">
										<div class="col-lg-12 col-md-12">
											<div class="col-xs-12 col-lg-12 col-md-12">
												<h6 class="d-inline-block">
													<strong class="strong_class" style="color: #000000;">Test Name: </strong> {{$all->test_name}}</h6>
													<label class="label label-info btn-sm" style="font-size: 100%;">{{$all->price}}</label>


													<button type="button" value="{{$all->id}}" data-toggle="tooltip" title="" class="add_to_cart btn btn-facebook waves-effect waves-light pull-right">
														Add
													</button>

												</div>
												<div class="f-13 text-muted m-b-15 col-lg-12">
													<span class="mr-6 right_margin"><strong class="strong_class">Code: </strong> {{$all->code}}</span>
													<span class="mr-6 right_margin"><strong class="strong_class">SAMPLE REQS: </strong> {{$all->sample_e_request}}</span>
													<span class="mr-6 right_margin"><strong class="strong_class">Turnaround Time: </strong> {{$all->turn_around_time}}</span>
													<span class="mr-6 right_margin"><strong class="strong_class">Page:</strong> {{$all->page}}</span>
												</div>
												<p class="col-lg-12"><strong class="strong_class" style="color: #000000;">Details :</strong> <?php echo wordwrap($all->details,140,"<br>\n",TRUE);?></p>
												<p class="col-lg-12">
													<span class="mr-6 right_margin"><strong class="strong_class">location constraints: </strong> {{$all->special_instruction_codes}}</span>
													<span class="mr-6 right_margin"><strong class="strong_class">Special Instructions Full Descriptions: </strong>{{$all->special_instruction}}</span>
												</p>

											</div>



										</div>
									</div>
								</div>


							</tr>
							@endforeach

						</tbody>
					</table>

				</div>

			</div>
		</div>
		<div class="col-lg-3">
			<div class="row">
				<div class="col-lg-12">
					<div class="card table-card">
						<div class="card-header">
							<h5>Your selected Tests</h5>
							<div class="card-header-right" style="margin-top: -10px;">
								<a href="{{route('checkout')}}" class="btn btn-success pull-right ">Next</a>
							</div>
						</div>
						<div class="card-block wrapper">
							@include('backEnd.tests.allCartstests') 
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<script type="text/javascript">
		
		$( "button.remove_cart_test" ).click(function(e){
			alert("test");
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
								</script>

								@endSection