<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <header class="bg-dark py-3 text-white text-center">
        e-Certificate
    </header>
    <main>
        <div class="container-md">
            <div class="row">
                <?php
                $sql   = "SELECT * FROM participant";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                    ?>
                    <div class="col-sm-12">
                        <table id="student" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-start">USN</th>
                                    <th class="text-start">Full Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql   = "SELECT * FROM participant";
                                $query = $conn->query($sql);
                                while ($row = $query->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="text-start">
                                            <div class="d-flex justify-content-between">
                                                <?php echo $row["participant_id"]; ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#<?php echo $row["id"]; ?>" aria-expanded="false" aria-controls="<?php echo $row["id"]; ?>">
                                                    Details
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-start"><?php echo $row["fullname"]; ?></td>
                                        <td>
                                            <div class="collapse" id="<?php echo $row["id"]; ?>">
                                                <div class="card card-body">
                                                    <p>USN: <?php echo $row["participant_id"]; ?></p>
                                                    <p>Full Name: <?php echo $row["fullname"]; ?></p>
                                                    <p>Email: <?php echo $row["email"]; ?></p>
                                                    <p>Phone: <?php echo $row["phone"]; ?></p>
                                                    <p>Address: <?php echo $row["address"]; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>
</body>

<script>
    $(document).ready(function () {
        $('#student').DataTable();
    });
</script>

</html>