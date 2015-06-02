<?php ob_start();

	   if(!isset($_SESSION)) {
		session_start();
		}
		include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
  	  	require_once('../ef_dummy/inc/config.php');
  	  require_once('../ef_dummy/inc/functions.php');
form_step_process($db);

?>		
<div class="registerWrap">	
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<?php error_msg();?>
		<fieldset class="reg1 DeineAngaben">	
			<h2>Deine Angaben</h2>
				<li>Geschlecht</li>
				<li><select name="gender">
						<option value="male" <?php echo stickyRadio('gender','male');?>>männlich</option>
						<option value="female" select="selected"<?php echo stickyRadio('gender','female');?>>weiblich</option>
					</select></li>
				<li>Vornahme*</li>
				<li><input type="text" name="first_name" maxlength="25" value="<?php echo stickyText('first_name');?>"></li>
				<li>Nachname*</li>
				<li><input type="text" name="last_name" maxlength="30" value="<?php echo stickyText('last_name');?>"></li>
				<li>über mich</li>
				<li><textarea name="about_me" rows="30" maxlength="300"><?php echo stickyText('about_me');?></textarea></li>
				<li>Was machst Du beruflich?*</li>
				<li><input type="text" name="profession" value="<?php echo stickyText('profession');?>"></li>
				<li>Dein Geburtsdatum*</li>
				<li><input type="date" name="dob" value="<?php echo stickyText('dob');?>"></li>
			</ul>
		</fieldset>	
		<fieldset class=" reg1">
			<div class="typeofParent" id="typeOfParent">
			
			<div class="singleOrCouple">
				<input type="radio" name="status" value="single" checked ="checked" id="single"<?php echo stickyRadio('status','single');?>>
				<p >Ich bin alleinerziehend</p>
			</div>
			<div class="singleOrCouple">
				<input type="radio" id="elternpaar" name="status" value="couple" <?php echo stickyRadio('status','couple');?>>
				<p class="singleOrCouple">Wir sind ein Elternpaar</p>
			</div>	
		</div>	
			<div id="partner_details">
				<h2 >Angaben zu Deinem Partner</h2>
				<ul>
					<li>Geschlecht</li>
					<li><select>
							<option name="partner_gender" value="male">männlich</option>
							<option name="partner_gender" value="female">weiblich</option>
						</select>
					</li>
					<li>Vorname*</li>
					<li><input type="text" name="partner_firstname" <?php echo stickyText('partner_firstname');?>></li>
					<li>Beruf*</li>
					<li><input type="text" name="partner_profession" <?php echo stickyText('partner_profession');?>></li>
				</ul>
			</div>
		</fieldset>	
		<fieldset class=" reg1 address">
			<h2>Eure Adresse</h2>
			 <ul id="user_adress">
				<li>Straße, Hausnummer*</li>
				<li id="street"><input type="text" name="street" value="<?php echo stickyText('street');?>"></li>
				<li><input class="houseNumber" type="text" name="number" value="<?php echo stickyText('number');?>"></li>
				<li>Postleitzahl, Ort*</li>
				<li id="PlZ"><input type="text" name="zip" value="<?php echo stickyText('zip');?>"></li>
				<li><input id="location" type="text" name="location" value="<?php echo stickyText('location');?>"></li>
			</ul>
		</fieldset>	
		<!--<span class="uk-button uk-button-success">weiter</span>	-->
		<input type="submit" name="step1" value="weiter" class="uk-button uk-button-success"/>			
	</form>
</div>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
    <script src="../ef_dummy/js/register.js"></script>
    <script> $('input[value="couple"]').click(
					function(){
							$('#partner_details').show();
					})
			$('input[value="single"]').click(
					function(){
							$('#partner_details').hide();
					})


    </script>
    <script>
    		//sets the height of the circles in the progress bar equal to the width
    		var liw = $('li.step').width();
				$('li.step').css({
    				'height': liw + 'px'
				});
			//enable fieldset with partner's particulars once the corresponding radio button is clicked

	</script>	
  </body>
</html>

