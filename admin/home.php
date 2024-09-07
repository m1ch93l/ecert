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
                                    <th class="text-start">Certificates</th>
                                    <th>Events</th>
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
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                                    data-bs-target="#<?php echo $row["id"]; ?>" aria-expanded="false"
                                                    aria-controls="<?php echo $row["id"]; ?>">
                                                    Details
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-start text-capitalize"><?php echo $row["fullname"]; ?></td>
                                        <td class="text-start">
                                            <?php
                                            $sql1   = "SELECT COUNT(*) as count FROM acquired_cert WHERE participant_id = '" . $row["id"] . "'";
                                            $query1 = $conn->query($sql1);
                                            $row1   = $query1->fetch_assoc();
                                            echo $row1["count"];
                                            ?>
                                        </td>
                                        <td>
                                            <div class="collapse" id="<?php echo $row["id"]; ?>">
                                                <div class="card card-body">
                                                    <?php
                                                    $sql1   = "SELECT * FROM acquired_cert JOIN certificate ON acquired_cert.certificate_id = certificate.id WHERE participant_id = '" . $row["id"] . "'";
                                                    $query1 = $conn->query($sql1);
                                                    while ($row1 = $query1->fetch_assoc()) {
                                                        ?>
                                                        <div><?=$row1["event"]; ?></div><br>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row["id"]; ?>">Add Cert</button>
                                            <div class="modal fade" id="modal-<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="add-cert" method="post">
                                                                <div class="mb-3">
                                                                    <label for="participant_id" class="form-label">Participant ID</label>
                                                                    <input type="hidden" class="form-control" id="participant_id" name="participant_id" value="<?php echo $row["id"]; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="certificate_id" class="form-label">Certificate ID</label>
                                                                    <input type="hidden" name="participant_id" value="<?php echo $row["id"]; ?>">
                                                                    <select class="form-select" id="certificate_id" name="certificate_id">
                                                                        <?php
                                                                        $sql2 = "SELECT * FROM certificate";
                                                                        $query2 = $conn->query($sql2);
                                                                        while ($row2 = $query2->fetch_assoc()) {
                                                                            ?>
                                                                            <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["event"]; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Add</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
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