@extends("partials.layouts.account_layout")

@section("content")
<!--
  Content Section Start
-->
<div class="col s12 m8 l9">
	<div class="card z-depth-4 grey lighten-4">
    <div class="card-content">
			<ul class="tabs" class="grey lighten-4">
        <li class="tab grey lighten-4"><a class="active" href="#welcome"><strong>Account</strong></a></li>
      </ul>
				<!-- User Data Card -->
	      <div id="welcome" class="black-text">
				  <div class="row center-messages">
				    <div class="center-cards">
				      <div class="card-panel card-desing z-depth-2">
				        You need <a href="{{URL::to('view/register') }}"><strong>register</strong></a> or <a href="{{URL::to('view/login') }}"><strong>login</strong></a> in Location Car to perform a simulation.
				      </div>
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
