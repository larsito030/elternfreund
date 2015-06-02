<?php
	function set_matching_scores($init="NULL") {
		global $db;
		if($init='update') {
			$user_id = intval($_SESSION['user_id']);
			$remove = $db->prepare("DELETE * FROM matching_scores WHERE user_id='$user_id'");
			$remove->execute();	
		} else {
			$user_id = get_user_id($db);
		}
		$user_id = 50;
		$scores = sub_score_11($db, 50);
		foreach($scores as $key => $value) {
			$match_id = $key;
			$value = $value;
			$query  = "INSERT INTO matching_scores (score, user_id, matching_partner_id) ";
			$query .= "VALUES('$value','$user_id','$match_id')";
			$data = $db->prepare($query);
			$data->execute();
		}
	}

	function show_matches_html($start, $end, $type) {
		global $db;
		$user_id = $_SESSION['user_id'];
		$id = $_GET['id'];
			if(isset($_SESSION['id'])) {
				if($type === "request") {
					$array_user = user_data('request_type', $user_id);
					$array_matchee = user_data('offer_type', $id);
				}else {
					$array_user = user_data('offer_type', $user_id);
					$array_matchee = user_data('request_type', $id);
							}
				} elseif(!isset($_SESSION['id'])) {
					if($type === "request") {
						$array_matchee = user_data('request_type', $id);
						$array_user = user_data('request_type', $id);
					}else {
						$array_matchee = user_data('offer_type', $id);
						$array_user = user_data('offer_type', $id);
						}
				}
			for($i=$start; $i<=$end; $i++) {
				if(in_array($i, $array_user) && in_array($i, $array_matchee)) {
					$out .= "<td><span class=\"uk-icon-check-circle\"></span></td>";
				} else {$out .= "<td></td>";}
			}
			echo $out;
	}
	
	function sub_score_1($db, $user_id, $param) {
		//This function returns the score value which is based on the number of time periods a request for childcare
		//matches the user's offered childcare time and vice versa. The function takes 3 arguments, the last of it being either 'offer'
		//or 'request'.
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

	function sub_score_11($db, $user_id){
		//This function returns an array containing the score values for each matching partner. It grabs the offer and 
		//request scores from the function "sub_scores", compares the values of each for each matching partner and stores the lower value 
		//of both in a new array.
			$offer_match = array_keys(sub_score_1($db, $user_id, 'offer'));
			$request_match = array_keys(sub_score_1($db, $user_id, 'request'));
			$total_matches = array_unique(array_merge($offer_match, $request_match));
			$scores = array_map("min_score", $total_matches); 
			$result = array_combine($total_matches, $scores);
			$result = array_diff($result, array(''));
			return $result;
	}

	function min_score($match) {
			global $db;
			$offer = sub_score_1($db, 50, 'offer');
			$request = sub_score_1($db, 50, 'request');
			$score = min($offer[$match], $request[$match]);
			return $score;
	}

	function subscore_2($db, $user_id) {
			$data = $db->prepare("SELECT frequency FROM search_profile WHERE user_id = $user_id");
			$data->execute();
			$result = $data->fetchAll();
			$data2 = $db->prepare("SELECT frequency, user_id FROM search_profile");
			$data2->execute();
			$results = $data->fetchAll();

			switch ($frequency) {
				case 'gelegentlich':
					$num = 1;
					break;
				case '2-3x/Monat':
					$num = 2;
					break;
				case '1-2x/Woche':
					$num = 3;
					break;
				case '2-3x/Woche':
					$num = 4;
					break;
			}
		}

	function get_session_data($table,$param,$type, $db) {
			if($table == 'users') {
				$cols = array('first_name', 'last_name', 'Status' , 'about_me', 'profession', 'dob','password', 'email', 'gender');}																						
			elseif($table =='children') {
				$cols = array('child_name', 'child_dob', 'child_gender');}
			elseif($table == 'search_profile') {
				$cols = array('flexibility', 'frequency');}
			elseif($table == 'users_partner') {
				$cols = array('partner_gender','partner_firstname','partner_profession');}
			elseif($table =='user_address') {
			 	$cols = array('street', 'number', 'zip', 'location');}
			elseif($table =='search_profile') {
			 	$cols = array('flexibility', 'frequency');}

			foreach($_SESSION['post'] as $key => $value) {
		 			if(in_array($key, $cols)) {	
									$fields[] = $key;
									$values[] = ($key === 'password') ? md5($value) : $value;
					}elseif($table =='times_offered') {
							if(substr($key,0,5) == 'offer'){
									$fields[] = $key;
									$values[] = $value;}
					}elseif($table == 'times_requested'){
							if(substr($key,0,7) == 'request'){
									$fields[] = $key;
									$values[] = $value;
							}	
					}
				}
		 		
		 	if(strpos($fields[0], 'times')) {
		 					$db_fields = $fields;
		 					$db_values = $values;
				}elseif($table == 'users') {	
							$file_name = get_user_id($db);
							$count = count_uploaded_pics();
							$img_keys = "";
							$img_vals = "";
							for($i = 0; $i < $count; $i++) {
									$img_keys .=", profile_pic".($i + 1);
									$img_vals .=", '".UPLOAD_PATH.$file_name.($i+1).".jpg";
							}
							$email_code = substr(md5(time()),0,10).mt_rand(0,999);
		 					$db_fields = "(".implode(', ', $fields).$img_keys.", timestamp, email_code)";	
							$db_values ="('".implode("', '", $values)."'".$img_vals.", CURRENT_TIMESTAMP, '".$email_code."')";
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
		$file_path = "C:/xampp/htdocs/ef_dummy/img/profile/" . mt_rand() . '.' . $file_extn;
		return $file_path;
}

function upload_file($db) {
		if(isset($_POST['step2'])) {
				$tmp_name_array = $_FILES['profile_pic']['tmp_name'];
				for($i=0; $i<count($tmp_name_array); $i++) {
						$target = ROOT_PATH.UPLOAD_PATH.get_user_id($db).$i.".jpg";
						move_uploaded_file($tmp_name_array[$i], $target);
					}
				}
			}
function prepare_for_cropping() {
		$folder = 'img/';
		$orig_w = 400;

		if(isset($_POST['step2'])){
			$imageFile = $_FILES['upload']['tmp_name'];
			$filename = basename($_FILES['upload']['name']);
			list($width, $height) = getimagesize($imageFile);
			$src = imagecreatefromjpeg($imageFile);
			$orig_h = ($height/$width)* $orig_w;
			$tmp = imagecreatetruecolor($orig_w, $orig_h);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $orig_w, $orig_h, $width, $height);
			imagejpeg($tmp, $folder.$filename, 100);
			imagedestroy($tmp);
			imagedestroy($src);
			$filename = urlencode($filename);
			$out = $_FILES['upload']['size'];
			echo "<pre>";
			print_r($out);
			echo "</pre>";
			header("Location: crop.php?filename=$filename&height=$orig_h");
			}
		}
		
/*				
move_uploaded_file($temp, $target);}
				$tmp = get_session_data('users','tmp','array', $db);
				$val = get_session_data('users', 'value','array', $db);
				foreach($val as $element) {
						if(strpos($element, 'img/profile') !== false && !empty($element)) {
								$target[] = $element;}
				}
				$combined = array_combine($tmp, $target);
				foreach ($combined as $key => $value) {
						move_uploaded_file($key, $value);	
						//$out[] = "move_uploaded_file(".$key.", ".$value.') ';	
					}	
			//var_dump($out);
			//echo $out;
			//return $key;
				}
}*/

function register_user($db){
		
		$tables = array('users', 'children', 'search_profile', 'times_requested', 'times_offered', 'users_partner', 'user_address');
		foreach($tables as $table){
				$fields = get_session_data($table, 'key', 'string', $db);
				$values = get_session_data($table, 'value', 'string', $db);
						if($table == 'times_requested' || $table == 'times_offered') {
								$fields = get_session_data($table, 'key', 'array', $db);
								$values = get_session_data($table, 'value', 'array', $db);
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
					set_matching_scores();
		}	

function get_user_id($db, $par = "last") {
		if($par === 'last') {
				$user_id = $db->prepare("SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1");
		}elseif($par === 'mail') {
				$email = $_POST['email'];
				$user_id = $db->prepare("SELECT user_id FROM users WHERE email = '$email'");	
		}
		$user_id->execute();
		$last_id = $user_id->fetch();
		$user_id = $last_id[0];
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

//Sanitizing the registration form!! 
function is_valid($db, $data){
//This functions checks whether all form fields of one form page are filled in properly. If there are any missing
//or flawed data the function adds a new value to the errors array. The required array is in inc/config.php.
		global $required_keys, $required_keys_2, $db;
		if(isset($_POST['step1']) && $_POST['status'] === 'couple') {
				$required_keys = array_merge($required_keys, $required_keys_2);
		}
		$pg = get_page();
		foreach($_POST as $key => $value) {
				if(empty($value) && in_array($key, $required_keys)) {
						$errors[] = $key;
				}elseif(substr($key,0,5) === 'offer'){
						$offer_array[] = $key;
				}elseif(substr($key,0,7) === 'request'){
						$request_array[] = $key;
				}elseif(password_valid($key) === false) {
						$errors[] = $key."_flawed";
				}
			}
			if(isset($_POST['step2']) && empty($_FILES['profile_pic1'])) {
					$errors[] = 'picture';} 
			if(isset($_POST['step3']) && (empty($offer_array) || empty($request_array))) {
					$errors[] = 'request';} 
			if(user_exists($db) === true) {
					$errors[] = 'user_exists';}
			if(email_exists($db) == true) {
					$errors[] = 'email_exists';}
			if(passwords_identical() === false) {
					$errors[] = 'passwords_different';}
			$step = "step".$pg;
			$result = (empty($errors) === true && isset($_POST[$step])) ? true : false;
			if($data === 'boolean') {
					$out = $result;
			} elseif($data === 'errors') {
					$out = $errors;
			} 
			return $out;
	}

function email_exists($db) {
		if(isset($_POST['email'])) {
				$email = trim($_POST['email']);
				$data = $db->prepare("SELECT user_id FROM users WHERE email = '".$email."'");
				$data->execute();
				$num = $data->rowCount();
				$out = ($num !== 0) ? "true" : "false";
				return $out;
		}	
}
	
function user_exists($db, $type="register"){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$dob = $_POST['dob'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		if($type === 'register') {
				if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['dob'])) {
						$data = $db->prepare("SELECT user_id FROM users WHERE first_name = '".$first_name."' AND last_name = '".$last_name."' AND dob = '".$dob."'");
		      			$data->execute();
		      			$rows = $data->rowCount();
		      			$result = ($rows === 0) ? false : true;}
		}elseif($type === 'login') {
				if(isset($_POST['email']) && isset($_POST['password'])) {
						$data = $db->prepare("SELECT user_id FROM users WHERE email = '".$email."'");
						$data->execute();
		      			$rows = $data->rowCount();
		      			$result = ($rows === 0) ? false : true;}			
		
	}
		return $result;
}

function password_valid($key) {
		if($key === 'password') {
				$password = $_POST['password'];
				$contains_number = preg_match('/\d/', $password) ? true : false;
				$contains_letter = preg_match('/[a-zA-Z]/', $password) ? true : false;
				$valid = (strlen($password) >= 8 && $contains_letter === true && $contains_number === true) ? true : false;
				return $valid;
		}	
}

function passwords_identical() {
		if(isset($_POST['password']) && isset($_POST['password_again'])) {
				$result = ($_POST['password'] === $_POST['password_again']) ? true : false;
				return $result;
		}
		
}

function post2session() {
				foreach($_POST as $key => $value){
						if(!empty($value)){
								$_SESSION['post'][$key] = $_POST[$key];
					} 	elseif(empty($value) && isset($_SESSION['post'][$key])) {
								unset($_SESSION['post'][$key]);
					}
				}
				if(!empty($_FILES)) {
						foreach($_FILES as $key => $value) {
								$_SESSION['post'][$key] = $_FILES[$key];
						} 
					}
				}

function get_page() {
		if(isset($_POST['step1'])) {
			$pg = 1;
		} elseif(isset($_POST['step2'])) {
			$pg = 2;
		} elseif(isset($_POST['step3'])) {
			$pg = 3;	
		}elseif(isset($_POST['step4'])) {
			$pg = 4;		
		}
		return $pg;
}		

function form_step_process($db) {
		if(is_valid($db, 'boolean') === true) {
				if(get_page() === 2) {
						//image_crop_and_upload();
						}
				post2session();
				if(get_page() === 4) {
						register_user($db);
						activation_mail();
						header("Location: http://localhost/ef_dummy/index.php?success");
						session_destroy();
				}else {
						page_direct();
						}		
				} 
		}

function success_msg() {
		if(isset($_GET['success'])) {
				$out = "<div class=\"success_msg\">Herzlich willkommen bei Elternfreund!";
                $out .="<div class=\"activate\">";
                $out .="Wir haben soeben einen Aktivierungslink an Ihre E-Mail-Adresse gesendet.";
                $out .="</div>";
				$out .="</div>";
				session_destroy();
		}elseif(isset($_GET['active'])) {
				$out = "<div class=\"success_msg\">Ihr Account wurde erfolgreich aktiviert!";
                $out .="<div class=\"activate\">";
                $out .="Sie können sich jetzt einloggen.";
                $out .="</div>";
				$out .="</div>";
		}
		echo $out;
}

function page_direct() {
		$pg = get_page();
		$page = $pg + 1;
		header("Location: http://localhost/ef_dummy/register".$page.".php");
}

function validationMessage($key, $array=null){
  	if(!empty($array)){
  	  	return array_key_exists($key, $array) ? "<span>".$array[$key]."</span>" : null;
  	  					}
  	  		 else {
  	  			return null;
  	  		}
  	  	}

function error_msg() {
		global $required, $required_2, $db;
		$required = ($_POST['status'] === 'couple') ? array_merge($required, $required_2) : $required;
		if(is_valid($db, 'boolean') === false) {
				$errors = is_valid($db, 'errors');
				foreach($errors as $error) {
						$msg = $required[$error];
						echo "<span class =\"error_msg\">".$msg."</span>";
						break;
				}
		}
}

function error_msg_li($errors) {
		foreach($errors as $error) {
			echo "<span class =\"error_msg\">".$errors."</span>";
			break;
		}
}

function stickyText($par){
	if(isset($_POST[$par])) {
		return $_POST[$par];
	} elseif(isset($_SESSION['post'][$par])) {
		return $_SESSION['post'][$par];
	}
}

function stickyRadio($par, $value, $def=null) {
	if(isset($POST[$par]) && $POST[$par] == $value) {
		return "checked = \"checked\"";
	} elseif(isset($SESSION['post'][$par]) && $SESSION['post'][$par] == $value) {
		return "checked = \"checked\"";
	} elseif($value = $def){
		return "checked = \"checked\"";
	}
}

function stickyCheckbox($i, $type) {
		$key = ($i < 10) ? $type."#0".$i : $type."#".$i;
		if(isset($_POST[$key]) && $_POST[$key] == $i) {
				return "checked = \"checked\"";
		}elseif(isset($_SESSION['post'][$key]) && $_SESSION['post'][$key] == $i) {		
				return "checked = \"checked\"";
	}
}

function get_form_html($start, $end, $type) {
		for($i = $start; $i < $end; $i++) {
				$checked = stickyCheckbox($i, $type);
				$x = ($i>=10) ? "" : "0";
				echo "<td><input type=\"checkbox\" name=\"{$type}#{$x}{$i}\" value=\"{$i}\" {$checked}></td>";
		}
}

function count_uploaded_pics() {
	global $db;
	$id = get_user_id($db);
	$pics = $_SESSION['post']['profile_pic']['name'];
	$count = 0;
	if(file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$id."1.jpg")) {
		if(file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$id."2.jpg") && file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$id."3.jpg")) {
			$count = 3;
		} elseif(file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$id."2.jpg") || file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$id."3.jpg")) {
			$count = 2;
		} else {
			$count = 1;
	}
	return $count;
	}
}



function user_data($field, $user_id="NULL") {
	global $db;
	if(isset($_GET['id']) && $user_id =="NULL") {
		$user_id = $_GET['id'];
	}
	$get_table = $db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '{$field}'");
	$get_table->execute();
	$table = $get_table->fetchAll();
	$table = $table[0]['TABLE_NAME'];
	$user_data = $db->prepare("SELECT {$field} FROM {$table} WHERE user_id = '{$user_id}'");
	$user_data->execute();
	if(strpos($field, '_type') !== false) {
		$count = $user_data->rowCount();
		$user_data = $user_data->fetchAll();
		$string = "";
		for($i=0; $i<=$count; $i++) {
			$array[] .= $user_data[$i][0];
		}
		return $array;
	} else {
		$user_data = $user_data->fetch();
		if(isset($_GET['id'])) {
			echo $user_data[0];
		} else {return $user_data[0];}
	}
}

function user_active(){
	global $db;
	$email = trim($_POST['email']);
	$password = md5(trim($_POST['password']));
	$num = $db->prepare("SELECT COUNT(user_id) FROM users WHERE email = '$email' AND password = '$password' AND active = 1");
	$num->execute();
	$num = intval($num);
	return ($num === 1) ? true : false;
}

function password_correct() {
	global $db;
	$email = trim($_POST['email']);
	$password = md5(trim($_POST['password']));
	$data = $db->prepare("SELECT COUNT(user_id) FROM users WHERE email = '$email' AND password = '$password'");
	$data->execute();
	$result = $data->fetch();
	$result = intval($result[0]);
	return ($result === 1) ? true : false;
}

function activation_mail() {
	global $db;
	$user_id = get_user_id($db, 'last');
	$to = user_data('email', $user_id);
	$subject = "Aktivierung Ihres Elternfreund-Accounts";
	$x = (user_data('gender', $user_id) === 'male') ? "r" : "";
	$message = "Liebe{$x} ".user_data('first_name', $user_id)." ".user_data('last_name', $user_id).", \n\n Sie müssen Ihren Account nur noch ";
	$message .="aktivieren. Klicken Sie hierfür einfach auf folgenden Aktivierungslink: \n\n ";
	$message .="http://localhost/ef_dummy/activate.php?email=".user_data('email', $user_id)."&email_code=".user_data('email_code', $user_id)."\n\n";
	$message .="Ihr Elternfreund Team.";
	mail($to, $subject, $message, 'From:elternfreund@gmail.com');
}

function activate() {
	global $db;
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	$data = $db->prepare("SELECT COUNT(user_id) FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0");
	$data->execute();
	$result = $data->fetch();
	if(intval($result[0]) === 1) {
		$active = $db->prepare("UPDATE users SET active = 1 WHERE email = '$email'");
		$active->execute();
		header("Location: http://localhost/ef_dummy/index.php?active");
		return true;
	} else {
		return false;
	}
}

function activation_msg() {
	if(activate() === true) {
		header("Location: http://localhost/ef_dummy/activate.php?success");
	} else {
		echo "Ihr Konto konnte leider nicht aktiviert werden";
	}
	if(isset($_GET['success'])) {

	}
}

function login_valid() {
	global $db;
	$errors = array();
	if(empty($_POST['email']) || empty($_POST['password'])) {
		$errors[] = "Bitte geben Sie Ihre Email-Adresse und Ihr Passwort an!";
	}elseif(email_exists($db) === false) {
		$errors[] = "Diese E-Mail-Adresse ist bei uns nicht registriert";
	}elseif(password_correct() === false) {
		$errors[] = "Ihr Passwort ist nicht korrekt!";
	}elseif(user_active() === false) {
		$errors[] = "Bitte aktivieren Sie erst Ihr Konto!";
	}//else {
		//$_SESSION['user_id'] = get_user_id($db, 'mail');
	//}
	return (empty($errors)) ? true : $errors;

}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function login() {
	global $db;
	if(login_valid() === true) {
		$_SESSION['user_id'] = get_user_id($db,'mail');
		var_dump($_SESSION['user_id']);
	}
}

function logout() {
	if(isset($_GET['logout'])) {
		session_destroy();
	}
}

function login_submit() {
	echo (login_valid() !== true) ? "class=\"errors\"" : "";
}

function show_menu() {
	if(isset($_SESSION['user_id'])) {
		include('../ef_dummy/inc/menu_logged_in.php');
	}else{
		include('../ef_dummy/inc/menu.php');
	}
}

function get_list_view() {
	$data = paginate($rpp);
	var_dump($data);
}

function paginate($rpp) {
	global $db;
	//$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	$cur_page = (isset($_GET['pg'])) ? $_GET['pg'] : 1;
	$skip = ($cur_page - 1) * $rpp;
	$total = count_datasets();
	$num_pages = ceil($total/$rpp);
	$data = $db->prepare("SELECT user_id FROM users LIMIT $skip, $rpp WHERE user_id != '$user_id'");
	$data->execute();
	$row = $data->fetchAll();
	return $row;	
}

function count_datasets() {
	global $db;
	$total = $db->prepare("SELECT COUNT(user_id) FROM users");
	$total->execute();
	$result = $total->fetch();
	var_dump($result[0]);
}

function get_list_view_html() {
		global $rpp;
		$user_ids =paginate($rpp);
		foreach($user_ids as $user_id) {
            $user_id = $user_id['user_id'];
            $birthday = user_data('child_dob', $user_id);
            $age = date_create($birthday)->diff(date_create('today'))->y;
            echo '<a class="profilePanel" href="../ef_dummy/profile.php?id='.$user_id.'">';
            echo '<div class="pp-photo"><img src="'.user_data('profile_pic1', $user_id).'" alt=""></div>';
            echo '<ul class="pp-textWrap">';
            echo '<ul class="pp-particulars">';
        		echo '<li>'.user_data('first_name', $user_id).' und '.user_data('child_name', $user_id). ' '. '('.$age.')'.'</li>';
        		echo '<li>Prenzlauer Berg</li>';
        		echo '<li>'.user_data('Status', $user_id).'</li>';
        	echo '</ul>';
        	echo '<p>'.user_data('about_me', $user_id).'</p>';
        	echo '</ul>';
        	echo '</a>';

    	}
}

function get_age() {
	$user_id = $_GET['id'];
	$birthday = user_data('child_dob', $user_id);
	$from = new DateTime($birthday);
	$to   = new DateTime('today');
	echo $from->diff($to)->y;
}

function get_file_name($par) {
if(isset($_FILES['profile_pic1']) || isset($_FILES['profile_pic2']) || isset($_FILES['profile_pic3'])) {
	global $db;
		if($_FILES['profile_pic1'][error] === 0) {
			$filename = get_user_id($db)."1.jpg"; 
			//unset($_SESSION['pic1']);
			$_SESSION['pic'] = $filename;
			//$filename = substr(mt_rand())."1.jpg";
			$imageFile = $_FILES['profile_pic1']['tmp_name'];
		} elseif($_FILES['profile_pic2'][error] === 0) {
			$filename = get_user_id($db)."2.jpg";
			//unset($_SESSION['pic1']);
			$_SESSION['pic'] = $filename;
			//$filename = substr(mt_rand())."2.jpg";
			$imageFile = $_FILES['profile_pic2']['tmp_name'];
		} elseif($_FILES['profile_pic3'][error] === 0) {
			$filename = get_user_id($db)."3.jpg";
			//unset($_SESSION['pic1']);
			$_SESSION['pic'] = $filename;
			//$filename = substr(mt_rand())."3.jpg";
			$imageFile = $_FILES['profile_pic3']['tmp_name'];
		}
		if($par === 'fn') {
			return $filename;
		} elseif($par === 'if') {return $imageFile;
		} elseif($par === 'src') {
			echo "../ef_dummy/img/".$filename;
		}
	}
	

}

function image_crop_and_upload() {
	if(isset($_FILES['profile_pic1']) || isset($_FILES['profile_pic2']) || isset($_FILES['profile_pic3'])) {
		global $db;
		$filename = get_file_name('fn');
		$imageFile = get_file_name('if');
		$target = $_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$filename;
		list($width, $height) = getimagesize($imageFile);
		$src = imagecreatefromjpeg($imageFile);
		$orig_w = 500;
		$orig_h = ($height/$width)* $orig_w;
		$tmp = imagecreatetruecolor($orig_w, $orig_h);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $orig_w, $orig_h, $width, $height);
		imagejpeg($tmp, $target, 100);
		$id = get_user_id($db);
		if(isset($_FILES['profile_pic1'])) {
			$no = 1;
		} elseif(isset($_FILES['profile_pic2'])) {
			$no = 2;
		} elseif(isset($_FILES['profile_pic3'])) {
			$no = 3;
		}
		$upload = $db->prepare("INSERT INTO users profile_pic1 VALUES '../ef_dummy/img/profile/'".$id.$no.".jpg'");
		$upload->execute();
		imagedestroy($tmp);
		imagedestroy($src);
		}
			if(isset($_POST['crop'])) {
			$target = $_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$_SESSION['pic'];
			$targ_w = 500;
			$targ_h = 375;
			$ratio = $targ_w / $targ_h;
			$src = imagecreatefromjpeg($target);
			$tmp = imagecreatetruecolor($targ_w, $targ_h);
			imagecopyresampled($tmp, $src, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);
			imagejpeg($tmp, $target, 100);
			imagedestroy($tmp);
			imagedestroy($src);
			echo $target;
		} 

	}
/*
function raw_img_path(){
	global $db;
			$filename = get_user_id($db).".jpg";
			return $filename;
}*/

function profile_img_prev($no) {
	global $db;
			/*$id = get_user_id($db);
			if($no === '1') {
				$file = $id."1.jpg";
			}elseif ($no === '2') {
				$file = $id($db)."2.jpg";
			}elseif($no === '3') {
				$file = $id($db)."3.jpg";
			}
			if(file_exists($_SERVER['DOCUMENT_ROOT'].UPLOAD_PATH.$file)) {
				echo "..".UPLOAD_PATH.$file;
			} else {*/
				echo "../ef_dummy/img/avatar".$no.".jpg";
			//}		
		}
/*
function show_img_preview() {
	if(image_crop_and_upload() === true) {
		$filename = get_file_name('fn');
		echo "..".UPLOAD_PATH.$file_name;
		return true;
	}
}

function show_modal() {
	if(show_img_preview() === true) {
			echo "show";
	} else {echo "hide";}
}*/






