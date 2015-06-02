
<?php ob_start();

		if(!isset($_SESSION)) {
		session_start();
		}
		include('../ef_dummy/inc/header.php'); 
		include('../ef_dummy/inc/head.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
  	  	require_once('../ef_dummy/inc/config.php');
  	  	require_once('../ef_dummy/inc/functions.php');
  	  	image_crop_and_upload();
		form_step_process($db);

		echo "<pre>";
		//print_r($_SESSION['post']);
		print_r($_FILES['profile_pic1']);
		print_r($_FILES['profile_pic2']);
		print_r($_FILES['profile_pic3']);
		echo "</pre>";

?>
	<script src="../ef_dummy/js/Jcrop.js"></script>


<script>

$(document).ready(function () {
	$('#croppingModal').hide();
	var photoUpload = $('#photoUpload');
	$(photoUpload).on('change','input[type=file]', function() {
		$(this).hide().closest('ul').append('<button>hochladen</button>', '<button id="cancel_crop_modal">abbrechen</button>');
	});
	$('#photoUpload').on('click', 'button', function() {
		//e.preventDefault();
		$('#croppingModal').show();
		//return false;
	});
	//$(photoUpload).on('click', 'button', function(event) {
			//$('#croppingModal').show();

		//alert(crop_id);
		//$( "span:last" ).text( jQuery.data( div, "test" ).last );
	//});
	//$('#croppingModal').on('click', 'input[type="submit"]', function() {

		
		//$('#croppingModal').hide();
		//alert('test');	
	//});
		$(function(c) {
        		$('#cropbox').Jcrop({
        			aspectRatio: 4/3,
        			setSelect: [0,0,240,180],
        			onSelect: updateCoords,
        			onChange: updateCoords
        		});
    		});

			function updateCoords(c){
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);

			}
		/*jQuery(function($) {
        	$('#cropbox').Jcrop({
        		setSelect: [0,0,240,180],
        		aspectRatio: 240/180
        		});	
    	});/*
		var file_name = $(this).attr('name');
		$.post("crop.php", {uploaded: "yes", file_name: file_name}, function(data) {
			$('#cropbox').attr('src', 'data');
		});
	});
	$('#cancel_crop').on('click', function() {
		$('#croppingModal').hide();
		});*/
	
	
	});
</script>
	<div id="croppingModal">
		<div id="cropPic">
			<img id="cropbox" alt="cropbox" src="../ef_dummy/img/avatar1.jpg"/>
		</div>
		<div>
			<form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<button id="cancel_crop" class="uk-button uk-button-primary">abbrechen</button>
				<input type="hidden" id="x" name="x"/>
				<input type="hidden" id="y" name="y"/>
				<input type="hidden" id="w" name="w"/>
				<input type="hidden" id="h" name="h"/>	
				<input type="submit" name="crop" value="zuschneiden" id ="crop_btn" class="uk-button uk-button-primary"/>
			</form>
		</div>	
	</div>
<form id="Child" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<fieldset class="myChild">
			<?php error_msg();?>
		<ul class="childParticulars">
			<li>mein Kind heißt*</li>
			<li><input type="text" name="child_name" value="<?php echo stickyText('child_name');?>"></input></li>
			<li>und ist ein*</li>	
			<li><select name="child_gender">
					<option name="child_gender" value="boy">Junge</option>	
					<option name="child_gender" value="girl">Mädchen</option>			
				</select>
			</li>
			<li>es wurde geboren am*</li>
			<li><input type="date" name="child_dob" value="<?php echo stickyText('child_dob');?>"></input></li>
			<li>über mein Kind</li>
			<li><textarea placeholder="Hier kannst Du über Dein Kind aus dem Nähkästchen plaudern. Ist Dein Kind eher ruhig oder lebhaft? Hat es besondere Hobbies oder Lieblingsfächer in der Schule?" name="about_child"><?php echo stickyText('about_child');?></textarea></li>
		</ul>
	<!--<form role="form">-->
         <!-- <input id="sample_input" type="hidden" name="profilepic[]">-->
		</fieldset>		

		<h4 class="photoInstruct">Lade jetzt bitte noch mit einem Klick auf die Beispielbilder drei Fotos hoch!</h4>
		<ul id="photoUpload">
			<ul id="xy">
				<li>1. Eltern-Kind-Foto*</li>
				<li><img src="<?php profile_img_prev("1"); ?>"></li>
				<input type="file" name="profile_pic1"/>
			</ul>
			<ul>		
				<li>2. Foto von Deinem Kind </li>
				<li><img src="<?php profile_img_prev("2"); ?>"></li>
				<input type="file" name="profile_pic2"/>
			</ul>
			<ul>	
				<li>Foto von Dir/Euch</li>
				<li><img src="<?php profile_img_prev("3"); ?>"></li>
				<input type="file" name="profile_pic3"/>
			</ul>
		</ul>	
	<input type="submit" name="step2" value="weiter" class="uk-button uk-button-success"/>	
	<button class="uk-button uk-button-primary" id="addChild">Kind hinzufügen</button>
	<h4 id="addChild"></h4>
	<a href="../ef_dummy/register.php"><span class=uk-icon-angle-double-left></span></a>
</form>

	</body>
</html>

