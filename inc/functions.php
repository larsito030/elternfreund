<?php

//test1: offer_type in sql statement hard coded; foreach-loop commented out;

//1. Get an array "$total" of all user_ids that match our request! => COMPLETED!
//2. Get an array "$users" in which all duplicate user_ids have been removed! 
//3. Count number of identical user_ids in $total and store the result in the variable "$score" for each matching partner!
//4. Insert data into "matching score" table!
//		
	function sub_score($db, $user_id, $param) {
			$test = "SELECT ".$param."_type FROM times_".$param."ed WHERE user_id = $user_id";
			$data = $db->prepare("SELECT ".$param."_type FROM times_".$param."ed WHERE user_id = $user_id");
			$data->execute();
			$results = $data->fetchAll();
			foreach($results as $result) {
					$type = ($param == 'request') ? 'offer' : 'request';
					$results2 = $db->prepare("SELECT user_id FROM times_".$type."ed WHERE ".$type."_type = '$result[0]'");
					$results2->execute();
					while ($row = $results2->fetch(PDO::FETCH_NUM)) {
							$string .= $row[0]." ";
				}
			}
			$total = explode(" ", $string);
			$matches = array_unique($total);
			$scores = array_count_values($total);
			return $scores;
	}

	function score($db, $user_id){
			$offer_match = array_keys(sub_score($db, $user_id, 'offer'));
			$request_match = array_keys(sub_score($db, $user_id, 'request'));
			$total_matches = array_unique(array_merge($offer_match, $request_match));
			$score = array_map("min_score", $total_matches); 
			return $score;
	}

	function min_score($match) {
			global $db;
			$offer = sub_score($db, 50, 'offer');
			$request = sub_score($db, 50, 'request');
			$score = min($offer[$match], $request[$match]);
			return $score;
	}

	function get_session_data($table,$param,$type, $db) {
//array of columns pertaining to each of the database tables
			if($table == 'users') {
				$cols = array('first_name', 'last_name', 'Status' , 'about_me', 'profession', 'dob','password', 'email', 'gender', 'profile_pic', 'pic_2', 'pic_3');																										}		
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
		 					//if(is_array($key)){
		 					if(strpos($key, 'pic') !== false){
		 							$fields[] = $key;
		 							$values[] = get_file_path($key, $value);
		 							$tmp[] = $value['tmp_name'];
		 					} else {
									$fields[] = $key;
									$values[] = $value;}
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
		 	if(strpos($fields[0], 'times')) {
		 					$db_fields = $fields;
		 					$db_values = $values;
				}elseif($table == 'users') {	
		 					$db_fields = "(".implode(', ', $fields).")";	
							$db_values ="('".implode("', '", $values)."')";
				} else {	 
							$user_id = strval(get_user_id($db));
							$db_fields ="(".implode(', ', $fields).", user_id)";	
							$db_values ="('".implode("', '", $values)."', '".$user_id."')";
				} 
					if($param == 'key'){
							if($type == 'array'){
								return $fields;}
							elseif($type == 'string'){
								return $db_fields;}
		 			}elseif($param =='value') {
		 					if($type == 'array'){
								return $values;}
							elseif($type == 'string') {
							return $db_values;}
		 			}elseif ($param == 'tmp')
		 				 {	return $tmp;}

		 			else {echo "Please enter valid 2nd parameter!";}
	}

function get_file_path($key, $value){
		$file_name = $value['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_path = 'img/profile/' . mt_rand() . '.' . $file_extn;
		return $file_path;
}

function upload_file($db) {
		$tmp = get_session_data('users','tmp','array', $db);
		$val = get_session_data('users', 'value','array', $db);
		foreach($val as $element) {
				if(strpos($element, 'img/profile') !== false) {
						$target[] = $element;}
		}
		$combined = array_combine($tmp, $target);
		foreach ($combined as $key => $value) {
				//move_uploaded_file($key, $value);	
				$out[] = "move_uploaded_file(".$key.", ".$value.') ';	
			}	
			var_dump($out);
}


function register_user($db){
		$tables = array('users', 'children', 'search_profile', 'times_requested', 'times_offered', 'users_partner', 'user_address');
		foreach($tables as $table){
				$fields = get_session_data($table, 'key', 'string', $db);
				$values = get_session_data($table, 'value', 'string', $db);
						if($table == 'times_requested' || $table == 'times_offered') {
								$field = "(".substr($fields[1], 0, -3)."_type, user_id)";
										foreach($values as $value) {
												$user_id = strval(get_user_id($db));
												$value = "('".$value."', '".$user_id."')";
												$out[] = $value;
												$query_users = $db->prepare("INSERT INTO $table $field VALUES $value");
												$query_users->execute();
												}
						}else {
								$query_users = $db->prepare("INSERT INTO $table $fields VALUES $values");
								$query_users->execute();
							} 
					} 
		}		


function get_user_id($db) {
		$user_id = $db->prepare("SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1");
		$user_id->execute();
		$last_id = $user_id->fetch();
		$user_id = $last_id[0];
		//$user_id = $last_id + 1.;
		return $user_id;
}

function upload_profile_image($db) {
		foreach($_FILES as $key => $value) {
				if (isset($_FILES[$key]) === true) {
						if (empty($_FILES[$key]['name']) === true) {
						echo 'Wähle bitte ein Foto aus!';	
					} 	else {
						$allowed = array('jpg', 'jpeg', 'gif', 'png');
						$file_name = $_FILES[$key]['name'];
						$file_extn = strtolower(end(explode('.', $file_name)));
						$file_temp = $_FILES[$key]['tmp_name'];
						if(in_array($file_extn, $allowed) === true) {
										$file_path = "('img/profile/" . substr(md5(time()), 0, 10) . '.' . $file_extn."')";
										//move_uploaded_file($file_temp, $file_path);
					} 	else {
						echo 'Unzulässiger Dateityp. Erlaubt: ';
						echo implode(', ', $allowed);
					}
				}
			}
		}
		return $file_path;
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