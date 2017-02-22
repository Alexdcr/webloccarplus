@extends("partials.layouts.login_layout")

@section("content")
<!--
  Content Section Start
-->
<div class="row card-forms">
  <div class="col s12 z-depth-5 blue-grey lighten-5 card-panel auto-size">
    <form id="login_form" method="post" action="{{URL::to('/user/login')}}">
      <div class="row center logo-forms">
        <div class="auto-size">
          <a href="{{URL::to('/')}}" class="center" style="font-size: 2.5em;">Location Car</a>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input class="validate" id="account" name="account" type="text">
          <label for="account" class="center-align">E-mail / Username</label>
        </div>
				<div id="email_message_div" class="col s12 error-messages"></div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">lock_outline</i>
          <input id="password" name="password" type="password" min="6">
          <label for="password" class="center-align">Password: (6 char min)</label>
        </div>
				<div id="pass_message_div" class="col s12 error-messages"></div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button class="btn waves-effect waves-light col s12 buttons-forms" type="submit" id="Login" name="Login"> Login </button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"><a href="{{URL::to('/view/register')}}">Register Now!</a></p>
        </div>
        <div class="input-field col s6 m6 l6">
            <p class="margin right-align medium-small"><a href="{{URL::to('/view/forgot')}}">Forgot password?</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
<!--
  Content Section End
-->
@endsection
