<script type="text/javascript">
	/*Ajax funtions for account page*/
	$(document).ready(function(){
		/*Assing varibles for LocalStorage*/
    var id_session = localStorage.getItem("id_session");
    var token_session = localStorage.getItem("token_session");
		var user_id_sess = localStorage.getItem("user_id_sess");


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
          window.location = "{{URL::to('/')}}";
        }
      });
    	return false;
    });

		//Method for cancel user edid
		$("#to_cancel_edit").on('click', function() {
      window.location = "{{URL::to('/')}}";
    });

		/*FUNCTIONS FOR ADD NEW CARS TO USER ACCOUNTS*/
		//Method for get id type_car of modal
    $("body").on("click", ".modal-trigger", function(){
        id_type_car = $(this).data("tcarid");
    });

		//Method for add new car
    $("body").on("click", "#add_new_car", function(){
      //declare the url to post. same as in form action.
      var url = "{{URL::to('cars/add')}}";
      var session_info = { session_id: id_session,
													 session_token: token_session,
													 car_type: id_type_car
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
          if(msg.status == 'success'){
            //$('#modal_delete').closeModal();
            var $toastContent = $('<span>New Car Add Succesfully</span>');
            Materialize.toast($toastContent, 1000, 'rounded blue lighten-1 black-text', function(){location.reload()});
						console.log(msg);
					}else{
            //$('#modal_delete').closeModal();
            var $toastContent = $('<span>'+ msg.type +'</span>');
            Materialize.toast($toastContent, 1000, 'rounded red darken-3');
						console.log(msg);

          }
        }
      });
			return false;
    });

		/*FUNCTIONS FOR DELETE CARS TO USER ACCOUNTS*/
		//Method for get id user_car of modal
    $("body").on("click", ".modal-trigger", function(){
        id_user_car = $(this).data("ucarid");
    });

		//Method for delete new car
		$("body").on("click", "#delete_car", function(){
      //declare the url to post. same as in form action.
      var url = "{{URL::to('cars/delete')}}";
      var session_info = { session_id: id_session,
													 session_token: token_session,
													 user_car_id: id_user_car
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
          if(msg.status == 'success'){
            //$('#modal_delete').closeModal();
            var $toastContent = $('<span>Car Delete Succesfully</span>');
            Materialize.toast($toastContent, 1000, 'rounded blue lighten-1 black-text', function(){location.reload()});
						console.log(msg);
					}else{
            //$('#modal_delete').closeModal();
            var $toastContent = $('<span>'+ msg.type +'</span>');
            Materialize.toast($toastContent, 1000, 'rounded red darken-3');
						console.log(msg);

          }
        }
      });
			return false;
    });

		//Method for show and hide car_type
		$("#car_class").hide();

		$("#model_car").change(function() {
		  $("#car_class").show();
		});

		/*Web elements declarations*/
		$('select').material_select();//For initialize all Select's

		$('.modal').modal();//For initialize alls Modals
	});
</script>
