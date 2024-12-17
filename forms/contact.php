<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'dendysaptoadi160@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  
// if(isset($_POST['submit'])){
//   $name = $_POST['name']." ".$_POST['lname'];
//   $email = $_POST['email'];
//   $mobile_no = $_POST['mobile_no'];
//   $subject = "Form submission Received";
//   $subject2 = "Thank you for contacting us";
//   $message = "Name: ".$name . " <br>Email:" . $email . " <br>Phone:" . $mobile_no. "<br> Message is here:<br>" . $_POST['message'];
//   $message2 = "Thank you for contacting us, one of our representatives will contact you soon!";
//   mail($email,$subject2,$message2);
//   $headers  = "From: " . "yopmail@gmail.com" . "\r\n";
//   $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
//   $headers .= "MIME-Version: 1.0\r\n";
//   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//   mail('shreeramsharma1990@gmail.com',$subject,$message,$headers);
//   }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
