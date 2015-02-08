<?php ob_start();
	if(!isset($_SESSION)) {
		session_start();
		}
		
	  	include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  	require_once('appvars.php');
  	  	require_once('connectvars.php');
		include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  //	require_once('../ef_dummy/inc/config.php');
  	    require_once('../ef_dummy/inc/functions.php');

//$missing = validationCheck($required);
if(/*empty($missing) && */isset($_POST['step2'])){
		foreach($_POST as $key => $value){
				if(!empty($value)){
						$_SESSION['post'][$key] = $_POST[$key];
										}
	}
		
	header("Location: http://localhost/ef_dummy/register3.php");
	exit();
}




?>

<form id="Child" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset class="myChild">
		<ul class="childParticulars">
			<li>mein Kind heißt</li>
			<li><input type="text" name="child_name"></input></li>
			<li>und ist ein</li>	
			<li><select>
					<option value="Junge">Junge</option>	
					<option value="Mädchen">Mädchen</option>			
				</select>
			</li>
			<li>es wurde geboren am</li>
			<li><input type="date" name="child_dob"></input></li>
			<li>über mein Kind</li>
			<li><textarea placeholder="Hier kannst Du über Dein Kind aus dem Nähkästchen plaudern. Ist Dein Kind eher ruhig oder lebhaft? Hat es besondere Hobbies oder Lieblingsfächer ind er Schule?" name="about_child"></textarea></li>
		</ul>
		
	</fieldset>		
		<h4 class="photoInstruct">Lade jetzt bitte noch mit einem Klick auf die Beispielbilder drei Fotos hoch!</h4>
		<ul id="photoUpload">
			<ul>
				<li>1. Eltern-Kind-Foto</li>
				<li><img src="../ef_dummy/img/fake1.jpg"></li>
			</ul>
			<ul>		
				<li>2. Foto von Deinem Kind </li>
				<li><img src="../ef_dummy/img/kind.jpg"></li>
			</ul>
			<ul>	
				<li>Foto von Dir/Euch</li>
				<li><img src="../ef_dummy/img/mutter.jpg"></li>
			</ul>
		</ul>	
		
	
	
	<a href="../ef_dummy/register3.php"><span class="uk-button uk-button-success">weiter</span></a>
	<button class="uk-button uk-button-primary" id="addChild">Kind hinzufügen</button>
	<h4 id="addChild">Möchtest Du noch weitere Kinder hinzufügen?</h4>
	//<a href="../ef_dummy/register.php"><span class=uk-icon-angle-double-left></span></a>
	<input type="submit" name="step2" value="weiter"/>	
</form>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
<script>
	$('#addChild').click(function(){
			$('.myChild').clone().appendTo('form');
	});
	

</script>