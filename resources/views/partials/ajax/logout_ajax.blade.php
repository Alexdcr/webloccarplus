<script>
	/*Save data for Controller retunrs*/
  var id_session = {{$user_session->id}};
  var token_session = "{{$user_session->session_token}}";
  var user_id_sess = {{$user_session->user_id}};
  var user = {!! $user !!};
  var types = {!! $car_types !!};

	/*Save data in LocalStorage*/
  localStorage.setItem("id_session", id_session);
  localStorage.setItem("token_session", token_session);
  localStorage.setItem("user", JSON.stringify(user));
  localStorage.setItem("user_id_sess", user_id_sess);
  localStorage.setItem("types", JSON.stringify(types));

	/*Ajax funtions for welcome page*/
  $(document).ready(function(){
		/*Close session - function logout*/
    $('#to_logout').on('click', function(){
      //declare the url to post. same as in form action.
      var url  = "{{URL::to('/user/logout')}}";
      var session_info = {session_id: id_session,
                          session_token: token_session
                          };
      // Start $.ajax() method
      $.ajax({
        // The URL for the request. variable set above
        url: url,
        // The data to send (will be converted to a query string). variable set above
        data: session_info,
				headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  },
        // Whether this is a POST or GET request
        type: "POST",
        // The type of data we expect back. can be json, html, text, etc...
        dataType : "json",
        // Code to run if the request succeeds;
        // the response is passed to the function
        success: function( msg ) {
          localStorage.clear();
          window.location.reload("{{URL::to('/')}}");
        }
      });
    return false;
    });

		/*Initialitation for web elements*/
		$('#header_cars').empty();
		$('#header_cars').append('Your Cars');

    $('.parallax').parallax();

		$('.collapsible').collapsible();

    $(".dropdown-button").dropdown({
      belowOrigin: true // Displays dropdown below the button
    });

    $('.button-collapse').sideNav({
        menuWidth: 300, // Default is 240
        edge: 'left', // Choose the horizontal origin
        closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
      });

		$('#menu_nav').on('click', function(){
			$('#sidenav-overlay').hide();// For clean screen and unlock for the overlay screen
		});

		var count_cars = 3;
		var array_car = [];
		for(var i=0; i<count_cars; i++){
			array_car.push(i);
		}

		jQuery.each(array_car, function( index, value ) {
			$('#your_cars_'+value).on('click', function(){
				$('#header_cars').empty();
				$('#header_cars').append('Select: Car ' + value);
				$('#radio_list').css('display', 'none');
				$('#car_list').removeClass('active');
			});
		});

		/*$('#your_cars_1').on('click', function(){
			$('#header_cars').empty();
			$('#header_cars').append('Select: Car 1');
			$('#radio_list').css('display', 'none');
			$('#car_list').removeClass('active');
		});

		$('#your_cars_2').on('click', function(){
			$('#header_cars').empty();
			$('#header_cars').append('Select: Car 2');
			$('#radio_list').css('display', 'none');
			$('#car_list').removeClass('active');
		});

		$('#your_cars_3').on('click', function(){
			$('#header_cars').empty();
			$('#header_cars').append('Select: Car 3');
			$('#radio_list').css('display', 'none');
			$('#car_list').removeClass('active');
		});*/

  });
</script>
