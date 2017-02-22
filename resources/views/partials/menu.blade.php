<!--
  Header Section Start
-->
<div class="navbar-fixed">
  <ul id="dropdown_account" class="dropdown-content">
    @if(!Auth::check())
    <li><a href="{{ URL::to('view/login') }}">Login</a></li>
    <li><a href="{{ URL::to('view/register') }}">Register</a></li>
    @else
		<li><a href="{{ URL::to('view/account') }}">Account</a></li>
    <li><a id="to_logout" href="#">Log Out</a></li>
    @endif
  </ul>
  <nav class="" style="background-color:#0080ff;">
    <div class="nav-wrapper">
      <a href="{{URL::to('/')}}" class="brand-logo center">Location Car +</a>
      @if(!Auth::check())
      <a class="dropdown-button right dropdown-label" data-beloworigin="true" data-hover="true" href="#" id="l_username" data-activates="dropdown_account"><strong>Account</strong><i class="material-icons right" style="margin: 0;">arrow_drop_down</i></a>
      @else
      <a class="dropdown-button right dropdown-label" data-beloworigin="true" data-hover="true" href="#" id="l_username" data-activates="dropdown_account"><strong>{{Auth::user()->name}}</strong><i class="material-icons right" style="margin: 0;">arrow_drop_down</i></a>
      @endif
      <a id="menu_nav" href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="nav-label" href="{{URL::to('view/map')}}">Geo Location</a></li>
        <li class="disabled"><a class="nav-label" href="#">About</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a class="nav-label" href="{{URL::to('view/map')}}">Location</a></li>
        <li class="disabled"><a class="nav-label" href="#">About</a></li>
      </ul>
    </div>
  </nav>
</div>
<!--
  Header Section End
-->
