






function formHasErrors()
{
	let errorFlag = false;

	let dateTextField = document.getElementById("date");

	if(!formFieldHasInput(dateTextField))
	{
		document.getElementById("date_error").style.display = "inline-block";

		if(!errorFlag)
		{
			document.getElementById("date").focus();
			document.getElementById("date").select();
		}

		errorFlag = true;
	}

	let nameTextField = document.getElementById("name");

	if(!formFieldHasInput(nameTextField))
	{
		document.getElementById("name_error").style.display = "inline-block";
		if(!errorFlag)
		{
			document.getElementById("name").focus();
			document.getElementById("name").select();
		}
		errorFlag = true;
		
	}

	let phoneTextField = document.getElementById("phone");
	if(!formFieldHasInput(phoneTextField))
	{
		document.getElementById("phone_error").style.display = "inline-block";
		if(!errorFlag)
		{
			document.getElementById("phone").focus();
			document.getElementById("phone").select();
		}
		errorFlag = true;
	}
	if(phoneTextField.length == 10 && !isNaN(phoneTextField.value))
	{
		document.getElementById("phoneNumber_error").style.display = "inline-block";
		if(!errorFlag)
		{
			document.getElementById("phone").focus();
			document.getElementById("phone").select();
		}
		errorFlag = true;
	}

	let emailValue = document.getElementById("email").value;
	let regexEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);	

	if(!regexEmail.test(emailValue))
	{
		document.getElementById("email_error").style.display = "inline-block";

		if(!errorFlag)
		{
			document.getElementById("email").focus();
			document.getElementById("email").select();
		}

		errorFlag = true;
	}
	return errorFlag;
}

function validate(e)
{
	hideErrors();

	if(formHasErrors())
	{
		e.preventDefault();

		return false;
	}

	return true;
}

function trim(str) 
{
	// Uses a regex to remove spaces from a string.
	return str.replace(/^\s+|\s+$/g,"");
}

function formFieldHasInput(fieldElement)
{
	if ( fieldElement.value == null || trim(fieldElement.value) == "" )
	{
		return false;
	}
	return true;
}

function hideErrors()
{
	let errorFields = document.getElementsByClassName("error");

	for (let i = 0; i < errorFields.length; i++) {
		errorFields[i].style.display = "none";
	}

}

function resetForm(e)
{
	if ( confirm('Clear order?') )
	{
		hideErrors();
		document.getElementById("name").focus();
		return true;
	}
	e.preventDefault();
	return false;	
}

function load()
{

	
	hideErrors()
	document.getElementById("reservationform").addEventListener("submit", validate, false);
	
	document.getElementById("reservationform").reset();

	document.getElementById("reservationform").addEventListener("reset", resetForm, false);


}

document.addEventListener("DOMContentLoaded", load,false);