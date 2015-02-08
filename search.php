<?php
session_start(); 
$url = "../ef_dummy/search.php?logout=1";

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

?>
<!--navbar-->
 


            <div class="outerWrap">
                <div class="wrapperLeft">

                        <?php
                            $con = mysqli_connect('','root') or die("unable to connect to database");
                            mysqli_select_db($con, "elternfreund");
                            $sql = "SELECT * FROM users LEFT OUTER JOIN children ON users.child_id = children.id";
                            $res = mysqli_query($con, $sql);
                            $num = mysqli_num_rows($res);
                            echo "$num Datensätze gefunden";
                            while ($row = mysqli_fetch_assoc($res))
                                {      $birthday = $row['dob'];
                                       $age = date_create($birthday)->diff(date_create('today'))->y;
                                       
                                        echo '<a class="profilePanel" href="../ef_dummy/profile.php?id='.$row['user_id'].'">';
                                            echo '<div class="pp-photo"><img src="'.$row['profile_pic'].'" alt=""></div>';
                                            echo '<ul class="pp-textWrap">';
                                            echo '<ul class="pp-particulars">';
                                            echo '<li>'.$row['first_name'].' und '.$row['name']. ' '. '('.$age.')'.'</li>';
                                            echo '<li>Prenzlauer Berg</li>';
                                            echo '<li>'.$row['Status'].'</li>';
                                            echo '</ul>';
                                            echo '<p>'.$row['about_me'].'</p>';
                                            echo '</ul>';
                                        echo '</a>';

                                }?>




                        
                        
                </div>
                <div class="sidebarSearch">
                    <div id="accordion">
                              <h3><span class="uk-icon-map-marker"></span> Umkreissuche</h3>
                              <div>
                                    <form id="umkreis" action="">
                                        
                                        <input type="search" placeholder="Postleitzahl"></br>
                                        <label for="distance">Entfernung</label></br>
                                        <input type="range" id="distance">
                                    </form>
                              </div>
                              <h3><span class="uk-icon-calendar-o"></span>   Haeufigkeit der Betreuung</h3>
                              <div>
                                <input type="radio" id="gelegentlich"><label for="gelegentlich">gelegentlich</label></br>
                                <input type="radio" id="radio2"><label for="radio2">2-3x/Monat</label></br>
                                <input type="radio" id="radio3"><label for="radio3" checked>1-2x/Woche</label></br>
                                <input type="radio" id="radio4"><label for="radio4">2-1x/Woche</label>
                              </div>
                              <h3><span class="uk-icon-clock-o"></span><span class="accordionHeading">Betreuungszeiten</span></h3>
                              <div>
                                <input type="checkbox"> 08 - 10:00 Uhr</br>
                                <input type="checkbox"> 10 - 12:00 Uhr</br>
                                <input type="checkbox"> 12 - 14:00 Uhr</br>
                                <input type="checkbox"> 14 - 16:00 Uhr</br>
                                <input type="checkbox"> 16 - 18:00 Uhr</br>
                                <input type="checkbox"> 18 - 20:00 Uhr</br>
                                <input type="checkbox"> 20 - 22:00 Uhr</br>
                                
                              </div>
                    </div>   
                </div>
            </div>    
            </-->
   
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script>
        // navicon: toggle function
        var dropdown = $('.dropdown');
        var toggle = $('.uk-icon-navicon');
        $(toggle).click(function(){
            $(dropdown).toggleClass('visible');
        });
        // color change when hovering over profile previews
            var profilePanel = $('.profilePanel');
            $(profilePanel).hover(function(){
                    var text = $('.pp-particulars');
                    var letter = $('.pp-particulars li')
                    $(this).find(text).css('background','#E15258');
                    $(this).find(letter).css('color','white');        
                    },
                    function(){
                    var text = $('.pp-particulars');
                    var letter = $('.pp-particulars li');
                    $(this).find(text).css('background','white');
                    $(this).find(letter).css('color','rgb(80,80,80');
                    }
            );
     
        // accordion menu in the side bar
           $( "#accordion" ).accordion();

        // value output of html range slider 
            function outputUpdate(distance) {
            document.querySelector('#distance').value = distance;
            }

           
    </script>
    </body>
</html>