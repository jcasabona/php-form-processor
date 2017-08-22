<?php
//Step 0: Some helpful constants
define( 'SENDTO', 'joe@casabona.org' );
define( 'SUBJECT', 'Contact Form Submission' );


// Step 1: Include the FormProcessor Class
require_once( 'FormProcessor.php' );

//Step 2: Check to see if a form is filled out (see form below to check input names)
if ( isset( $_POST['submit'] ) ) {
	$fp= new FormProcessor( SENDTO );
	$_POST['subject']= ( isset( $_POST['subject'] ) ) ? $_POST['subject'] : SUBJECT;
	$message= $fp->email( $_POST['subject'], $fp->buildMsg($_POST), $_POST['email'] );
}

//Step 3: Print the Message.
printf( '<h4>%s</h4>', $message );
?>

<form name="sample-form" method="post">
    <div class="input-block">
        <label for="name">Name:</label>
        <input type="text" name="name" />
    </div>
    <div class="input-block">
        <label for="email">Email:</label>
        <input type="email" name="email" />
    </div>
    <div class="input-block">
        <label for="message">Message:</label>
        <textarea name="message"></textarea>
    </div>
    <div class="input-block">
        <label for="submit">Let 'er rip:</label>
        <input type="submit" name="submit" value="Send the Form" />
    </div>
</form>