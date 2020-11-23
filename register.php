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
            <div class="parallax parallax-connected">
                <div class="caption">
                    <div class="inside-caption"><h1>Join Us</h1></div>
                </div>
            </div>
        </header>
        <main>
            <div class="parallax parallax-connected-form">
                <div class="container formBg">
                    
                    <h2> Registration Form </h2>
                    <p> Thank you for choosing to join our growing network of global talent. 
                        Submit this registration form to start getting connected to jobs you love. </p>
                    
                    <form method="post" action="process_register.php">
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="account_type">Type of Account:</label>
                                <select class="form-control form-control-md" name="account_type" id="account_type">
                                    <option value="freelancer">Freelancer</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row" id="freelancerNameInput">
                            <div class="col-sm-6">
                                <label for="fname">First Name:</label>
                                <input class="form-control" id="fname" name="fname" type="text" 
                                       placeholder="e.g. James" pattern="^[a-zA-Z\s]+$">
                            </div>
                            <div class="col-sm-6">
                                <label for="lname">Last Name:</label>
                                <input class="form-control" id="lname" name="lname" type="text" 
                                       placeholder="e.g. Bond" required pattern="^[a-zA-Z\s]+$">
                            </div>
                        </div>
                        <div class="form-group form-row" id="companyNameInput">
                            <div class="col">
                                <label for="company_name">Company Name:</label>
                                <input class="form-control" id="company_name" name="company_name" type="text" 
                                       placeholder="e.g. Amazon" pattern="^[a-zA-Z\s]+$">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-sm-6">
                                <label for="email">Email:</label>
                                <input class="form-control" id="email" name="email" type="email" 
                                       placeholder="e.g. jamesbond@gmail.com" required 
                                       pattern="^[a-z0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                            </div>
                            <div class="col-sm-6">
                                <label for="email_conf">Confirm Email:</label>
                                <input class="form-control" id="email_conf" name="email_conf" type="email" 
                                       placeholder="e.g. jamesbond@gmail.com" required
                                       pattern="^[a-z0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                            </div>
                        </div>

                        <!-- 
                            PASSWORD RULES: 
                                - one number                    (?=.*[0-9])
                                - one capital letter            (?=.*[a-z])
                                - one small letter              (?=.*[A-Z])
                                - one special character         (?=.*[^\w])
                                - at least eight characters     .{8,}
                        -->

                        <div class="form-group form-row">
                            <div class="col-sm-6">
                                <label for="pwd">Password:</label>
                                <input class="form-control" id="pwd" name="pwd" type="password" placeholder="••••••" 
                                       required pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,}">
                            </div>
                            <div class="col-sm-6">
                                <label for="pwd_confirm">Confirm Password:</label>
                                <input class="form-control" id="pwd_confirm" name="pwd_confirm" type="password" placeholder="••••••" 
                                       required pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input class="form-control" id="address" name="address" type="text" placeholder="e.g. 123 Baker Street"
                                   required pattern="^[a-zA-Z0-9,#\-\.\s]+$">
                        </div>
                        <div class="form-group form-row">
                            <div class="col-sm-6">
                                <label for="country">Country:</label>
                                <select class="form-control form-control-md" name="country" id="country" required>
                                    <?php
                                        include 'countries.inc.php';
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="postalCode">Postal Code:</label>
                                <input class="form-control" id="postalCode" name="postalcode" type="text" placeholder="e.g. 123456"
                                       required pattern="^[a-zA-Z0-9]+$">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <p class="citation">Photo by <a href="https://unsplash.com/@dulgier?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Nastya Dulhiier</a> on <a href="https://unsplash.com/s/photos/network?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></p>
            </div>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>