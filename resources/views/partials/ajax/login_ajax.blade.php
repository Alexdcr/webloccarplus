<script type="text/javascript">
  $(document).ready(function(){

		$('#email_message_div').hide();
		$('#pass_message_div').hide();

		$('#account').on('click', function(){
			$('#account').removeClass("invalid");
		});

		$('#password').on('click', function(){
			$('#password').removeClass("invalid");
		});

    $("#login_form").submit(function(){
			$("#email_message_div").hide();
			$('#pass_message_div').hide();
			$("#email_message_div").empty();
			$('#pass_message_div').empty();
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
						if(msg.type === 'empty account'){
							var $msgContent = '<span>Empty account, this field is required.</span>';
							$('#email_message_div').append($msgContent);
							$("#email_message_div").show();
							$('#account').addClass("invalid");
						} else if(msg.type === 'password too short'){
							var $msgContent = '<span>Password too short, 6 characters is the minimum.</span>';
							$('#pass_message_div').append($msgContent);
							$("#pass_message_div").show();
							$('#password').addClass("invalid");
						} else if(msg.type === 'user doesn\'t exist'){
							var $msgContent = '<span>User doesn\'t exist.</span>';
							$('#email_message_div').append($msgContent);
							$("#email_message_div").show();
							$('#account').addClass("invalid");
						} else if(msg.type === 'wrong password'){
							var $msgContent = '<span>Wrong password.</span>';
							$('#pass_message_div').append($msgContent);
							$("#pass_message_div").show();
							$('#password').addClass("invalid");
						}

						var $toastContent = $('<span>'+ msg.type +'</span>');
						Materialize.toast($toastContent, 2000, 'rounded red darken-3');
						/*$("#email_message_div").show();
						$('#pass_message_div').show();
						$('#account').addClass("invalid");
						$('#password').addClass("invalid");*/
          }
        },
        error: function( err ){
          window.location.reload();
        }
      });
      return false;
		});
  });
</script>
