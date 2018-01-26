<?php 

	// Type here your email
	define( 'EMAIL_TO', 'your_mail@mail.com' );
	
	// Type default mail subject here
	define( 'EMAIL_SUBJECT', 'Feedback from website' );
	
	/////////////////////////////////////////////////////////////
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		
		$email_from = isset( $_POST['email'] ) ? $_POST['email'] : '';
		
		$name_from = isset( $_POST['name'] ) ? trim( $_POST['name'] ) : 'Anonymous';
		
		$email_subject = isset( $_POST['subject'] ) && trim( $_POST['subject'] ) <> '' ? htmlspecialchars( trim( $_POST['subject'] ) ) : EMAIL_SUBJECT;
		
		$message = isset( $_POST['text'] ) ? htmlspecialchars( trim( $_POST['text'] ) ) : 'No text...';
		
		$headers = 'From: ' . $name_from . ' <' . $email_from . '>' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		
		@mail( EMAIL_TO, $email_subject, $message, $headers );

		// Write location your contact page //
		header("Location: http://des111gn.com/all-in-1/contact.html");

	}