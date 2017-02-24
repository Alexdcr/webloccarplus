@extends("partials.layouts.welcome_layout")

@section("content")
<!--
  Content Section Start
-->
<div class="col s12 m8 l9">
	<div class="card z-depth-4 grey lighten-4">
    <div class="card-content">
			<ul class="tabs" class="grey lighten-4">
        <li class="tab grey lighten-4"><a class="active" href="#welcome"><strong>Welcome</strong></a></li>
      </ul>
			@if (!Auth::check())
				<!-- Need Login Card -->
	      <div id="welcome" class="black-text">
				  <div class="row center-messages">
				    <div class="center-cards">
				      <div class="card-panel card-desing z-depth-2">
				        You need <a href="{{URL::to('view/register') }}"><strong>register</strong></a> or <a href="{{URL::to('view/login') }}"><strong>login</strong></a> in Location Car to perform a simulation.
				      </div>
				    </div>
				  </div>
	      </div>
			@else
				<!-- welcome Card -->
				@if ($count_cars > 0)

				@else
					<div id="welcome" class="black-text">
						<div class="row center-messages">
					    <div class="center-cards">
					      <div class="card-panel card-desing z-depth-2">
					        You must <a href="{{URL::to('view/cars') }}"><strong>register</strong></a> a new car in your account to perform a simulation.
					      </div>
					    </div>
					  </div>
		      </div>
				@endif
			@endif
    </div>

  </div>
</div>
<!--
  Content Section End
-->
@endsection
