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
if(/*empty($missing) && */isset($_POST['step3'])){
		foreach($_POST as $key => $value){
				if(!empty($value)){
						$_SESSION['post'][$key] = $_POST[$key];
										}
	}
	
	header("Location: http://localhost/ef_dummy/register4.php");
	exit();
}




?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<fieldset>
		<ul id="frequency">
			<li>
				<p>Ich suche und biete Kinderbetreuung</p>
			</li>
			<li>
				<select>
					<option>gelegentlich</option>
					<option>2-3x/Monat</option>
					<option>1-2x/Woche</option>
					<option>2-3x/Woche</option>
				</select>
			</li>
		</ul>
				<div class="flexibility">	
					<input type="radio" name="flexibility" value="flexible" checked="checked"><p>Was die Termine und Tageszeiten angeht, bin ich flexibel.</p>
				</div>
				<div class="flexibility">
					<input type="radio" name="flexibility" value="inflexible"><p>Ich suche jemanden, der mein Kind zu folgenden Zeiten betreut:</p>
				</div>
				<div class="available">
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
							<td><input type="checkbox" name="request#1" value="1"></td>
							<td><input type="checkbox" name="request#2" value="1"></td>
							<td><input type="checkbox" name="request#3" value="1"></td>
							<td><input type="checkbox" name="request#4" value="1"></td>
							<td><input type="checkbox" name="request#5" value="1"></td>
							<td><input type="checkbox" name="request#6" value="1"></td>
							<td><input type="checkbox" name="request#7" value="1"></td>
						</tr>
						<tr>
							<td>12-16 Uhr</td>
							<td><input type="checkbox" name="request#8" value="1"></td>
							<td><input type="checkbox" name="request#9" value="1"></td>
							<td><input type="checkbox" name="request#10" value="1"></td>
							<td><input type="checkbox" name="request#11" value="1"></td>
							<td><input type="checkbox" name="request#12" value="1"></td>
							<td><input type="checkbox" name="request#13" value="1"></td>
							<td><input type="checkbox" name="request#14" value="1"></td>
						</tr>
						<tr>
							<td>16-20 Uhr</td>
							<td><input type="checkbox" name="request#15" value="1"></td>
							<td><input type="checkbox" name="request#16" value="1"></td>
							<td><input type="checkbox" name="request#17" value="1"></td>
							<td><input type="checkbox" name="request#18" value="1"></td>
							<td><input type="checkbox" name="request#19" value="1"></td>
							<td><input type="checkbox" name="request#20" value="1"></td>
							<td><input type="checkbox" name="request#21" value="1"></td>

						</tr>
					</table>
					<h3>
					...und könnte selbst dafür das Kind meines Childcare-Buddys zu folgenden Zeiten betreuen:
					</h3>

				</div>		
				
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
						<td><input type="checkbox" name="o#1" value="1"></td>
						<td><input type="checkbox" name="o#2" value="1"></td>
						<td><input type="checkbox" name="o#3" value="1"></td>
						<td><input type="checkbox" name="o#4" value="1"></td>
						<td><input type="checkbox" name="o#5" value="1"></td>
						<td><input type="checkbox" name="o#6" value="1"></td>
						<td><input type="checkbox" name="o#7" value="1"></td>
					</tr>
					<tr>
						<td>12-16 Uhr</td>
						<td><input type="checkbox" name="o#8" value="1"></td>
						<td><input type="checkbox" name="o#9" value="1"></td>
						<td><input type="checkbox" name="o#10" value="1"></td>
						<td><input type="checkbox" name="o#11" value="1"></td>
						<td><input type="checkbox" name="o#12" value="1"></td>
						<td><input type="checkbox" name="o#13" value="1"></td>
						<td><input type="checkbox" name="o#14" value="1"></td>
					</tr>
					<tr>
						<td>16-20 Uhr</td>
						<td><input type="checkbox" name="o#15" value="1"></td>
						<td><input type="checkbox" name="o#16" value="1"></td>
						<td><input type="checkbox" name="o#17" value="1"></td>
						<td><input type="checkbox" name="o#18" value="1"</td>
						<td><input type="checkbox" name="o#19" value="1"></td>
						<td><input type="checkbox" name="o#20" value="1"></td>
						<td><input type="checkbox" name="o#21" value="1"></td>

					</tr>
				</table>
	</fieldset>
	<!--<a href="../ef_dummy/register4.php"><span class="uk-button uk-button-success">weiter</span></a>-->
	<!--<a href="../ef_dummy/register2.php"><span class=uk-icon-angle-double-left></span></a>-->
	<input type="submit" name="step3" value="weiter"/>	
</form>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="jquery.fittext.js"></script>
    <script src="../ef_dummy/js/uikit.min.js"></script>
    <script> $('input[name="flexibility"]').click(function(){
            if($(this).attr("value")=="inflexible"){
                $(".available").show();
            }  else
                {$(".available").hide();
                }
            });
    </script>
    <script>$('.regSteps>li>span').removeClass('active');
	$('.regSteps>li:nth-of-type(3)>span').addClass('active');
	</script>
</body>
</html>