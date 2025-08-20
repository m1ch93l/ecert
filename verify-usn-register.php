<?php

session_start();
include __DIR__ . '/includes/conn.php';
include 'includes/header.php';

if(isset($_POST['register'])){

    $usn      = $_SESSION['usn'];
    $password = $_POST['password'];
    $query    = "UPDATE participant SET password = ? WHERE participant_id = ?";
    $stmt     = $conn->prepare($query);
    $stmt->bind_param('ss', $password, $usn);
    $stmt->execute();

    session_start();
    session_unset();
    session_destroy();
    header('location: index');
    exit();
}
?>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h3 class="card-title">e-Certificate</h3>
                    </div>
                    <div class="card-body">
                        <form action="verify-usn-register" method="POST">
                            <div class="form-group">
                                <label for="participant">Username</label>
                                <input type="text" class="form-control mb-3" id="participant" value="<?=$_SESSION['usn']?>" autofocus
                                    required disabled>
                                <label for="password">Create a <b>NEW</b> Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <br>
                                <button type="submit" class="form-control btn btn-warning" name="register">
                                    Confirm
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