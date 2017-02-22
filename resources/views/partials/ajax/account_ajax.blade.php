<script type="text/javascript">
	/*Ajax funtions for account page*/
	$(document).ready(function(){
		/*Assing varibles for LocalStorage*/
    var id_session = localStorage.getItem("id_session");
    var token_session = localStorage.getItem("token_session");
		var user_id_sess = localStorage.getItem("user_id_sess");
    var user = JSON.parse(localStorage.getItem("user"));
    var types = JSON.parse(localStorage.getItem("types"));

		/*Assing data to form inputs*/
		$("#session_id_edit").attr("value", id_session);
		$("#token_session_edit").attr("value", token_session);
		$("#name_edit").attr("value", user.name);
		$("#email_edit").attr("value", user.email);
		$("#phone_edit").attr("value", user.phone);

		//Method for edit your user
    $("#edit_form").submit(function(){
      // Start $.ajax() method
      $.ajax({
        // The URL for the request. variable set above
        url: $(this).attr('action'),
        // The data to send (will be converted to a query string). variable set above
        data: $(this).serialize(),
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
          if(msg.status == 'error'){
            var $toastContent = $('<span>'+ msg.type +'</span>');
            Materialize.toast($toastContent, 2000, 'rounded red darken-3');
          }else if(msg.status == 'success'){
            var $toastContent = $('<span>Changes Saved Succesfully</span>');
            Materialize.toast($toastContent, 1000, 'rounded light-green accent-3 black-text', function(){location.reload()});
          }
        }
      });
      return false;
    });

		
	});
</script>
