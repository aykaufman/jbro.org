<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$visitor_email = $_POST['email'];

//Validate first
if(empty($visitor_email)) 
{
    echo "Please enter your email";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email!";
    exit;
}

$email_from = '';//<== update the email address
$email_subject = "new event subscriber";
$email_body = "this email address would like to sign up for event updates. Email adress: $visitor_email.\n.";
   
    
$to = "avrohomkaufman@gmail.com";//<== update the email address
$headers = "From: $visitor_email \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you-subscribe.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 