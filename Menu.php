<?php session_start()?>

</script>
<!DOCTYPE php>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Navbar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css.php">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head>
    <body class="corps">
        <header>
            <a class="logo" href="/PHPProject/Menu.php"><img src="php-logo.jpg" alt="logo" height="50" width="50" ></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="#">Profil</a></li>
                    <li><a href="#">Group</a></li>
                </ul>
            </nav>
            <p class="tempo">h</p>
            <p class="menu cta">Contact</p>
            <p class="connect"><a href="Login.php">Sign in</a></p>
        </header>
            <h1 class="title">WELCOME TO TASKMANAGER </h1>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <div class="box2">
                    <a href="#m2-o3" class="btna">Add Member Group</a>
                    <div class="modal-container" id="m2-o3" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">Add a Member </h1>
                                <span class="input">
                                    <input type="text" placeholder="Please enter the pseudo or email">
                                    <button onclick="clickMe()">Send</button>
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
                            <button class="modal__btn">YEAH IM SURE &rarr;</button>
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
<script>
    function clickMe(){
    var result ="<?php addUser(); ?>"
    document.write(result);
}