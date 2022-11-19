<div class="overlay"style="z-index: 50;">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <div class="box2">
                    <a href="#m2-o3" class="btna">Add Member Group</a>
                    <div class="modal-container" id="m2-o3" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">Add a Member </h1>
                            </br></br></br>
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
                <script type="text/javascript" src="buttonpush.js"></script>
                <div class="box2">
                    <a href="#m2-o2" class="btna">View Group Members</a>
                    <div class="modal-container" id="m2-o2" style="--m-background: hsla(0, 0%, 0%, .4);">
                        <div class="modal">
                            <h1 class="modal__title2">LIST GROUP</h1>
                            </br></br></br>
                            <div class="listName">
                                <?php
                                require('listUser.php');
                                listUser();
                                ?>
                            </div>
                            <a href="#m2-c" class="link-2"></a>
                        </div>
                    </div>
                </div>
                <a class="btna" href="/PHPProject/src/component/AboutUS.php" style="margin-bottom: 20%;">About US</a>
                <div class="backpage">
                    <div class="box">
                        <a href="#m2-o4" class="link-12" id="m2-c4">CREATE GROUP</a>
                        <div class="modal-container" id="m2-o4" style="--m-background: hsla(0, 0%, 0%, .4);">
                            <div class="modal">
                            <h1 class="modal__title">ARE YOU SURE, DO YOU WANT TO CREATE A GROUP ?</h1>
                            <p class="modal__text">If you create a group you will quit the group that you are in. </p><p class="modal__text">Please enter a group name and click on cre ate group</p>
                            </br></br>
                            <p class="redInfo2">
                            <?php
                                if (!isset($_COOKIE["name"])){
                                    echo "VOUS DEVEZ VOUS CONNECTER POUR POUVOIR CREER UN GROUPE";
                                }else {
                                    echo '<form method="post" action="../func/createGroups.php" id="stripe-login"><input type="text" name="NameGroup" value="NameGroup"><input type="submit" class="modal__btn2" name="submit" value="YEAH IM SURE &rarr;"></form>';
                                }   
                            ?>
                            </p>
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
                            </br>
                            <form method="post" action="../func/quitGroup.php" id="stripe-login">
                            <p class="redInfo2">
                            <?php
                                if (!isset($_COOKIE["name"])){
                                    echo "VOUS DEVEZ VOUS CONNECTEZ POUR POUVOIR QUITTER UN GROUPE";
                                }else {
                                    echo '<input type="submit" class="modal__btn" name="submit" value="YEAH IM SURE &rarr;">                                    ';
                                }
                            ?>
                            </p>
                            <a href="#m2-c5" class="link-2"></a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>