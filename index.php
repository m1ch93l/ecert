<?php //echo password_hash("amasco2023", PASSWORD_BCRYPT);
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home');
}

if (isset($_SESSION['participant'])) {
    header('location: home');
}
?>
<!-- header of html -->
<?php include 'includes/header.php'; ?>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h3 class="card-title">e-Certificate</h3>
                    </div>
                    <div class="card-body">
                        <form action="login" method="POST">
                            <div class="form-group">
                                <label for="participant">Username</label>
                                <input type="text" class="form-control" id="participant" name="participant" autofocus>
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <br>
                                <button type="submit" class="form-control btn btn-primary" name="login">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>