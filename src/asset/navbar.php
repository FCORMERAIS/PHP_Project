<header>
            <a class="logo" href="/PHPProject/src/component/Menu.php"><img src="../../assets/tinylogo.png" alt="logo" height="75" width="75" ></a>
            <nav>
                <ul class="nav__links">  
                    <li><FONT size="6pt"><a href="#">Profil</a></FONT></li>
                    <li><FONT size="6pt"><a href="Group.php">Group</a></FONT></li>
                    <li><FONT size="6pt"style="color: rgba(0, 136, 169, 0.8);"><?php echo $connexion;?></FONT size="6pt"></li>
                </ul>
            </nav>
            <p class="tempo">h</p>
            <p class="menu cta">Contact</p>
            <?php
                if(isset($_COOKIE["name"])) {
                    echo '<p class="connect"><a href="../func/deco.php">Disconnect</a></p>';
                }else {
                    echo '<p class="connect"><a href="../component/Login.php">Login</a></p>';
                }
            ?>
        </header>