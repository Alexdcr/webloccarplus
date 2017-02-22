<!DOCTYPE html>
<html lang="en">
		<head>
			@include("partials.headers")
			@include("partials.styles_css.form_styles")
		</head>
		<body>
			@yield("content")

			@include("partials.scripts.general_scripts")
			@include("partials.ajax.register_ajax")
		</body>
</html>
