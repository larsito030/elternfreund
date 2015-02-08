<?php 

	   if(!isset($_SESSION)) {
		session_start();
		}
		include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
  	  	require_once('../ef_dummy/inc/config.php');
  	  require_once('../ef_dummy/inc/functions.php');

$missing = validationCheck($required);


if(/*empty($missing) && */isset($_POST['step1'])){
	//post2session();
	foreach($_POST as $key => $value){
		if(!empty($value)){
			$_SESSION['post'][$key] = $_POST[$key];
		}
	}	

	header("Location: http://localhost/ef_dummy/register2.php");
	exit();

}

?>		
<div class="registerWrap">	
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="typeofParent">
			<?php echo validationMessage('status', $missing); ?>
			<div>
				<input type="radio" name="status" value="single" <?php echo stickyRadio('status','single');?>>
				<p>Ich bin alleinerziehend</p>
			</div>
			<div>
				<input type="radio" id="elternpaar" name="status" value="couple" <?php echo stickyRadio('status','couple');?>>
				<p>Wir sind ein Elternpaar</p>
			</div>	
		</div>	
		<fieldset class="reg1 DeineAngaben">	
			<h2>Deine Angaben</h2>
			<ul><?php echo validationMessage('gender', $missing); ?>
				<li>Geschlecht</li>
				<li><select>
						<option name="gender" value="male" <?php echo stickyRadio('gender','male');?>>männlich</option>
						<option name="gender" value="female" <?php echo stickyRadio('gender','female');?>>weiblich</option>
					</select></li>
					<?php echo validationMessage('firstname', $missing); ?>
				<li>Vornahme</li>
				<li><input type="text" name="firstname" value="<?php echo stickyText('firstname');?>"></li>
					<?php echo validationMessage('lastname', $missing); ?>
				<li>Nachname</li>
				<li><input type="text" name="lastname" value="<?php echo stickyText('lastname');?>"></li>
					<?php echo validationMessage('aboutme', $missing); ?>
				<li>über mich</li>
				<li><textarea name="aboutme"><?php echo stickyText('aboutme');?></textarea></li>
					<?php echo validationMessage('profession', $missing); ?>
				<li>Was machst Du beruflich?</li>
				<li><textarea name="profession"><?php echo stickyText('profession');?></textarea></li>
					<?php echo validationMessage('birthdate', $missing); ?>
				<li>Dein Geburtsdatum</li>
				<li><input type="date" name="birthdate" value="<?php echo stickyText('birthdate');?>"></li>
			</ul>
		</fieldset>	
		<fieldset class=" reg1 AngabenPartner">
			<h2>Angaben zu Deinem Partner</h2>
			<ul>
				<li>Geschlecht</li>
				<li><select>
						<option name="partner_gender" value="male">male</option>
						<option name="partner_gender" value="female">female</option>
					</select>
				</li>
				<li>Vorname</li>
				<li><input type="text" name="partner_firstname"></li>
				<li>Beruf</li>
				<li><input type="text" name="partner_profession"></li>
			</ul>
		</fieldset>	
		<fieldset class=" reg1 address">
			<h2>Eure Adresse</h2>
			// <ul><li><?php echo validationMessage('street', $missing); ?></li>
					<li><?php echo validationMessage('number', $missing); ?></li>
					<li><?php echo validationMessage('zip', $missing); ?></li>
					<li><?php echo validationMessage('location', $missing); ?></li>
				
				<li>Straße, Hausnummer</li>
				<li id="street"><input type="text" name="street" value="<?php echo stickyText('street');?>"></li>
				<li><input class="houseNumber" type="text" name="number" value="<?php echo stickyText('number');?>"></li>
				<li>Postleitzahl, Ort</li>
				<li id="PlZ"><input type="text" name="zip" value="<?php echo stickyText('zip');?>"></li>
				<li><input id="location" type="text" name="location" value="<?php echo stickyText('location');?>"></li>
			</ul>
		</fieldset>	
		<!--<span class="uk-button uk-button-success">weiter</span>	-->
		<input type="submit" name="step1" value="weiter"/>			
	</form>
</div>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
    <script>
        jQuery(".uk-icon-check-circle").fitText(0.8, { minFontSize: '20px', maxFontSize: '55px' });
    </script>
    <script>
    		//sets the height of the circles in the progress bar equal to the width
    		var liw = $('li.step').width();
				$('li.step').css({
    				'height': liw + 'px'
				});
			//enable fieldset with partner's particulars once the corresponding radio button is clicked
			$('input[name="parent"]').click(function(){
            if($(this).attr("value")=="couple"){
                $(".AngabenPartner").show();
            }  else
                {$(".AngabenPartner").hide();
                }
            });

	</script>	
  </body>
</html>

