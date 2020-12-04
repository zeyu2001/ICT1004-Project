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
        <header>
            <div class="jumbotron col-md-12" id='index-jumbotron'>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 order-md-1 order-2">
                            <div>
                                <h1 class="display-4 landing-title">Talent on Demand.</h1> 
                            </div>
                            <p class="lead">The future of recruiting is here.</p>
                            <a class="red-button" href="register.php">Create a free account</a>
                            <a class="red-button" href="#about">Find out more</a>
                            <form id="searchBar" class="containter" action="listings.php?" method="get">
                                <div class="form-group mx-auto">
                                    <input class="form-control border border-dark" name="query" type="search" placeholder="Search for talents" aria-label="Search"
                                           pattern="^[a-zA-Z0-9\s\.\-,!?]*$">
                                </div>
                                <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col-md-6 order-md-2 order-1">
                            <img id="landing-img" class="mx-auto d-block" src="images/undraw_feeling_proud.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <main>
            <section id="about">
                <div class="parallax parallax-work">
                    <div class="caption">
                        <div class="inside-caption"><h1>About Us</h1></div>
                    </div>
                </div>
                <div class="container">
                    <p class="citation">
                        Photo by 
                        <a href="https://unsplash.com/@martenbjork?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Marten Bjork
                        </a> on 
                        <a href="https://unsplash.com/s/photos/work?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Unsplash
                        </a>
                    </p>
                    <div class="row align-items-center" data-aos="fade-down">
                        <div class="col-md-8 order-md-1 order-2">
                            <div class="landing-segment">
                                <h2 class="landing-heading text-center">For Employers</h2>
                                <p>
                                    In the fast-paced, hyper-competitive tech scene today, there is no room for slow recruitment processes. 
                                    Create a profile, find great matches, and connect instantly.
                                    Join us to leverage on our fast-growing network of global talent to suit your project's needs.
                                    Our team of experienced developers boast a wealth of experience from past roles in major companies including Google, Facebook and Microsoft.
                                    We are confident that they can meet your needs.
                                </p>
                            </div>
                            <div class="landing-segment">
                                <h2 class="landing-heading text-center">For Freelancers</h2>
                                <p>
                                    No applications, no cover letters. If you are a freelancer looking for opportunities, 
                                    we can easily connect you with companies you love. Our network has connected over 1200 freelancers 
                                    and businesses in just the last 3 months. Join today and leverage on our global network of employers
                                    to find great jobs, anywhere in the world.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 order-md-2 order-1">
                            <img class="side-img mx-auto d-block" src="images/undraw_interview.svg" alt="">
                        </div>
                    </div>
                    <div class='row align-items-center pb-5' data-aos="fade-down">
                        <div class='col-md-3 order-md-1 order-2'>
                            <img class="side-img mx-auto d-block rounded-circle" src="images/zeyu.jpg" alt="Zeyu">
                        </div>
                        <div class='col-md-9 order-md-2 order-1'>
                            <blockquote class="blockquote">
                                <i class='material-icons flip-horizontal red-icon large-icon'>format_quote</i>
                                <p class="mb-0">
                                    This is what recruiting should look like. 
                                    ManyHires provides a stress-free environment where I can choose from companies
                                    I love. With the diverse range of companies and projects from all around the world,
                                    I have been able to work on projects that I have never dreamed of before.
                                </p>
                                <footer class="blockquote-footer">
                                    Zhang Zeyu, Software Engineer
                                </footer>
                            </blockquote>
                        </div>
                        
                    </div>
                </div>
            </section>
            
            <section id="mission">
                <div class="parallax parallax-rooftop">
                    <div class="caption">
                        <div class="inside-caption"><h1>Our Mission</h1></div>
                    </div>
                </div>
                <div class="container">
                    <p class="citation">
                        Photo by 
                        <a href="https://unsplash.com/@avirichards?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Avi Richards
                        </a> on 
                        <a href="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Unsplash
                        </a>
                    </p>
                    <div class="row align-items-center" data-aos="fade-down">
                        <div class="col-md-4 order-md-1 order-2">
                            <img class="side-img mx-auto d-block" src="images/undraw_profile.svg" alt="">
                        </div>
                        <div class="col-md-8 order-md-2 order-1">
                            <div class="landing-segment">
                                <h2 class="landing-heading text-center">The Future of Recruiting</h2>
                                <p>
                                    ManyHires is a service that connects freelance tech talent to companies, 
                                    by providing freelancers a dedicated platform for them to advertise their area of expertise. 
                                    The aim is to speed up the hiring process, and offer a new way to adapt to rapidly changing needs. 
                                    Freelancers bring with them a wealth of experience from working with different teams on unique projects. 
                                    With ManyHires, no applications and cover letters are required, allowing companies to easily and quickly identify suitable freelancers to bring into their teams. 
                                </p>
                                <p>
                                    For employers, this means being connected to a global network of growing talent that can be tapped upon for each new project or team, and a seamless hiring process.
                                </p>
                                <p>
                                    For freelancers, this means being connected to interested companies who are actively looking to expand their talent pool, offering a gateway to opportunities anywhere in the world.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>
