<?php //echo password_hash("amasco2023", PASSWORD_BCRYPT);
session_start();
?>

<!-- header of html -->
<?php include 'includes/header.php'; ?>

<body>
    <?php if (isset($_SESSION['error'])) : ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <strong class="me-auto ms-1">System</strong>
                        <small></small>
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
                        <form action="login" method="POST">
                            <div class="form-group">
                                <label for="participant">Username</label>
                                <input type="text" class="form-control" id="participant" name="participant" autofocus
                                    required>
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
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