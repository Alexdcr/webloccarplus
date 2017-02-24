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
			<div id="user_edit" class="black-text">
			  <div class="row"></div>
			  <div class="row">
			    <form class="col s12" id="edit_form" method="post" action="{{URL::to('user/save')}}">
			      <div class="row">
			          <input hidden="hidden" id="user_id_edit" name="user_id" value=""/>
			          <input hidden="hidden" id="session_id_edit" name="session_id"/>
			          <input hidden="hidden" id="session_token_edit" name="session_token"/>
			      </div>
			      <div class="row">
			        <div class="input-field col s6">
			          <i class="material-icons prefix">person_outline</i>
			          <input placeholder="Name" name="name" id="name_edit" type="text" class="validate" value="">
			          <label for="name">Name</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">person</i>
			          <input placeholder="Last Name" name="lastname" id="lastname_edit" type="text" class="validate" value="">
			          <label for="lastname">Last Name</label>
			        </div>
			      </div>
			      <div class="row">
							<div class="input-field col s6">
			          <i class="material-icons prefix">email</i>
			          <input id="email_edit" placeholder="example@example"name="email" type="email" class="validate" value="">
			          <label for="email">E-mail</label>
			        </div>
			        <div class="input-field col s6">
			          <i class="material-icons prefix">phone</i>
			          <input id="phone_edit" placeholder="0-00-00-00" name="phone" type="tel" class="validate" value="">
			          <label for="phone">Phone</label>
			        </div>
			      </div>
			      <div class="row">
							<div class="input-field col s6 offset-s6">
			          <a id="to_cancel_edit"  href="#" class="btn waves-effect waves-light buttons-cancel col s5 offset-s1" type="submit" name="cancel">Cancel</a>
			          <button class="btn waves-effect waves-light buttons-forms col s5 offset-s1" type="submit" id="save_edit" name="save">Save</button>
			        </div>
			      </div>
			    </form>
			  </div>
			</div>
    </div>
  </div>
</div>
<!--
  Content Section End
-->
@endsection
