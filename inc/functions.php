<?php


	function get_sql_data($table,$param,$db) {
//array of columns pertaining to each of the database tables
			if($table == 'users') {
				$cols = array('first_name', 'last_name', 'Status' , 'about_me', 'dob','password', 'email', 'gender');}		
			elseif($table =='children') {
				$cols = array('child_name', 'child_dob', 'child_gender');}
			elseif($table == 'search_profile') {
				$cols = array('flexibility', 'frequency');}
			elseif($table == 'users_partner') {
				$cols = array('partner_gender','partner_first_name', 'partner_profession');}
			elseif($table =='user_address') {
			 	$cols = array('street', 'number', 'zip', 'location');}

			foreach($_SESSION['post'] as $key => $value) {
		 			if(in_array($key, $cols)) {	
							$fields[] = $key;
							$values[] = $value;
					}elseif($table =='times_offered') {
							if(substr($key,0,5) == 'offer'){
									$fields[] = $key;
									$values[] = $value;}
					}elseif($table == 'times_requested'){
							if(substr($key,0,7) == 'request'){
									$fields[] = $key;
									$values[] = $value;
							}	
					}//else{	unset($out[$key]);		}
		 	}		
					if($table == 'users') {	
		 					$db_fields = "(".implode(', ', $fields).")";	
							$db_values ="('".implode("', '", $values)."')";
					} else {	 
							$user_id = get_user_id($db);
							$db_fields ="(".implode(', ', $fields).", user_id)";	
							$db_values ="('".implode("', '", $values)."', ".$user_id.")";
					} 	if($param == 'key'){
							return $db_fields;}
		 			elseif($param =='value') {
							return $db_values;}
		 			else {echo "Please enter 2nd parameter!";}
	}
//debugging
//test1: foreach loop commented out; $table = 'user';  => not working!
//test 2: table name in sql statement hard coded; => not working!
//test 3: all parameters in sql statement hard coded; => working!
//test 4: all parameters in sql statement hard coded except for table name; => working!
//test 5: table name and field name passed into sql statement as variable, values hard coded; => working!
//test 6: bug fixed: accidentally 2 single quotes passed before concatenated closing bracket in §db_fields!!!
//test 7: uncommenting foreach loop in register_user();

//debugging part 2: unable to insert data into children table
//test1: uncommenting code for user_id insertion; => not working;
//test2: uncommenting $fields ans $values;
//test3: all parameters in sql statement hard coded; => working!
//test4: table name and values hard coded /field name passed as parameter; => working!
//test5: field name and values passed in as variables / table name hard coded; => working!

//try {
	/*function register_user($db){
		$tables = array('users', 'children', 'search_profile', 'times_requested', 'times_offered', 'users_partner', 'user_address');
		foreach($tables as $table){
				$fields = get_sql_data($table, 'key', $db);
				$values = get_sql_data($table, 'value', $db);
				//$field_array = explode(', ', $sql_string);
				//$field = substr($field_array[1], 0, -3);
				//return $fields;
				//print_r($field_array);
				//echo $field;
				
					//	if($table == "times_requested" || $table == "times_offered") {
						//		foreach($values as $value) {
										$query_users = $db->prepare("INSERT INTO $table $fields VALUES $values");
										$query_users->execute();
									//	}
				/*	}	else {
								$query_users = $db->prepare("INSERT INTO $table $fields VALUES $values");
								$query_users->execute();
							}
								
						
						}
				
		}	*/
//} catch (Exception $e) {
	//$e->getMessage();
//}
//DEBUGGING
//problem: function register_user does not output fields or values for times_offered and times_requested!
//test 1: $tables array and foreach loop commented out; 1st argument of get_sql_data hard coded as "children"! => working!
//test 2: $tables array and foreach loop commented out; 1st argument of get_sql_data hard coded as "times_requested! =>not working!
//test 3: table variable initialized with "times_requested" within function; => not working!
//test 4: table variable initialized with "children" within function; => working!
//test 5: table variable initialized with "times_requested" within function / $field_array and $field commented out; => not working!
//test 6: evrything uncommented in tables array except for times_requested and times_offered; =>	



	function register_user($db){
		$tables = array('users', 'children', 'search_profile', 'times_requested', 'times_offered', 'users_partner', 'user_address');
		foreach($tables as $table){
				//$table = "times_requested";
				$fields = get_sql_data($table, 'key', $db);
				$values = get_sql_data($table, 'value', $db);
				
				//$test[] = $field;
						if($table == "times_requested" || $table == "times_offered") {
								$field_array = explode(', ', $fields);
								$field = substr($field_array[1], 0, -3)."_type";
										foreach($values as $value) {
												$query_users = $db->prepare("INSERT INTO $table $field VALUES $value");
												$query_users->execute();
												}
					}	else {
								$query_users = $db->prepare("INSERT INTO $table $fields VALUES $values");
								$query_users->execute();
							}
								
						
						}
				//var_dump($test);
		}		


		


function get_user_id($db) {
		$user_id = $db->prepare("SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1");
		$user_id->execute();
		$last_id = $user_id->fetch();
		$last_id = $last_id[0];
		$num = $last_id + 1.;
		$user_id = "'".$num."'";
		return $user_id;
}



	
	



function validationCheck($required){
			$missing = array();
				foreach($_POST as $key => $value) {
					
			// if the 'couple' radio button is checked the form validation on the user's partner section needs to be conducted!
				//	if($_POST['status'] == 'couple') {
							if(empty($value) && array_key_exists($key, $required)) {
									$missing[$key] = $required[$key];
					//	}   elseif(empty($value) && array_key_exists($key, $required2)){
									//$missing[key] = $required2[key];
							//	}
						}
			// if the user is a single parent only the input fields pertaining to the user himself have to be checked!
					//elseif (empty($value) && array_key_exists($key, $required)) {
											//$missing[key] = $required[key];
									//	}
						
					}
					return $missing;
			}
		

function validationCheck_2($dbc){
		$query = "SELECT * FROM users WHERE first_name == '$first_name' && last_name == '$last_name' && dob == '$birthdate'";
      	$data = mysqli_query($dbc, $query);
      	if (mysqli_num_rows($data) === 0) {
      											return true;
      										} else { return false;
      									}
}

function validationMessage($key, $array=null){
  	if(!empty($array)){
  	  	return array_key_exists($key, $array) ? "<span>".$array[$key]."</span>" : null;
  	  					}
  	  		 else {
  	  			return null;
  	  		}
  	  	}
  /*function validationMessage_address($key, $array=null){
  	if(!empty($array){
  	  	if(array_key_exists('street', $array) || array_key_exists('number', $array) || array_key_exists('zip', $array) || array_key_exists('location', $array)){
  	  				return "<span>".$array[$key]."</span>";
  	  	} else {return null;}
  	  					}
  	  		 else {
  	  			return null;
  	  		}
  	  	}	*/

function stickyText($par){
	if(isset($_POST[$par])) {
		return $_POST[$par];
	} elseif(isset($_SESSION[$par])) {
		return $_SESSION[$par];
	}
}

function stickyRadio($par, $value, $def=null) {
	if(isset($POST[$par]) && $POST[$par] == $value) {
		return "checked = \"checked\"";
	} elseif(isset($SESSION[$par]) && $POST[$par] == $value) {
		return "checked = \"checked\"";
	} elseif($value = $def){
		return "checked = \"checked\"";
	}
}

/*function post2session($parts = array()) {
	
	$out = array();
	foreach($_POST as $key => $value){
		is_array($value) ? value : trim($value);
		$par = explode("#", $key);
		if(in_array($par[0]), $parts) {
			$out[$key] = $value;
		} else{
			$_SESSION[$key] = $value;
		}
	}

	if(!empty($out)){
		foreach($_SESSION as $key => $value) {
			$par = explode("#", $key);
			if(in_array($par[0], $parts) && !array_key_exists($key, $out)) {
				unset($_SESSION[$key]);
			}
	}
	foreach($out as $key => $value) {
		$_SESSION[$key] = $value;
	} 
	} else{
		foreach($_SESSION as $key => $value) {
			$par = explode("#", $key);
			if(in_array($par[0]), $parts) {
			}
		}

	

	}
}
*/