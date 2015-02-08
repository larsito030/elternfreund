<?php
  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'elternfreund');


// error messages for required form fields that are left blank by the user

$required = array(
							'firstname' => 'Geben Sie bitte Ihren Vornamen an!',
							'lastname'  => 'Geben Sie bitte Ihren Nachnamen an!',
							'aboutme'   => 'Schreiben Sie bitte ein paar Zeilen über sich!',
							'profession'  => 'Geben Sie bitte Ihren Beruf an!',
							'birthdate'  => 'Geben Sie bitte Ihr Geburtsdatum an!',		
              'street'  => 'Geben Sie bitte Ihre Straße an!',		
							'number'  => 'Geben Sie bitte Ihre Hausnummer!',
							'zip'  => 'Geben Sie bitte Ihre Postleitzahl an!',
							'location'  => 'Geben Sie bitte Ihren Ort an!',
							);

$required2 = array(
							'partner_firstname' => 'Geben Sie bitte den Vornamen Ihres Partners an!',
							'partner_profession'  => 'Geben Sie bitte den Beruf Ihres Partners an!',
							);

      /*$query = "SELECT * FROM users WHERE first_name = '$first_name' && last_name = '$last_name' && dob = '$birthdate'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
      		$query = "INSERT INTO users (first_name, last_name, Status, about_me, profession, dob) VALUES ('$first_name', '$last_name', '$status'".
      				 "'$aboutme', '$profession', '$birthdate'";
        	mysqli_query($dbc, $query);
        	$query2 = "INSERT INTO users_partner (gender, firstname, profession) VALUES" . 
        			  "('$partner_gender', '$partner_firstname', '$partner_profession')";
        	mysqli_query($dbc, $query2);
        	$query3 = "INSERT INTO user_address (street, street_number, zip, location) VALUES" . 
        			  "('$street', '$street_number', '$zip', '$location')";
        	mysqli_query($dbc, $query3);

        }*/
