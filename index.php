<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <header class="jumbotron text-center" id='index-jumbotron'>
            <h1 class="display-4">Talent on Demand.</h1> 
            <p class="lead">The future of recruiting is here.</p>
            <a class="red-button" href="register.php">Create a free account</a>
            <a class="red-button" href="about.php">Find out more</a>
            <form id="searchBar" action="#">
                <div class="form-group">
                    <input class="form-control border border-dark" type="search" placeholder="Search for talents" aria-label="Search">
                </div>
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </header>
        <main class="container">
            <section id="welcome" data-aos="fade-down">
                <h1>Welcome</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dolor purus non enim praesent. A diam sollicitudin tempor id eu. Cursus vitae congue mauris rhoncus aenean. Feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Faucibus nisl tincidunt eget nullam non nisi est sit. Lacinia at quis risus sed vulputate odio. Quis viverra nibh cras pulvinar. Eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum. Tortor vitae purus faucibus ornare suspendisse sed nisi lacus sed. Rutrum tellus pellentesque eu tincidunt tortor aliquam. Mauris rhoncus aenean vel elit scelerisque mauris. Semper viverra nam libero justo laoreet sit amet cursus. Pellentesque eu tincidunt tortor aliquam. Mauris pellentesque pulvinar pellentesque habitant. Habitant morbi tristique senectus et netus et. Arcu odio ut sem nulla pharetra diam. Nec feugiat nisl pretium fusce id. Purus in mollis nunc sed id semper risus. Morbi tristique senectus et netus et malesuada fames. Vel facilisis volutpat est velit egestas dui id ornare. Felis eget velit aliquet sagittis id consectetur purus. Egestas sed sed risus pretium quam vulputate dignissim suspendisse. Sit amet venenatis urna cursus eget nunc scelerisque. Porttitor rhoncus dolor purus non. Cras fermentum odio eu feugiat. Bibendum enim facilisis gravida neque convallis a. Pellentesque diam volutpat commodo sed egestas. Ac auctor augue mauris augue neque. Nulla aliquet enim tortor at auctor. Eros donec ac odio tempor orci dapibus. Mattis nunc sed blandit libero volutpat sed. A diam maecenas sed enim ut sem viverra aliquet. Semper quis lectus nulla at volutpat. Ipsum suspendisse ultrices gravida dictum fusce. Tempor id eu nisl nunc mi ipsum faucibus. Tincidunt lobortis feugiat vivamus at augue eget. Mauris sit amet massa vitae tortor condimentum lacinia. Integer enim neque volutpat ac tincidunt vitae. In vitae turpis massa sed elementum tempus. In hac habitasse platea dictumst vestibulum rhoncus. Volutpat consequat mauris nunc congue. Lectus vestibulum mattis ullamcorper velit. Commodo elit at imperdiet dui accumsan sit amet. Ac felis donec et odio pellentesque diam. Tempor nec feugiat nisl pretium fusce id velit. Pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies. Vitae congue eu consequat ac felis donec et odio pellentesque. Enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Odio ut enim blandit volutpat maecenas volutpat blandit. Urna et pharetra pharetra massa massa ultricies mi. Aliquet nibh praesent tristique magna. Quam nulla porttitor massa id neque aliquam. Viverra nibh cras pulvinar mattis nunc sed. Lacinia at quis risus sed vulputate odio ut. Aenean et tortor at risus viverra adipiscing at in tellus. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Sit amet nulla facilisi morbi. Purus sit amet luctus venenatis lectus magna. Sed pulvinar proin gravida hendrerit lectus. Viverra vitae congue eu consequat ac. Mi eget mauris pharetra et ultrices neque ornare. Neque volutpat ac tincidunt vitae semper quis lectus nulla. Praesent semper feugiat nibh sed. Faucibus scelerisque eleifend donec pretium vulputate. A condimentum vitae sapien pellentesque habitant morbi tristique senectus. Est lorem ipsum dolor sit amet. Suspendisse ultrices gravida dictum fusce ut placerat orci nulla. Vitae congue eu consequat ac felis donec et. Quis vel eros donec ac odio tempor orci. Metus aliquam eleifend mi in nulla posuere. Ultricies mi eget mauris pharetra et ultrices neque ornare aenean. Vitae et leo duis ut diam quam nulla porttitor massa. Vel facilisis volutpat est velit egestas dui id ornare arcu. Aliquet risus feugiat in ante metus. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget. Nunc non blandit massa enim nec dui. Fermentum et sollicitudin ac orci phasellus. Cras sed felis eget velit aliquet sagittis. Pretium vulputate sapien nec sagittis aliquam malesuada bibendum. Cras semper auctor neque vitae tempus quam pellentesque nec. Quam viverra orci sagittis eu. Purus non enim praesent elementum facilisis leo.</p>
            </section>
            <section id="about" data-aos="fade-down">
                <?php
                    include "about.php";
                ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>
