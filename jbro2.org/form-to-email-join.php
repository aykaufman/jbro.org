<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the email!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Email is mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email :(!";
    exit;
}

$email_from = '';//<== update the email address
$email_subject = "I would like to join\n";
$email_body = "Hi my name is: $name\n my email address is: \n $visitor_email\n I would like to join jbro \n".
    "\n $message\n";

    $to = "avrohomkaufman@gmail.com";//<== update the email address
$headers = "From: $visitor_email \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to, $email_subject, $email_body, $headers);


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