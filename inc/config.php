<?php
  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'elternfreund');
  define('UPLOAD_PATH', '/ef_dummy/img/profile/');
  define('ROOT_PATH', $_SERVER[DOCUMENT_ROOT]);
//ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(0);

//$db_conx = mysqli_connect('localhost','root','');
try {
$user = "root";
$pass = "";
$db = new PDO('mysql:host=localhost;dbname=elternfreund',$user, $pass); 

} catch (Exception $e) {
  echo $e->getMessage();
  die();
  
}


  $required = array(
// error messages for required form fields that are left blank by the user
  						'first_name' => 'Geben Sie bitte Ihren Vornamen an!',
							'last_name'  => 'Geben Sie bitte Ihren Nachnamen an!',
							'profession'  => 'Geben Sie bitte Ihren Beruf an!',
							'dob'  => 'Geben Sie bitte Ihr Geburtsdatum an!',		
              'street'  => 'Geben Sie bitte Ihre Straße an!',		
							'number'  => 'Geben Sie bitte Ihre Hausnummer an!',
							'zip'  => 'Geben Sie bitte Ihre Postleitzahl an!',
							'location'  => 'Geben Sie bitte Ihren Ort an!',
              'child_name' => 'Geben Sie bitte den Namen Ihres Kindes an!',
              'child_dob' => 'Geben Sie bitte das Geburtsdatum an!',
              'password' => 'Wählen Sie bitte ein Passwort!',
              'password_flawed' => 'Das Passwort muss mindestens 8 Zeichen haben und sowohl Zahlen als auch Buchstaben enthalten!',
              'user_exists' => 'Sie sind bereits angemeldet!',
              'request' => 'Bitte wählen Sie jeweils mindestens einen Betreuungszeitraum aus beiden Kategorien aus!',
              'offer' => 'Bitte wählen Sie jeweils mindestens einen Betreuungszeitraum aus beiden Kategorien aus!',
              'email_exists' => 'Diese E-Mail ist bereits registriert!',
              'passwords_different' => 'Die Passwörter stimmen nicht überein!',
              'picture' => 'Bitte laden Sie ein Eltern-Kind-Foto hoch!',
              'email' => 'Bitte geben Sie Ihre E-Mail-Adresse an!'
              
							);

$required_keys = array_keys($required);

$required_2 = array(
  // error messages for required form fields in case of the user being not a single parent             
							'partner_firstname' => 'Geben Sie bitte den Vornamen Ihres Partners an!',
							'partner_profession'  => 'Geben Sie bitte den Beruf Ihres Partners an!',
							);

$required_keys_2 = array_keys($required_2);

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
