<?php //echo password_hash("123", PASSWORD_BCRYPT);
session_start();
if (isset($_SESSION['admin'])) {
    header('location: index.php');
}
?>

<?php include 'includes/header.php'; ?>

<body>
    <h1>Please login</h1>
    <form action="login.php" method="POST">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-curve"
                    style="background-color: #4682B4 ;color:black ; font-size: 12px; font-family:Times" name="login"><i
                        class="fa fa-sign-in"></i> Sign In</button>
            </div>
        </div>
    </form>
</body>

</html>