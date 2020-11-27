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
                            <form id="searchBar" class="containter" action="listings.php" method="post">
                                <div class="form-group mx-auto">
                                    <input class="form-control border border-dark" name="input" type="search" placeholder="Search for talents" aria-label="Search">
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
                    <div class="row align-items-center">
                        <div class="col-md-8 order-md-1 order-2">
                            <div class="landing-segment" data-aos="fade-down">
                                <h2 class="landing-heading text-center">For Employers</h2>
                                <p>
                                    In this unprecedented pandemic, gig work has been more popular than ever
                                    before and we aim to connect free-lance developers to you to meet your needs.
                                    Our team of experienced web developers boast over 300 years of cumulative 
                                    experience with past roles in major companies including Google, Facebook and Microsoft.
                                    We are confident that they can meet your needs.
                                </p>
                            </div>
                            <div class="landing-segment" data-aos="fade-down">
                                <h2 class="landing-heading text-center">For Freelancers</h2>
                                <p>
                                    If you are a free-lancer looking for work opportunities, we can easily connect
                                    you with employment opportunities. Our network has connected over 1200 coders 
                                    and customers in just the last 3 months. Join today and leverage the fast growing 
                                    community of web developers online.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 order-md-2 order-1" data-aos="fade-down">
                            <img id="interview-img" class="mx-auto d-block" src="images/undraw_interview.svg" alt="">
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
                        <a href="https://unsplash.com/@hishahadat?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Shahadat Rahman
                        </a> 
                        on 
                        <a href="https://unsplash.com/s/photos/electronic?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                            Unsplash
                        </a>
                    </p>
                    <div class="row align-items-center">
                        <div class="col-md-4 order-md-1 order-2"  data-aos="fade-down">
                            <img id="profile-img" class="mx-auto d-block" src="images/undraw_profile.svg" alt="">
                        </div>
                        <div class="col-md-8 order-md-2 order-1">
                            <div class="landing-segment" data-aos="fade-down">
                                <h2 class="landing-heading text-center">The Future of Recruiting</h2>
                                <p>
                                We aim to provide a leading platform for businesses and freelancers to be able to find each other
                                on a dedicated platform. We believe that every individual has their own talent when it comes to their work
                                and this is where they will be able to display them.
                                </p>
                                <p>
                                    Work opportunities for freelancers don't come very easily, which is why we started the website to help you out.
                                    With a dedicated platform for you, all you have to do is register with us and let us handle the rest.

                                </p>
                                <p>
                                    For businesses, if you are looking for talented individuals for projects, you've come to the right place.
                                    We pride ourselves for having a wide range of talent's that will definitely fulfill your requirements.
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
