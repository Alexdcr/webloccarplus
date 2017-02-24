<!-- Navigation Panel -->
<div class="col s12 m4 l3 ">
	@if (!Auth::check())
		<div class="panel-center z-depth-3 grey lighten-5" style="display: none;">
	@else
		<div class="panel-center z-depth-3 grey lighten-5">
	@endif
		<div class="panel-title">
	    Simulator Panel
	  </div>
		<ul class="collapsible popout" data-collapsible="accordion">
			<li id="car_list">
	      <div id="header_cars" class="collapsible-header panel-list center" href="#">Your Cars</div>
	      <div id="radio_list" class="collapsible-body cars-list minor-padding">
					<p class="cars-radio">
			      <input class="with-gap" name="your_cars" type="radio" id="your_cars_1"/>
			      <label for="your_cars_1" id="label_cars_1">Car 1</label>
			    </p>
			    <p class="cars-radio">
			      <input class="with-gap" name="your_cars" type="radio" id="your_cars_2"/>
			      <label for="your_cars_2" id="label_cars_2">Car 2</label>
			    </p>
			    <p class="cars-radio">
			      <input class="with-gap" name="your_cars" type="radio" id="your_cars_3"/>
			      <label for="your_cars_3" id="label_cars_3">Car 3</label>
			    </p>
				</div>
	    </li>
	    <li>
	      <a class="collapsible-header panel-list center" href="#">
	        <div>Opening of Car Doors</center></div>
				</a>
	    </li>
	    <li>
				<a class="collapsible-header panel-list center" href="#">
	        <div>Ignition of the Car</div>
				</a>
	    </li>
	    <li>
				<a class="collapsible-header panel-list center" href="#">
	        <div>Car Theft</div>
				</a>
	    </li>
	  </ul>
	</div>
</div>
