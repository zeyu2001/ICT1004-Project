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
        <header class="container">
            <h1>Register</h1>
        </header>
        <main class="container"> 
            <form action="#">
                <div class="form-group form-row">
                    <div class="col-sm-3">
                        <label for="account_type">Type of account:</label>
                        <select class="form-control form-control-md" name="account_type" id="account_type">
                            <option value="freelancer">Freelancer</option>
                            <option value="corporate">Corporate</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="fname">First Name:</label>
                        <input class="form-control" id="fname" type="text" placeholder="e.g. James" required>
                    </div>
                    <div class="col">
                        <label for="lname">Last Name:</label>
                        <input class="form-control" id="lname" type="text" placeholder="e.g. Bond">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="email">Email:</label>
                        <input class="form-control" id="email" type="email" placeholder="e.g. jamesbond@gmail.com" required>
                    </div>
                    <div class="col">
                        <label for="email_Conf">Confirm Email:</label>
                        <input class="form-control" id="email_Conf" type="email" placeholder="e.g. jamesbond@gmail.com" required>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="password">Password:</label>
                        <input class="form-control" id="password" type="password" placeholder="••••••" required>
                    </div>
                    <div class="col">
                        <label for="password_conf">Confirm Password:</label>
                        <input class="form-control" id="password_conf" type="password" placeholder="••••••" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input class="form-control" id="address" type="text" placeholder="e.g. 123 Baker Street">
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="country">Country:</label>
                        <select class="form-control form-control-md" name="country" id="country">
                            <?php
                                include 'countries.inc.php';
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="postalCode">Postal Code:</label>
                        <input class="form-control" id="postalCode" type="text" placeholder="e.g. 123456">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Submit</button>
                </div>
            </form>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>