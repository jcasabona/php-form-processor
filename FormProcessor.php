<?php
/**
* @package FormProcessor
* @author Joe Casabona 
* @description Class that processes HTML forms and emails them to a specified address.
**/


class FormProcessor{

	var $email;
	var $mess;
	

	/**
	* constructor
	* @param string $email the email address to send the form 
	* results to.
	**/
	function FormProcessor($email){
		$this->email= $email;
	}
	
	/**
	* function clean removes HTML entitiles, slashs, and extraineous spaces from
	* the string passed to it
	* @param $item a string to be cleaned
	* @return a cleaned version of item
	**/
	function clean($item){
		return trim(htmlentities(strip_tags($item)));
	}


	/**
	* function handle_checkboxes creates a comma separated string
	* from an array of checkboxes.
	* @param $info an array containing checked off boxes from a form
	* @return a comma separated string of the checkbox results
	**/
	function handle_checkboxes($info){
		return implode(", ", $info);
	}
	
	/**
	* function email uses PHP mail() to send an email to the address specified 
	* from the constructor and prints message to user.
	* @param $subject is the subject of the email
	* @param $message is the body of the email
	* @param $msg is the message to display to the user. Defaults to 
	* "Thanks! Your message has been sent."
	* @param $from is the from address for the email. Defaults to null
	**/
	function email($subject, $message, $msg='', $from=NULL){
		if(mail($this->email, $subject, $message, "From: $from")){
		
			if($msg != ''){ 
				$this->mess= $msg;
			}else{
				$this->mess= "Thanks! Your message has been sent.";
			}
		
		}else{
			$this->mess= "Uh Oh! There was a problem processing your message.";
		}
	
	
		print $this->mess;
	}



	/**
	* function build_message builds a string that will serve as the email body.
	* @param $info is array from HTML form.
	* @return $message a string produced from processing the array
	**/
	function build_message($info){
		$message= "";
		
		foreach($info as $key => $value){
			if(is_array($value)){ $value= $this->handle_checkboxes($value); }
				$message.= "{$key}: ". $this->clean($value) ." \n"; 
			}
	
		return $message;
	}


}

?>