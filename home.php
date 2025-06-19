<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Certificate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li> -->
                </ul>
                <a href="logout" hx-boost="true" class="navbar-text text-uppercase text-decoration-none text-danger">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <div class="container-md">
        <h1 class="text-center text-capitalize">Welcome, <?= $_SESSION['fullname'] ?></h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $sql   = "SELECT acquired_cert.participant_id, certificate.id as certificate_id, certificate.type, certificate.event FROM acquired_cert INNER JOIN certificate ON acquired_cert.certificate_id = certificate.id WHERE acquired_cert.participant_id = '" . $_SESSION['participant'] . "'";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()) {
                ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize"><?= $row['type'] ?></h5>
                            <p class="card-text text-capitalize"><?= $row['event'] ?></p>
                            <form action="generate-pdf" method="post">
                                <input type="hidden" class="form-control" id="name" value="<?= $_SESSION['fullname'] ?>"
                                    name="fullname">
                                <input type="hidden" class="form-control" id="checkcertificate"
                                    value="<?= $row['certificate_id'] ?>" name="checkcertificate">
                                <button type="submit" class="btn btn-primary" name="generate">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>