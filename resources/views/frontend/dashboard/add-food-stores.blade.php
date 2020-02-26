@extends('frontend.dashboard.layout.master')

@section('title', 'Listing')

@section('styling')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/css/food_order.css') }}">
@endsection
@section('content')

@include('frontend.dashboard.menu.menu')
<div class="main-panel">
	<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar bar1"></span>
            <span class="icon-bar bar2"></span>
            <span class="icon-bar bar3"></span>
        </button>
        <a class="navbar-brand" href="#">My Listing</a>
      </div>
    </div>
  </nav>
	<div class="content">
	  <div class="container-fluid food-order">
			<div class="row">
				<div class="cards">
					<div class="row" style="padding: 20px;">
						<div class="col-md-offset-2 col-md-8 text-center">
						<button class="btn btn-success btn-lg" id="orderOnline"> <i class="fa fa-home"></i>My Stores</button>
			            <button class="btn btn-success btn-lg" id="category"> <i class="fa fa-list"></i> Add Store</button>

						</div>
					</div>
					<div class="row" style="margin: 30px auto;" id="orderOnlineTable">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped"  id="store_data">
								<thead>
									<tr>
										<th>Store Name</th>
										<th>Service Type</th>
										<th>Store Address</th>
										<th>Mobile Numnber</th>
										<th>Email Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($stores as $store)
									<tr id="tbl_show{{$store->store_id}}">
										<td>{{$store->store_name}}</td>
										<td>@if($store->service == 'o2o')
									         O2O
											 @else
											 Door To Door
											 @endif
										</td>
										<td>{{$store->address}}</td>
										<td>{{$store->mobileno}}</td>
										<td>{{$store->email}}</td>
										<td class="text-center">
											<a href="{{url('/dashboard/edit-store/'.$store->store_id)}}" class="btn btn-xs btn-warning">Edit</a>
											<a onclick="delete_product('{{$store->store_id}}');" class="btn btn-xs btn-danger">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
	<!-- Category List -->

					<div class="row" style="margin: 30px auto;display: none;" id="categoryTable">
						<div class="col-md-offset-2 col-md-8 category-form">
							<div class="panel panel-default">
							    <div class="panel-heading">Add Stores</div>
							    <div class="panel-body">
										<div id="category_success" class="alert alert-success alert-dismissible" style="display: none;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<span>New Category Created Successfully</span>
										</div>
							         	<form action="" method="POST" id="add_category" class="form-horizontal" role="form">
                                       {{ csrf_field() }}
											<div class="form-group">
							    			<label>Select Service</label>
												<select class="form-control main_foodcategory" name="service">
												<option value="" >Select Service</option>
												<option value="o2o" >O2O</option>
												<option value="d2d" >Door to Door</option>

												</select>
							    	    	</div>
										<div class="form-group">
							    			<label>Enter Store Name</label>
							    			<input type="text"  name="store_name" class="form-control">
							    		</div>

							    		<div class="form-group">
							    			<label>Food Category</label>
							    			<select class="form-control" name="product_name[]">
							    				<option value="">Select Main Category</option>
							    				@foreach($main_category as $cat)
							    				<option value="{{$cat->main_category_id}}">{{BookingYo::foodCategoryName($cat->main_category_id)}}</option>
							    				@endforeach
							    			</select>
							    		</div>

							    		<div class="form-group" id="list_wrapper">
												<label>Product</label>
												<div class="field_wrapper">
													<div class="row">
														<div class="col-md-5" style="display: flex;">
															<label>Name</label>
											    			<select class="form-control" name="product_name[]">
											    				<option value="">Select Main Category</option>
											    				@foreach($main_category as $cat)
											    				<option value="{{$cat->main_category_id}}">{{$cat->main_category_id}}</option>
											    				@endforeach
											    			</select>
														</div>
														<div class="col-md-5" style="display: flex;">
															<label>Quantity</label>
																<input type="number" class="form-control" name="quantity[]" value="" placeholder="Item Quantity">
														</div>

															<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i>
															</a>
													</div>
												</div>
										 </div>

							    		<!-- <div class="form-group">
 											 <label>Stock</label>
 											 <input type="number" name="quantity" class="form-control">
 										 </div> -->

									    <div class="col-md-4">
											<div class="form-group">
												<label>Country</label>
												<select class="form-controls border-input job-country " name="country">
													<option value="" >Select Country</option>
													@foreach(BookingYo::getJobCountries() as $cntry)
													<option value="{{ $cntry->id }}">{{$cntry->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>State</label>
											<select class="form-controls border-input job-state" name="state"  required>

											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>City</label>
											<select class="form-controls border-input job-city" name="city" required>
											</select>
										</div>
									</div>
									<div class="form-group">
							    			<label>Enter Store Address</label>
							    			<input type="text" id="pac-input" name="address" class="form-control">
							    		</div>
										<div class="form-group">
							    			<label>Enter Store Email</label>
							    			<input type="text" id="pac-input" name="email" class="form-control">
							    		</div>
										<div class="form-group">
							    			<label>Enter Store Phone No</label>
							    			<input type="number" name="phoneno" class="form-control" placeholder="Enter Store Phone No">
							    		</div>
										<div class="form-group">
							    			<label>Enter Mobile No</label>
							    			<input type="number"  name="mobileno" class="form-control" placeholder="Enter Store Phone No">
							    		</div>
											<input type="hidden" name="listing_id" value="{{$listing_id}}">
											<input type="hidden" name="latitude" id="lat" >
											<input type="hidden" name="longitude" id="lng">

							    		<div class="form-group text-right">
						    				<button type="submit" id="category_submit_btn" class="btn btn-primary">Submit</button>
							    		</div>
							    	</form>
							    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
@section('script')
<script>
	$('#category').click(function(){
		$('#categoryTable').show();
		$('#orderOnlineTable').hide()
	});
	$('#orderOnline').click(function(){
		$('#categoryTable').hide();
		$('#orderOnlineTable').show()
	});
</script>
<script>
  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initMap() {


    var input = document.getElementById('pac-input');


    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.


    // Set the data fields to return when the user selects a place.

    autocomplete.addListener('place_changed', function() {


      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      var lat = place.geometry.location.lat(),
      lng = place.geometry.location.lng();

      // Then do whatever you want with them
      $('#lat').val(lat);
      $('#lng').val(lng);
      console.log(lat);
      console.log(lng);
    });


  }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>
<script>

$('.job-country').on('change',function(){
	var countryId = $(this).val();
	getStates(countryId,'job-state')
})
function getStates(countryId,cType){
	$.ajax({
		url: "{{ url('get-state') }}/"+countryId,
		success: function(response){
			var currentState = $('.'+cType).attr('data-state');
			// alert(currentState);
			var obj = $.parseJSON(response);
			$('.'+cType).html('');
			var newOption = new Option('Select State', '0', true, false);
			$('.'+cType).append(newOption).trigger('change');
			$.each(obj,function(i,k){
				var vOption = k.id == currentState ? true : false;
				var newOption = new Option(k.name, k.id, true, vOption);
				$('.'+cType).append(newOption);
			})
			$('.'+cType).trigger('change');
		}
	})
}
$('.job-state').on('change',function(){
	var stateId = $(this).val();
	getCities(stateId,'job-city');
})


function getCities(stateId,cType){
	if(stateId == '0'){
		$('.'+cType).html('').trigger('change');
		var newOption = new Option('Select City', '0', true, false);
		$('.'+cType).append(newOption).trigger('change');
		return false;
	}
	$.ajax({
		url: "{{ url('get-city') }}/"+stateId,
		success: function(response){
			var currentCity = $('.'+cType).attr('data-city');
			var obj = $.parseJSON(response);
			$('.'+cType).html('').trigger('change');
			var newOption = new Option('Select City', '0', true, false);
			$('.'+cType).append(newOption).trigger('change');
			$.each(obj,function(i,k){
				var vOption = k.id == currentCity ? true : false;
				var newOption = new Option(k.name, k.id, true, vOption);
				$('.'+cType).append(newOption).trigger('change');
			})
		}
	})
}
// Add Category through ajax
$("#add_category").on('submit', function (e) {
	// alert('hello');
	e.preventDefault();
	form = new FormData(this);
	// var formVal = $('form#add_category').serialize();
	console.log(form);
	// var actionUrl = "{{ url('/add_category')}}";
	$.ajax({
		type: "POST",
		url:" {{ url('/dashboard/addstore/'.$listing_id)}}",
		data: form,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			console.log(data);
			$('#store_data tbody').html(data);
			$('#add_category').trigger("reset");
			toastr.success('Store Added successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
			$('#categoryTable').hide();
		$('#orderOnlineTable').show()
		},
		error: function() {
			$('#loading').hide();
			$('#checkcatid').prop("disabled",false);
			alert("Error posting feed");
		}
	});
	//return false;
});
function delete_product(store_id) {
// alert(product_id);
if (confirm('Are you sure want to delete this menu')) {
		$.ajax({
			url: "{{url('/dashboard/delete_store')}}/"+store_id,
			success: function (response) {
				console.log(response);
				if (response == "1") {
					toastr.success('Store Deleted successfully', '', {timeOut: 5000, positionClass: "toast-top-right"});
					$('#tbl_show'+store_id).remove();

				}
			}
		});
}
}

$(document).ready(function(){
	
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

	
    var x = 1; //Initial field counter is 1
   
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter

			var data  = $("#list_wrapper div:eq(0)").clone(true).appendTo("#list_wrapper");
			    data.find("input").val('');
			    data.find('.add_button').remove();
			    data.find('.row').append('<a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus"><i></a>');
					
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


</script>
@endsection
