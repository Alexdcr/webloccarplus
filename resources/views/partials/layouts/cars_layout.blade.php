<!DOCTYPE html>
<html lang="en">
    <head>
      @include("partials.headers")
      @include("partials.styles_css.general_styles")
    </head>
    <body>
      @include("partials.menu")
			<div class="row">
				@include("partials.account_panel")
	      @yield("content")
			</div>

      @include("partials.scripts.general_scripts")
			@include("partials.ajax.cars_ajax")
    </body>
</html>
