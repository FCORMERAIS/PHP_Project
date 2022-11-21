<header>
            <a class="logo" href="/PHPProject/src/component/Menu.php"><img src="../../assets/tinylogo.png" alt="logo" height="75" width="75" ></a>
            <nav>
                <ul class="nav__links">  
                    <li><FONT size="6pt" style="color: rgba(0, 136, 169, 0.8);"><?php echo $connexion;?></FONT></li>
                    <li><FONT size="6pt" style="color: rgba(0, 136, 169, 0.8);"><?php if (isset($_COOKIE["name"])){
                        $sqlQuery = 'SELECT * FROM user WHERE Name = :name';
                        $user = $db->SQLREQUEST($sqlQuery,$_COOKIE["name"],"fetch"); 
                        if ($user["idGroup"] != "") {
                            $sqlQuery = 'SELECT * FROM groups WHERE id = :idGroup ';
                            $user = $db->SQLREQUEST($sqlQuery,$user["idGroup"],"fetch");
                            echo "Score : ".$user["score"];
                        }
                    }?></FONT></li>
                </ul>
            </nav>
            <p class="tempo">h</p>
            <p class="menu cta">Contact</p>
            <?php
                if(isset($_COOKIE["name"])) {
                    echo '<p class="connect"><a href="../func/Actions.php?post=deco">Disconnect</a></p>';
                }else {
                    echo '<p class="connect"><a href="../component/Login.php">Login</a></p>';
                }
            ?>
        </header>