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
</style>
<div class="card">
	<div class="card-header">
		<h5>Test Lists</h5>
		<!-- <a style="float: right; margin: 0 auto; margin-top: -25px;">  -->
			<div class="dropdown" style="float: right; margin: 0 auto; margin-top: -10px;">
				<button type="button" class="btn btn-info text-center" data-toggle="dropdown" style="margin: 0 auto;">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">@if(session('cart')!==null)
						{{ count(session('cart')) }}
					@endif</span>
				</button>
				<div class="dropdown-menu">
					<div class="row total-header-section">
						<div class="col-lg-6 col-sm-6 col-6">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">@if(session('cart')!==null)
								{{ count(session('cart')) }}
							@endif</span>
						</div>

						<?php $total = 0 ?>



						@if(session('cart')!==null)
						@foreach(session('cart') as $id => $details)
						<?php $total += $details['price'] * $details['quantity'] ?>
						@endforeach
						@endif

						<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
							<p>Total: <span class="text-info">$ {{ $total }}</span></p>
						</div>
					</div>

					@if(session('cart'))
					@foreach(session('cart') as $id => $details)
					<div class="row cart-detail">
						
						<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
							<p>{{ $details['test_name'] }}</p>
							<span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
						</div>
					</div>
					@endforeach
					@endif
					
				</div>
			</div>
			<!-- </a> -->
			<a href="{{ url('test') }}" style="float: right; padding: 11px; margin-right: 25px;  margin-top: -10px;" class="btn btn-success"> Refresh </a>

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
					<td>
						<div class="card-block">
							<div class="media">

								<div class="media-body">
									<div class="col-lg-12 col-md-12">
										<div class="col-xs-12 col-lg-12 col-md-12">
											<h6 class="d-inline-block">
												<strong class="strong_class" style="color: #000000;">Test Name: </strong> {{$all->test_name}}</h6>
												<label class="label label-info">{{$all->price}}</label>
												<a href="{{ url('add-to-cart/'.$all->id.'/'.$test_name.'/'.$code.'/'.$details) }}">
												<button type="button" data-toggle="tooltip" title="" class="btn btn-facebook waves-effect waves-light pull-right">
													Add
												</button>
											   </a>
											</div>
											<div class="f-13 text-muted m-b-15 col-lg-12">
												<span class="mr-6 right_margin"><strong class="strong_class">Code: </strong> {{$all->code}}</span>
												<span class="mr-6 right_margin"><strong class="strong_class">SAMPLE REQS: </strong> {{$all->sample_e_request}}</span>
												<span class="mr-6 right_margin"><strong class="strong_class">Turnaround Time: </strong> {{$all->turn_around_time}}</span>
												<span class="mr-6 right_margin"><strong class="strong_class">Page:</strong> {{$all->page}}</span>
											</div>
											<p class="col-lg-12"><strong class="strong_class" style="color: #000000;">Details :</strong> {{$all->details}}</p>
											<p class="col-lg-12">
												<span class="mr-6 right_margin"><strong class="strong_class">Special Instructions Codes: </strong> {{$all->special_instruction_codes}}</span>
												<span class="mr-6 right_margin"><strong class="strong_class">Special Instructions Full Descriptions: </strong>{{$all->special_instruction}}</span>
											</p>

										</div>



									</div>
								</div>
							</div>
						</td>

					</tr>
					@endforeach

				</tbody>
			</table>






		</div>


		


	</div>



	@endSection