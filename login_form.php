<form action="process_login.php" method="post">
    <div class="form-group form-row">
        <div class="col">
            <label for="account_type">Type of Account:</label>
            <select class="form-control form-control-md" name="account_type" id="account_type">
                <option value="freelancer">Freelancer</option>
                <option value="corporate">Corporate</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" id="email" name="email" type="email" placeholder="e.g. jamesbond@gmail.com" required>
    </div>
    <div class="form-group ">
        <label for="password">Password:</label>
        <input class="form-control" id="password" name="password" type="password" placeholder="••••••" required>
    </div>
    <div class="form-group">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Submit</button>
    </div>
</form>
