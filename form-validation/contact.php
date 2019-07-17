<?php

// variables  //SET VARIABLES FOR THIS PAGE
$to = 'ben@falkencreative.com';
$subject = "Message from your website domain.com";

$error_open = "<label class='error'>";
$error_close = "</label>";
$valid_form = TRUE;
$redirect = "success.php";

$form_elements = array('name', 'phone', 'fax', 'email', 'comments');
$required = array('name', 'phone', 'email');

foreach ($required as $require) {
	$error[$require] = '';
}


//START BLOCK********************************************************************************************

if (isset($_POST['submit'])){
	// process form
	
	// get form data********************GATHER FORM DATA INTO AN ARRAY
	foreach ($form_elements as $element) {
		$form[$element] = htmlspecialchars($_POST[$element]);
	}
			
	// check form elements  CHECK EACH FORM FOR ERRORS -PLUGIN? 
		// check required fields
		if ($form['name'] == '') {
			$error['name'] = $error_open . "Please fill in all required fields!" . $error_close;
			$valid_form = FALSE;
		}
		if ($form['phone'] == '')
		{
			$error['phone'] = $error_open . "Please fill in all required fields!" . $error_close;
			$valid_form = FALSE;
		}
		if ($form['email'] == '')
		{
			$error['email'] = $error_open . "Please fill in all required fields!" . $error_close;
			$valid_form = FALSE;
		}
		
		// check formatting
		if ($error['phone'] == '' && !preg_match('/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/', $form['phone'])) {
			$error['phone'] = $error_open . "Please enter a valid phone number!" . $error_close;
			$valid_form = FALSE;
		}
		
		if ($error['email'] == '' && !preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/', $form['email'])) {
			$error['email'] = $error_open . "Please enter a valid email!" . $error_close;
			$valid_form = FALSE;
		}
	
	// check for bad data
	if (contains_bad_str($form['name']) ||
		contains_bad_str($form['email']) ||
		contains_bad_str($form['phone']) ||
		contains_bad_str($form['fax']) ||
		contains_bad_str($form['comments'])) {
		$valid_form = FALSE;
	}	
	if (contains_newlines($form['name']) ||
		contains_newlines($form['email']) ||
		contains_newlines($form['phone']) ||
		contains_newlines($form['fax'])) {
		$valid_form = FALSE;
	}	
	
	// check if form is valid ******** IF ALL CHECKS OUT OK, $valid_form WILL BE TRUE AND THIS BLOCK RUNS
	if ($valid_form) {
		// create message for email
		$message = "Name: " . $form['name'] . "\n";
		$message .= "Email: " . $form['email'] . "\n";
		$message .= "Phone: " . $form['phone'] . "\n";
		$message .= "Fax: " . $form['fax'] . "\n\n";
		$message .= "Message: " . $form['comments'];
		
		$headers = "From: www.falkendev.com <admin@falkendev.com>\r\n";
		$headers .= "X-Sender: <admin@falkendev.com>\r\n";
		$headers .= "X-Mailer: PHP/". phpversion() ."\r\n";
		$headers .= "Reply-To: " . $form['email'];
		
		// send email //DO MORE RESEARCH HERE IF NEEDED - MAIL FUNCTION
		mail($to, $subject, $message, $headers);
		
		// redirect
		header("Location: " . $redirect); //REDIRECTS YOU TO SUCCESS PAGE!
	}
	else {
		include('form.php'); //RE-DIRECT TO SAME PAGE BUT NOW YOU HAVE ERRORS FROM ABOVE 
	}
	
}
else {  //THIS BLOCK IS IF THERE IS NO DATA SUBMITTED IN THE FORM - it just re-renders the form.php page
	foreach ($form_elements as $element) {  
		//THIS FOR EACH IS TO RESET THE FORM FIELDS TO BLANK
		$form[$element] = '';
	}

	// display form
	include('form.php');
}

//END BLOCK********************************************************************************************


//THESE ARE JUST FUNCTIONS SETUP TO TEST THE STRINGS INPUTTED INTO THE FORM - CHECKING FOR VALID STRING ENTRY
function contains_bad_str($str_to_test) {
	$bad_strings = array(
		"content-type:",
		"mime-version:",
        "multipart/mixed",
		"Content-Transfer-Encoding:",
        "bcc:",
		"cc:",
		"to:");
  
	foreach($bad_strings as $bad_string) {
		if(stristr(strtolower($str_to_test), $bad_string)) {
      		return true;
    	}
  	}
  	return false;
}

function contains_newlines($str_to_test) {
   if(preg_match("/(%0A|%0D|\\n+|\\r+)/i", $str_to_test) != 0) {
     return true;
   }
   return false;
}

?>