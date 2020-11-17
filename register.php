<?php
    session_start();
?>

<!DOCTYPE html>
<html>
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
                        <label>Type of account:</label>
                        <select class="form-control form-control-md" name="account_type" id="account_type">
                            <option value="freelancer">Freelancer</option>
                            <option value="corporate">Corporate</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="fname">First Name:</label>
                        <input class="form-control" id="fname" type="text" placeholder="First name" required>
                    </div>
                    <div class="col">
                        <label for="lname">Last Name:</label>
                        <input class="form-control" id="lname" type="text" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="email">Email:</label>
                        <input class="form-control" id="email" type="email" placeholder="example@email.com" required>
                    </div>
                    <div class="col">
                        <label for="email_Conf">Confirm Email:</label>
                        <input class="form-control" id="email_Conf" type="email" placeholder="example@email.com" required>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label for="password">Password:</label>
                        <input class="form-control" id="password" type="password" placeholder="..." required>
                    </div>
                    <div class="col">
                        <label for="password_conf">Confirm Password:</label>
                        <input class="form-control" id="password_conf" type="password" placeholder="..." required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input class="form-control" id="address" type="text" placeholder="123 baker street.....">
                </div>
                <div class="form-group form-row">
                    <div class="col">
                        <label>Country:</label>
                        <select class="form-control form-control-md">
                            <?php
                                include 'countries.inc.php';
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="postalCode">Postal Code:</label>
                        <input class="form-control" id="postalCode" type="text" placeholder="postal code">
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