@extends("partials.layouts.register_layout")

@section("content")
<!--
  Content Section Start
-->
<div class="row card-forms">
  <div class="col s12 z-depth-5 blue-grey lighten-5 card-panel auto-size">
    <form id="register_form" method="post" action="{{URL::to('/user/register')}}">
      <div class="row center logo-forms">
        <div class="auto-size">
          <a href="{{URL::to('/')}}" class="center" style="font-size: 2.5em;">Location Car</a>
        </div>
      </div>
			<div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="name" name="name" type="text" class="validate">
          <label for="name" class="center-align">Name</label>
        </div>
				<div id="name_message_div" class="col s12 error-messages"></div>
      </div>
      <!--<div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="username" name="username" type="text" class="validate">
          <label for="username" class="center-align">Username</label>
        </div>
      </div>-->
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="email" name="email" type="email" class="validate">
          <label for="email" class="center-align">Email</label>
        </div>
				<div id="email_message_div" class="col s12 error-messages"></div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">lock_outline</i>
          <input id="password" name="password" type="password" class="validate" min="6">
          <label for="password" class="center-align">Password: (Min 6 characters)</label>
        </div>
				<div id="pass_message_div" class="col s12 error-messages"></div>
      </div>
			<div class="row">
        <div class="input-field col s12">
          <button class="btn waves-effect waves-light col s12 buttons-forms" type="submit" name="Register">Register Now</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <p class="margin center medium-small sign-up">Already have an account? <a href="{{URL::to('/view/login')}}">Login</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
<!--
  Content Section End
-->
@endsection
