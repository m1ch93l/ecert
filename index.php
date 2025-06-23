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
    <?php if (isset($_SESSION['error'])) : ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="..." class="rounded me-2" alt="...">
                        <strong class="me-auto">Bootstrap</strong>
                        <small>11 mins ago</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= $_SESSION['error'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']);
    endif; ?>

    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h3 class="card-title">e-Certificate</h3>
                    </div>
                    <div class="card-body">
                        <form action="login" method="POST" hx-boost="true">
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

<script>
    document.body.addEventListener('htmx:load', (event) => {
        var toastLiveExample = document.getElementById('liveToast')
        var toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    })
</script>

</html>