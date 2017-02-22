<script type="text/javascript">
  $(document).ready(function(){
		$('#name_message_div').hide();
		$('#email_message_div').hide();
		$('#pass_message_div').hide();

		$('#name').on('click', function(){
			$('#name').removeClass("invalid");
		});

		$('#email').on('click', function(){
			$('#email').removeClass("invalid");
		});

		$('#password').on('click', function(){
			$('#password').removeClass("invalid");
		});

    $("#register_form").submit(function(){
			$('#name_message_div').hide();
			$('#email_message_div').hide();
			$('#pass_message_div').hide();
			$('#name_message_div').empty();
			$('#email_message_div').empty();
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
						if(msg.type === 'empty email'){
							var $msgContent = '<span>Empty e-mail, this field is required.</span>';
							$('#email_message_div').append($msgContent);
							$("#email_message_div").show();
							$('#email').addClass("invalid");
						} else if(msg.type === 'empty name'){
							var $msgContent = '<span>Empty name, this field is required.</span>';
							$('#name_message_div').append($msgContent);
							$("#name_message_div").show();
							$('#name').addClass("invalid");
						} else if(msg.type === 'password too short'){
							var $msgContent = '<span>Password too short, 6 characters is the minimum.</span>';
							$('#pass_message_div').append($msgContent);
							$("#pass_message_div").show();
							$('#password').addClass("invalid");
						} else if(msg.type === 'user wasn\'t registered'){
							var $msgContent = '<span>Error registering new user, please try again later.</span>';
							$('#email_message_div').append($msgContent);
							$("#email_message_div").show();
							$('#email').addClass("invalid");
						} else if(msg.type === 'email exist'){
							var $msgContent = '<span>This email is already registered.</span>';
							$('#email_message_div').append($msgContent);
							$('#email_message_div').show();
							$('#email').addClass("invalid");
						}
          }
        },
        error: function( ){
          window.location.reload();
        }
      });
      return false;
		});
  });
</script>
