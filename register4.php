<?php ob_start();
	if(!isset($_SESSION)) {
		session_start();
		}
		
	  	include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  	require_once('appvars.php');
  	  	include('../ef_dummy/inc/db_conx.php'); 
		include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  //	require_once('../ef_dummy/inc/config.php');
  	    require_once('../ef_dummy/inc/functions.php');

//$missing = validationCheck($required);
//arrays of colums which are part of the respective tables...


try {if(/*empty($missing) && */isset($_POST['step4'])){
		foreach($_POST as $key => $value){
				if(!empty($value)){
						$_SESSION['post'][$key] = $_POST[$key];
										}
			}
		$fields = implode(', ', $users_cols);
		$values = "'".implode("', '", $users_values)."'";
		$query_users = $db->prepare("INSERT INTO users (?) VALUES (?)");
		$query_users->execute(array($fields, $value));
}
	
} catch (Exception $e) {
	echo $e->getMessage();
}


	
	$out = $_SESSION['post'];
	//print_r($out);
	//$keys = array_keys($out);
	//$query = implode(', ', $out);
	//print_r($query);
	ini_set('display_errors', 'on');

//This functions retrieves all the  keys or values from the SESSION array
//which are supposed to be inserted into a specific table the name of which gets passed
//into the function as an argument. Arguments must be passed in as a variable!!!
// 1st parameter: targeted database table
// 2nd parameter: either 'key' or 'value'
function get_sql_data($table,$param) {
//array of columns pertaining to each of the database tables
	$users = array('first_name', 'last_name', 'Status' , 'about_me', 'dob','password', 'email', 'gender');		
	$children = array('child_name', 'child_dob', 'child_gender');	
	$search_profile = array('flexibility', 'frequency');
	$users_partner = array('partner_gender','partner_first_name', 'partner_profession');

		foreach($_SESSION['post'] as $key => $value) {
		 		if(in_array($key, $table) {	
						$fields[] = $key;
						$values[] = $value;}
				elseif($table =='$times_offered') {
						if(substr($key,0,5) == 'offer'){
								$fields[] = $key;
								$values[] = $value;
				}elseif($table == '$times_requested'){
						if(substr($key,0,7) == 'request'){
								$fields[] = $key;
								$values[] = $value;
							}	
				}else{	unset($out[$key]);		}
			}
	$db_fields = implode(', ', $fields);
	$db_values = "'".implode("', '", $values)."'";

	if($param == 'key'){
		return $db_fields;
	} elseif($param =='value') {
		return $db_values;
	} else {echo "Please enter 2nd parameter!"}

}
				
function register_user($db){
		$tables = array('$users', '$children', '$search_profile', '$times_requested', '$times_offered', '$users_partner', '$user_address');
		foreach($tables as $table){
				$fields = get_sql_data($table, 'key');
				$values = get_sql_data($table, 'value');
				$query_users = $db->prepare("INSERT INTO users (?) VALUES (?)");
				$query_users->execute(array($fields, $values));
		}
		

}	


//inserting the keys and values of the arays into a query string!


		
			




/*
try {			$results = $db->query("SELECT profession FROM users WHERE last_name = 'Mertens'");
				$result = $results->fetchAll(PDO::FETCH_ASSOC);
				print_r($result);
	
} catch (Exception $e) {
	$e->getMessage();
}*/


			






//print_r($values);



?>
<div class="reg4 pad1">
	<h5>Gleich hast Du's geschafft. Wir brauchen zum Abschluss der Registrierung nur noch Passwort, E-Mail-Adresse und eine Personlausweiskopie von Dir!
	</h5>
	<img src="../ef_dummy/img/perso.jpg">
	<p>
		Sicherheit steht bei Elternfreund an erster Stelle. Lade deshalb bitte noch ein Foto von Deinem Personalausweis hoch.
	</p>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<fieldset class="reg4">
			
			<ul>
				<li>Bitte wähle ein Passwort</li>
				<li>
					<input type="password" name="password">	
				</li>
				<li>Wiederhole bitte Dein Passwort</li>
				<li>
					<input type="password" name="password_again">
				</li>
				<li>Bitte gebe noch Deine E-Mail-Adresse an</li>
				<li><input type="email" name="email"></li>
			</ul>
	</fieldset>	
	<input type="submit" name="step4" value="weiter"/>	
</form>
	<a href="../ef_dummy/register4.php"><span id="finishReg"class="uk-button uk-button-success">Registrierung abschließen</span></a>
	<a href="../ef_dummy/register3.php"><span id="lastReturn" class=uk-icon-angle-double-left></span></a>
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
    <script>$('.regSteps>li>span').removeClass('active');
	$('.regSteps>li:nth-of-type(4)>span').addClass('active');
	</script>
	</body>
</html>
