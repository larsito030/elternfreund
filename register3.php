<?php ob_start();
	if(!isset($_SESSION)) {
		session_start();
		}
		
	  	include('../ef_dummy/inc/header.php'); 
	  	include('../ef_dummy/inc/multistep.php'); 
	  	require_once('appvars.php');
  	  	require_once('connectvars.php');
		include('../ef_dummy/inc/header.php'); 

	  //	require_once('../ef_dummy/inc/config.php');
  	    require_once('../ef_dummy/inc/functions.php');
  	    require_once('../ef_dummy/inc/config.php');


form_step_process($db); 	



?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<fieldset>
		<?php error_msg();?>
		<ul id="frequency">
			<li>
				<p>Ich suche und biete Kinderbetreuung</p>
			</li>
			<li>
				<select name="frequency">
					<option value = "gelegentlich">gelegentlich</option>
					<option value = "2-3x/Monat">2-3x/Monat</option>
					<option value = "1-2x/Woche">1-2x/Woche</option>
					<option value = "2-3x/Woche">2-3x/Woche</option>
				</select>
			</li>
		</ul>
				<div class="flexibility">	
					<input type="radio" name="flexibility" value="flexible" checked="checked"><p>Was die Termine und Tageszeiten angeht, bin ich flexibel.</p>
				</div>
				<div class="flexibility">
					<input type="radio" name="flexibility" value="inflexible"><p>Ich suche jemanden, der mein Kind zu folgenden Zeiten betreut:</p>
				</div>
				<div id="pick_dates">
						<!--<div class="available">-->
							<table class="available">
								<tr>
									<th></th>
									<th>Mo</th>
									<th>Di</th>
									<th>Mi</th>
									<th>Do</th>
									<th>Fr</th>
									<th>Sa</th>
									<th>So</th>
								</tr>
								<tr>
									<td>8-12 Uhr</td>
									<?php get_form_html(1, 8, 'request'); ?>
								</tr>
								<tr>
									<td>12-16 Uhr</td>
									<?php get_form_html(9, 16, 'request'); ?>
								</tr>
								<tr>
									<td>16-20 Uhr</td>
									<?php get_form_html(17, 24, 'request'); ?>
								</tr>
							</table>
							<h3>
							...und könnte selbst dafür das Kind meines Childcare-Buddys zu folgenden Zeiten betreuen:
							</h3>

						<!--</div>		-->
						
						<table class="available">
							<tr>
								<th></th>
								<th>Mo</th>
								<th>Di</th>
								<th>Mi</th>
								<th>Do</th>
								<th>Fr</th>
								<th>Sa</th>
								<th>So</th>
							</tr>
							<tr>
								<td>8-12 Uhr</td>
								<?php get_form_html(1, 8, 'offer'); ?>
							</tr>
							<tr>
								<td>12-16 Uhr</td>
								<?php get_form_html(9, 16, 'offer'); ?>
							</tr>
							<tr>
								<td>16-20 Uhr</td>
								<?php get_form_html(17, 24, 'offer'); ?>
							</tr>
						</table>
				</div>
	</fieldset>
	<!--<a href="../ef_dummy/register4.php"><span class="uk-button uk-button-success">weiter</span></a>-->
	<input type="submit" name="step3" class="uk-button uk-button-success"/>
	<a href="../ef_dummy/register2.php"><span class=uk-icon-angle-double-left></span></a>
	
</form>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
    <script> 	
				$('input[value="inflexible"]').click(
					function(){
							$('#pick_dates').show();
					})
				$('input[value="flexible"]').click(
					function(){
							$('#pick_dates').hide();
					})



    			
    </script>
    <script>$('.regSteps>li>span').removeClass('active');
	$('.regSteps>li:nth-of-type(3)>span').addClass('active');
	</script>
</body>
</html>