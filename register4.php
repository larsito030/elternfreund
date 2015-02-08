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
if(/*empty($missing) && */isset($_POST['step4'])){
		foreach($_POST as $key => $value){
				if(!empty($value)){
						$_SESSION['post'][$key] = $_POST[$key];
										}
	}
	
	$out = $_SESSION['post'];
	print_r($out);
}
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
