$(document).ready(function(){


	var required = $('.required');
	var form = $('.form');
	var error = 0;
	var message = $('#message');
	var save = $('.save');

	save.on('click', function(e){

		error = 0; 

		e.preventDefault();

		required.each(function(){

			$(this).parent().removeClass('has-error').removeClass('has-success');
		  
		  	if($(this).val().trim() == ''){
		  		
		  		error = 1;
		  		$(this).parent('div').addClass('has-error');
		  	
		  	} else {
		  		//if(validate_data_type($(this).data('validate'), $(this).val()) === true){
		  			
		  			$(this).parent('div').addClass('has-success');
		  		
		  		/*} else {
		  			error = 1;
		  			$(this).parent('div').addClass('has-error');
		  		
		  		}*/

		  	}

		});

		if(error == 1){
			message.fadeIn()
				.addClass('alert alert-danger')
				.html('<i class="fa fa-exclamation-triangle"></i> Corrige los errores que hay en el formulario');
			setTimeout(function(){
				message.fadeOut()
					.removeClass('alert alert-danger')
					.html('');
			}, 5000);
		} else {
			save.attr('disabled', true).text('guardando...');
			form.submit();
		}

	});


	/*function validate_data_type(data_type, value)
	{
		if(data_type == 'string'){

			return validate_string(value);

		} else if(data_type == 'email'){

			return validate_email(value);

		} else if(data_type == 'number'){

			return validate_number(value);

		} else {

		}
	}


	function validate_string(string)
	{
		return /^[a-zA-Z()]+$/.test(string);
	}

	function validate_email(email)
	{
    	return /\S+@\S+\.\S+/.test(email);
	}

	function validate_number(number)
	{
		return isNaN(number);	
	}*/


});