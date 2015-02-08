
<!-- HEAD AND NAVBAR -->
<?php 
session_start(); 
$url = "../ef_dummy/profile.php?logout=1";

if(isset($_POST["login"])) {
    $_SESSION['user'] = "user";
    }

if(isset($_SESSION['user']))  {

    include('../ef_dummy/inc/headerli.php');
} else {

    include('../ef_dummy/inc/header.php');
}

if(isset($_GET["logout"])) {
    
    session_destroy();}

$user_id = $_GET["id"];


$con = mysqli_connect('','root') or die("unable to connect to database");
                            mysqli_select_db($con, "elternfreund");
                            $sql = "SELECT * FROM users LEFT OUTER JOIN children ON users.child_id = children.child_id WHERE user_id = '$user_id'";
                            $res = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($res);


?>

<!-- profile picture and particulars concerning name, district, profession and frequency of requested childcare -->	
        	
            
            <div class="pp-container">
                <div class="nameTag"><?php echo $row['first_name'].' und '.$row['name'].'(4)'.'</div>';?>
            	<ul class="photoAndPart">
                    <li id="photo"><img src="<?php echo $row['profile_pic'];?>" alt="Mutter mit Kind"></li>
                   
                    
                    <ul class="containerParticulars">
                        <li><h3 id="nameTag">Sabine und Anja(4)</h3></li>
                    	<li class="uk-icon-envelope" id class="test">   </li>
                        <li>Prenzlauer Berg</li>
                    	<li><?php echo $row['Status'];?></li>
                    	<li><?php echo $row['profession'];?></li>
                    	<li>sucht 2-3x/Woche</li> 
                        <li><div id="Message"><span class="buttonOrange" role="button">Nachricht senden</span><a href="../ef_dummy/search.php" id="backToOverview">zurück zur Übersicht</a></div></li>
                        <li class="thumb"><img src="../ef_dummy/img/fake3.jpg" alt="Mutter mit Kind"></li>
                        <li><img src="../ef_dummy/img/kind.jpg" alt="Kind"></li>
                        <li><img src="../ef_dummy/img/mutter.jpg" alt="Mutter"></li>
                    </ul>   
                
            	</ul>
            </div>	
<!-- section where the matches are being displayed with checkmarks -->
        </br>
            <div class="matchWrap">
                <ul class="test">
                    <li><h2>Euer Matching</h2></li>
                    <li><table>
                            <tr>
                                <th>08:00</th>
                                <th>10:00</th>
                                <th>12:00</th>
                                <th>14:00</th>
                                <th>16:00</th>
                                <th>18:00</th>
                                <th>20.00</th>
                            </tr>
                        </table></li>
                    <li><p>Sabine könnte Dein Kind von 12-16:00 Uhr betreuen</p></li>
                    <li><table>
                            <tr>
                                 <td></td>
                                 <td></td>
                                 <td><span class="uk-icon-check-circle"></span></td>
                                 <td><span class="uk-icon-check-circle"></span></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                             </tr>
                        </table>   </li>

                    <li>Du könntest das Kind von Sabine von 16-18Uhr betreuen </li>
                    <li><table> 
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><span class="uk-icon-check-circle"></span></td>
                                 <td></td>
                                 <td></td>
                              </tr> 
                        </table></li>
                </ul>
                
            </div>
            <div class="matchWrap" id="daysofWeek">
                <ul class="test">
                    <li></li>
                    <li><table>
                            <tr>
                                <th class="wd">Mo</th>
                                <th class="wd">Di</th>
                                <th class="wd">Mi</th>
                                <th class="wd">Do</th>
                                <th class="wd">Fr</th>
                                <th class="wd">Sa</th>
                                <th class="wd">So</th>
                            </tr>
                        </table></li>
                    <li><p>...und zwar an folgenden Tagen:</p></li>
                    <li><table>
                            <tr>
                                 <td></td>
                                 <td></td>
                                 <td><span class="uk-icon-check-circle"></span></td>
                                 <td><span class="uk-icon-check-circle"></span></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                             </tr>
                        </table>   </li>
                </ul>
            </div>

               
            </div> 
            </br>
<!-- The textareas where information about "what I'm looking for", "about me" and "about my child gets" shown.-->
            <div class="container_aboutMe">
                <div class="textBox">
                    <h3> Was ich hier suche</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>  
                <div class="textBox">
                    <h3>Über mich</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>  
                <div class="textBox">  
                    <h3>Über mein Kind</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>      
            </div>
            <?php include('../ef_dummy/inc/footer.php'); ?>
         

     <script> 
     // showing the matching results for days in the week when hovering over comment field
     $('#daysofWeek').hide();
              $('.test>li:nth-of-type(3), .test>li:nth-of-type(5)').hover(function(){
                $('#daysofWeek').show();
     }, function(){
                $('#daysofWeek').hide();
     });

    // changing image url to thumbnail url on hover          
     $('.containerParticulars img').hover(function(){
         var image = $(this).attr('src');
        $('#photo>img').attr('src', image).width('425px').heigth('282px');  
        });       
    </script>
  </body>
</html>

	

