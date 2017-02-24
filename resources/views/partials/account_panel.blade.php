<!-- Navigation Panel -->
<div class="col s12 m4 l3 ">
	@if (!Auth::check())
		<div class="panel-center z-depth-3 grey lighten-5" style="display: none;">
	@else
		<div class="panel-center z-depth-3 grey lighten-5">
	@endif
		<div class="panel-title">
	    Account Panel
	  </div>
		<ul class="collapsible popout" data-collapsible="accordion">
	    <li>
	      <a class="collapsible-header panel-list center" href="{{ URL::to('view/account') }}">
	        <div>Account</center></div>
				</a>
	    </li>
	    <li>
				<a class="collapsible-header panel-list center" href="{{ URL::to('view/cars') }}">
	        <div>Cars</div>
				</a>
	    </li>
	    <li>
				<a class="collapsible-header panel-list center" href="#">
	        <div>Log</div>
				</a>
	    </li>
	  </ul>
	</div>
</div>
