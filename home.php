<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <div class="container-md">
        <h1 class="text-center">Welcome, <?= $_SESSION['fullname'] ?></h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $sql   = "SELECT acquired_cert.participant_id, certificate.id, certificate.type, certificate.event FROM acquired_cert INNER JOIN certificate ON acquired_cert.certificate_id = certificate.id WHERE acquired_cert.participant_id = '" . $_SESSION['participant'] . "'";
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