@extends("partials.layouts.cars_layout")

@section("content")
<!--
  Content Section Start
-->
<div class="col s12 m8 l9">
	<div class="card z-depth-4 grey lighten-4">
    <div class="card-content">
			<ul class="tabs" class="grey lighten-4">
				<li class="tab grey lighten-4"><a class="active" href="#new_car"><strong>New Cars</strong></a></li>
				<li class="tab grey lighten-4"><a href="#cars_list"><strong>List of Cars</strong></a></li>
			</ul>
			<!-- Cars of User List Card -->
			<div id="cars_list" class="black-text">
				<div class="row"></div>
				<table class="responsive-table bordered black-text">
					<thead>
						<tr>
								<th class="center" data-field="model">Model</th>
								<th class="center" data-field="alarm">Alarm</th>
								<th class="center" data-field="shared">Shared</th>
								<th class="center" data-field="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
						@if ($count_cars > 0)
							@for ($i = 0; $i < $count_cars; $i++)
								<tr>
										@if ($user_cars[$i]->car_type === 1)
											<td class="center">Touring</td>
										@elseif ($user_cars[$i]->car_type === 2)
											<td class="center">Sports</td>
										@elseif ($user_cars[$i]->car_type === 3)
											<td class="center">Pickup</td>
										@endif

										@if ($user_cars[$i]->alarm_active)
											<td class="center">Active</td>
										@else
											<td class="center">Disabled</td>
										@endif

										@if ($user_cars[$i]->shared_active)
											<td class="center">Active</td>
										@else
											<td class="center">Disabled</td>
										@endif

										<!-- Modal Trigger -->
										<td class="center">
											<a id="edit_user" data-ucarid="{{$user_cars[$i]->id}}" class="black-text tooltipped" href="#" data-position="left" data-delay="50" data-tooltip="Edit"><i class="material-icons">mode_edit</i></a>
											<a data-ucarid="{{$user_cars[$i]->id}}" class="black-text tooltipped modal-trigger" href="#modal_delete" data-position="right" data-delay="50" data-tooltip="Delete"><i class="material-icons">delete</i></a>
										<td>
										<!-- Modal Structure -->
										<div id="modal_delete" class="modal cars-modal">
											<div class="modal-content black-text">
												<h4>Delete Car</h4>
												<p>You are sure to delete this car of your account?</p>
											</div>
											<div class="modal-footer">
												<a id="delete_car" href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Delete</a>
												<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
											</div>
										</div>
								</tr>
							@endfor
						@else
							<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
							</tr>
					@endif
					</tbody>
				</table>
			</div>
			<!-- New Car User Register Card -->
			<div id="new_car" class="black-text">
				<div class="row"></div>
				<div class="row" style="margin-top:4%;">
					<div class="row">
						<div class="input-field col s6" style="margin: 0 30% 0 30%">
							<i class="material-icons prefix">directions_car</i>
					    <select name="model_car" id="model_car">
					      <option value="" disabled selected>Choose your option</option>
								<option value="1">Option 1</option>
					      <option value="2">Option 2</option>
					      <option value="3">Option 3</option>
					    </select>
					    <label>Models</label>
					  </div>
					</div>
					<div id="car_class">
						@foreach ($car_types as $car)
						<div class="col s4">
		          <div class="card">
		            <div class="card-image">
		              <img src="../img/car_{{ $car->model }}.png" style="padding: 5%;">
		            </div>
		            <div class="card-action">
									<!-- Modal Trigger -->
		              <a data-tcarid="{{$car->id}}" class="modal-trigger" href="#modal_cr_{{ $car->model }}">New {{ ucfirst($car->model) }} Car</a>
									<!-- Modal Structure -->
									<div id="modal_cr_{{ $car->model }}" class="modal cars-modal">
										<div class="modal-content black-text">
											<h4>Add New Car</h4>
											<p>You are sure to add a {{ $car->model }} car in your account?</p>
										</div>
										<div class="modal-footer">
											<a id="add_new_car" href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Add</a>
											<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
										</div>
									</div>
								</div>
		          </div>
		        </div>
						@endforeach
					</div>
	      </div>
    	</div>
  	</div>
	</div>
</div>
<!--
  Content Section End
-->
@endsection
