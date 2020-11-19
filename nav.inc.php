<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white">
    <div class="container">
        
        <!-- Center-aligned Brand --> 
        <a class="navbar-brand mx-auto" href="index.php">
            <img alt="LOGO" class="navbar-logo" src="images/logo_word.png">
        </a>

        <!-- Right-aligned Mobile Hamburger Menu -->
        <button class="navbar-toggler" id="navbar-toggler"
            type="button" 
            data-toggle="collapse" 
            data-target="#navbar" 
            aria-controls="navbar" 
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            
        <div class="navbar-collapse collapse" id="navbar">
            
            <!-- Left-aligned Nav Links --> 
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                        $link = '<a class="nav-link" href=';
                        if ($_SERVER['REQUEST_URI'] === "/" || $_SERVER['REQUEST_URI'] === "/index.php")
                        {
                            $link .= "#about";
                        }
                        else {
                            $link .= "index.php";
                        }
                        $link .= ">";
                        echo $link;
                        echo "About Us</a>";
                    ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="listings.php" data-toggle="dropdown">
                        Find Freelancers
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="listings.php">Front-End Developer</a>
                      <a class="dropdown-item" href="listings.php">Back-End Developer</a>
                      <a class="dropdown-item" href="listings.php">Full-Stack Developer</a>
                    </div>
                </li>
            </ul> 
            
            <!-- Right-aligned Nav Links -->
            <ul class="navbar-nav ml-auto">
    
                <!--  If user is logged in, provide link to profile -->
                <?php if (isset($_SESSION['display_name'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><?php echo $_SESSION["display_name"] ?></a>
                    </li>
                    
                <!--  Else, provide link to login -->
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="material-icons">login</i>Login</a> 
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="register.php"><i class="material-icons">account_circle</i>Register</a> 
                </li>
            </ul>
        </div>
    </div>
</nav>
