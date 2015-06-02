
<!-- HEAD AND NAVBAR -->
<?php 
session_start(); 

include('../ef_dummy/inc/overall/header.php');
echo "<br>";
$array_matchee = user_data('offer_type','48');
$array_user = user_data('offer_type','48');

for($i=1; $i<=21; $i++) {
                if(in_array($i, $array_user) && in_array($i, $array_matchee)) {
                    $out .= "yes, ";
                } else {$out .= "no, ";}
            }
            echo $out;
?>


<!-- profile picture and particulars concerning name, district, profession and frequency of requested childcare -->	
        	
            
            <div class="pp-container">
                <div class="nameTag"><?php user_data('first_name');?> und <?php user_data('child_name');?> (<?php get_age(); ?>)</div>
            	<ul class="photoAndPart">
                    <li id="photo"><img src="<?php user_data('profile_pic1');?>" alt="Mutter mit Kind"></li>
                    <ul class="containerParticulars">
                        <li><h3 id="nameTag"><?php user_data('first_name');?> und <?php user_data('child_name');?>(<?php get_age(); ?>)</h3></li>
                    	<li class="uk-icon-envelope" id class="test">   </li>
                        <li>Prenzlauer Berg</li>
                    	<li><?php user_data('Status')?></li>
                    	<li><?php user_data('profession')?></li>
                    	<li>sucht <?php user_data('frequency')?></li> 
                        <li>
                            <div id="Message">
                                <span class="buttonOrange uk-button" role="button">
                                    <a href="#msg_modal" data-uk-modal>Nachricht senden</a>
                                </span>
                                <a href="../ef_dummy/search.php" id="backToOverview">zurück zur Übersicht</a>
                            </div>
                        </li>
                        <li class="thumb"><img src="<?php user_data('profile_pic1');?>" alt="Mutter mit Kind"></li>
                        <li><img src="<?php user_data('profile_pic2');?>" alt="Kind"></li>
                        <li><img src="<?php user_data('profile_pic3');?>" alt="Mutter"></li>
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
                                <th>Mo</th>
                                <th>Di</th>
                                <th>Mi</th>
                                <th>Do</th>
                                <th>Fr</th>
                                <th>Sa</th>
                                <th>So</th>
                            </tr>
                        </table></li>
                    <li id="time-periods_1st_row">
                        <p>Sabine könnte Dein Kind zu folgenden Zeiten betreuen!</p>
                        <p>8-12 Uhr</p>
                    </li>
                    <li><table>
                            <tr>
                                <?php show_matches_html(1, 7, 'request'); ?>
                             </tr>
                        </table>   </li>

                    <li class="time_periods">12-16 Uhr</li>
                    <li><table> 
                              <tr>
                               <?php show_matches_html(8, 14, 'request'); ?>
                              </tr> 
                        </table></li>
                    <li class="time_periods">16-20 Uhr</li>
                    <li><table id="last_table">
                            <tr>
                              <?php show_matches_html(15, 21, 'request'); ?>
                             </tr>
                        </table>   </li>    
                </ul>
                
            </div>
            <div class="matchWrap">
                <ul class="test">
                    <li></li>
                    <li><table>
                            <tr>
                                <th>Mo</th>
                                <th>Di</th>
                                <th>Mi</th>
                                <th>Do</th>
                                <th>Fr</th>
                                <th>Sa</th>
                                <th>So</th>
                            </tr>
                        </table></li>
                    <li id="time-periods_1st_row">
                        <p>Du könntest das Kind von Sabine zu</br> folgenden Zeiten betreuen!</p>
                        <p>8-12 Uhr</p>
                    </li>
                    <li><table>
                            <tr>
                                <?php show_matches_html(1, 7, 'offer'); ?>
                             </tr>
                        </table>   </li>

                    <li class="time_periods">12-16 Uhr</li>
                    <li><table> 
                              <tr>
                                 <?php show_matches_html(8, 14, 'offer'); ?>
                              </tr> 
                        </table></li>
                    <li class="time_periods">16-20 Uhr</li>
                    <li><table id="last_table">
                            <tr>
                               <?php show_matches_html(15, 21, 'offer'); ?>
                             </tr>
                        </table>   </li>    
                </ul>
                
            </div>
            <!--
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
            </div>-->

               
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
            <?php include('../ef_dummy/inc/overall/footer.php'); ?>
         

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
    var send_msg = $('#Message');
    $(send_msg).on('click', function(){

    })     
    </script>
  </body>
</html>

	

