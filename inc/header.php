   <!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width" charset="UTF-8">
        <link rel="stylesheet" href="../ef_dummy/css/uikit.min.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="../ef_dummy/css/custom.css" />

        
        <script src="uikit.min.js"></script>
    </head>
    <body>
   <div class="nav-wrap">   
	  <nav>
            <ul class="container">
                <a id="logo" href="../ef_dummy/search.php"><img src="docs/images/elternfreund_logo.svg" alt="Logo"></a>
                <a class="uk-icon-navicon flex"></a>
                
                <a href="#login" class="li_large" data-uk-modal>Login</a>
            </ul>
       </nav>
<!-- dropdown menu for mobile navigation-->
        <ul class="dropdown">
          <li class="dropdown-item"><span class="uk-icon-user"></span>Login</li>
          <li class="dropdown-item"><span class="uk-icon-search"></span>Suche</li>
        </ul>
<!--Login Window -->
        <div id="login" class="uk-modal">
           <div class="uk-modal-dialog">
           <h2>Login<a class="uk-modal-close uk-close"></a></h2>
           
                <div class="modalWrap">
                   <h4><span class="uk-icon-facebook"></span>Mit Facebook anmelden</h4>
                   <h3>oder mit E-Mail-Adresse anmelden</h3>
                   <input type="email" size="20" placeholder="E-Mail">   
                   <input type="password" size="20" placeholder="Passwort"> 
                   <p id="forgotPassword">Passwort vergessen?</p>
                   <form method="POST" action="profile.php">
    					<input type="submit" value="login" name="login">
    			   </form>	
                  <!-- <h4>Login</h4>-->

                   <div id="loggedin">  
                      <input type="checkbox"><p id="angemeldet">angemeldet bleiben</p>
                   </div> 
                   <div id="register">
                   <p id="registerHere">Noch nicht registriert?</p>
                   <p id="registerNow">Jetzt kostenlos registrieren!</p>
                    </div>
                        
                </div>
            </div> 
        </div>-->

</div>
    </div>
