<?php 
$errors = '';
$myemail = 'tobias@signtrix.ca';//<-----Put Your email address here.
if(empty($_POST['firstname'])  || 
   empty($_POST['email_address']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: All fields are required";
}

$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname'];
$companyname = $_POST['companyname'];
$phone = $_POST['phone'];
$email_address = $_POST['email_address']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "New Potential Prospect: $firstname $lastname";
	$email_body = "You have received a new message. \n ".
	" Here are the details:\n Name: $firstname $lastname \n Company: $companyname \n Phone: $phone \n Email: $email_address \n Message \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: index.html#contact');
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Signtrix Contact Form Handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>