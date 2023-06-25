<?php
if($_POST) {
  $name = "";
  $email = "";
  $message = "";
  
  if(isset($_POST['name'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  }
  
  if(isset($_POST['email'])) {
    $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  }
  
  if(isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES);
  }
  
  $recipient = "your-email@example.com";
  $subject = "New Contact Message from ".$name;
  
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";
  
  $email_headers = "From: $name <$email>";
  
  if(mail($recipient, $subject, $email_content, $email_headers)) {
    echo "Thank You! Your message has been sent.";
  } else {
    echo "Oops! Something went wrong and we couldn't send your message.";
  }
}
?>
