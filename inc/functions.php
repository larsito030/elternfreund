<?php



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