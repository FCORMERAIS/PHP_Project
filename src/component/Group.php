<?php   if(!isset($_COOKIE["name"]))
    {$connexion ="You are not connected";
  }else { 
    $connexion = 'Connected As ' . htmlspecialchars($_COOKIE["name"]) . ' !';
  }
  
  include "../asset/header.php";
  ?>
    <body class="corps">
        <header>
            <a class="logo" href="/PHPProject/src/component/Menu.php"><img src="me.jpg" alt="logo" height="50" width="50" ></a>
            <nav>
                <ul class="nav__links">
                    
                    <li><FONT size="6pt"><a href="#">Profil</a></FONT></li>
                    <li><FONT size="6pt"><a href="Group.php">Group</a></FONT></li>
                    <li><FONT size="6pt"><?php echo $connexion;?></FONT></li>

                </ul>
            </nav>
            <p class="tempo">h</p>
            <p class="menu cta">Contact</p>
            <p class="connect"><a href="Login.php">Sign in</a></p>
        </header>
        <div class="Activity">              
            <?php
                if ($connexion == "You are not connected") {
                    echo "YOU NEED TO BEE CONNECTED AND TO JOIN A GROUP FOR GET INFORMATION ON YOUR GROUP";
                }
            ?> 

        </div>


        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <div class="box2">
                    <a href="#m2-o3" class="btna">Add Member Group</a>
                    <div class="modal-container" id="m2-o3" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">Add a Member </h1>
                                <span class="input">
                                    <form method="POST" action="Menu.php">
                                    <input type="text" name="userAdd" placeholder="Please enter the pseudo or email">
                                    <input type="submit">
                                    </form>
                                    <span></span>	
                                </span>
                            <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
                <div class="box2">
                    <a href="#m2-o2" class="btna">View Group Members</a>
                    <div class="modal-container" id="m2-o2" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">LIST GROUP</h1>
                            <?php
                            require('listUser.php');
                            listUser();
                            ?>
                            <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
                <a class="btna" href="/PHPProject/AboutUS.php" style="margin-bottom: 20%;">About US</a>
                <div class="backpage">
                    <div class="box">
                        <a href="#m2-o4" class="link-12" id="m2-c4">CREATE GROUP</a>
                        <div class="modal-container" id="m2-o4" style="--m-background: hsla(0, 0%, 0%, .4);">
                            <div class="modal">
                            <h1 class="modal__title">ARE YOU SURE DO YOU WANT TO CREATE A GROUP ?</h1>
                            <p class="modal__text">If you create a group you will quit the group if you are already in a group.</p>
                            <?php
                                // if (""==1){  //TODO AJOUTER VERIFICATION PAR COOKIE DE LA CONNEXION
                                    ?>
                                    <form method="post" action="createGroups.php" id="stripe-login">
                                    <?php
                                // }
                            ?>
                            <input type="submit" class="modal__btn2" name="submit" value="YEAH IM SURE &rarr;">
                            <?php
                                // if (""==1){  //TODO AJOUTER VERIFICATION PAR COOKIE DE LA CONNEXION
                                    ?>
                                    </form>
                                    <?php
                                // }
                            ?>
                            <a href="#m2-c4" class="link-2"></a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <a href="#m2-o5" class="link-1" id="m2-c5">QUIT GROUP</a>
                        <div class="modal-container" id="m2-o5" style="--m-background: hsla(0, 0%, 0%, .4);">
                            <div class="modal">
                            <h1 class="modal__title">ARE YOU SURE TO QUIT GROUP ?</h1>
                            <p class="modal__text">if you quit the group you will loose all your point, if youre the captain the group will be dissolved !! SO ARE YOU SUR ??</p>
                            <?php
                                // if (""==1){  //TODO AJOUTER VERIFICATION PAR COOKIE DE LA CONNEXION
                                    ?>
                                    <form method="post" action="quitGroup.php" id="stripe-login">
                                    <?php
                                // }
                            ?>
                            <input type="submit" class="modal__btn" name="submit" value="YEAH IM SURE &rarr;">
                            <?php
                                // if (""==1){  //TODO AJOUTER VERIFICATION PAR COOKIE DE LA CONNEXION
                                    ?>
                                    </form>
                                    <?php
                                // }
                            ?>                            
                            <a href="#m2-c5" class="link-2"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="buttonpush.js"></script>
    </body>
</html>
