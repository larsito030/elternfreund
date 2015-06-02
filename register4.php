<?php ob_start();
	if(!isset($_SESSION)) {
		session_start();
		}
		
	  	include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  	require_once('appvars.php');
  	  	include('../ef_dummy/inc/db_conx.php'); 
		include('../ef_dummy/inc/header.php'); 
	  	require_once('../ef_dummy/inc/config.php');
  	    require_once('../ef_dummy/inc/functions.php');
echo "<pre>";
print_r($_SESSION['post']);
$out = get_session_data('users_partner','value','string', $db);
$out2 = get_session_data('users_partner','key','string', $db);
$out3 = get_session_data('children','value','string', $db);
$out4 = get_session_data('children','key','string', $db);
$out5 = get_session_data('users','value','string', $db);
$out6 = get_session_data('users','key','string', $db);
echo $out;
echo $out2;
echo $out;
echo $out2;
echo "</pre>";
form_step_process($db);

/* $user_id = get_user_id($db, 'last');
$to = user_data('email', $user_id); 	
echo $user_id;
echo $to;    */

?>
<div class="reg4 pad1">
	<?php error_msg();?>
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
					<input type="password" name="password" value="<?php echo stickyText('password');?>">	
				</li>
				<li>Wiederhole bitte Dein Passwort</li>
				<li>
					<input type="password" name="password_again" value="<?php echo stickyText('password_again');?>">
				</li>
				<li>Bitte gebe noch Deine E-Mail-Adresse an</li>
				<li><input type="email" name="email" value="<?php echo stickyText('email');?>"></li>
			</ul>
	</fieldset>	
	<input type="submit" name="step4" value="Registrierung abschließen" class="uk-button uk-button-success"/>	
</form>
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
