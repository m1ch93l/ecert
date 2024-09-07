<?php //echo password_hash("amasco2023", PASSWORD_BCRYPT);
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}

if (isset($_SESSION['participant'])) {
    header('location: home.php');
}
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="participant">Username</label>
                                <input type="text" class="form-control" id="participant" name="participant">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <div class="button" type="submit" class="form-control btn btn-primary" name="login"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>