<!DOCTYPE html>
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
            <p class="connect">Sign In</p>
        </header>
            <div class="Corps">
                <h1 class="title"> ABOUT US : </h1>
                <div class="container">
                    <div class="card">
                        <div class="card-front1"></div>
                        <div class="card-back">
                            <h2>Flavio CORMERAIS<br><span>Senior Developper</span></h2>
                            <div class="social-icons">
                                <a href="#"  class="github" aria-hidden="true"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-front2"></div>
                        <div class="card-back">
                            <h2>Marius BOURSE<br><span>Senior Developper</span></h2>
                            <p>have made the</p>
                            <div class="social-icons">
                                <a href="#"  class="github" aria-hidden="true"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-front3"></div>
                        <div class="card-back">
                            <h2>Medhi ARROUSSI<br><span>Senior Developper</span></h2>
                            <div class="social-icons">
                                <a href="#"  class="github" aria-hidden="true"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a  href="#">Add Member Group</a>
                <a  href="#">View Group Members</a>
                <a  href="/PHPProject/AboutUS.php">About US</a>
                <div class="box">
                    <a href="#m2-o" class="link-1" id="m2-c">QUIT GROUP</a>
                    <div class="modal-container" id="m2-o" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                        <h1 class="modal__title">ARE YOU SURE TO QUIT GROUP ?</h1>
                        <p class="modal__text">if you quit the group you will loose all your point, if youre the captain the group will be dissolved !! SO ARE YOU SUR ??</p>
                        <button class="modal__btn">YEAH IM SURE &rarr;</button>
                        <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="buttonpush.js"></script>
    </body>
</html>
