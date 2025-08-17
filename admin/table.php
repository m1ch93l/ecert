<?php require_once __DIR__ . '/../includes/conn.php'; ?>

<table id="studentTable" class="table hover" style="width:100%">
    <thead>
        <tr>
            <th class="text-start">USN</th>
            <th class="text-start">Full Name</th>
            <th class="text-start">Certificates</th>
            <th width="20%">Events</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody><?php
    $stmt = $conn->prepare("SELECT * FROM participant ORDER BY fullname ASC");
    $stmt->execute();
    $rows = $stmt->get_result();
    foreach ($rows as $row) : ?>
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
                    $stmt2 = $conn->prepare("SELECT COUNT(*) as count FROM acquired_cert WHERE participant_id = ?");
                    $stmt2->bind_param("i", $row["id"]);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    $row2    = $result2->fetch_assoc();
                    echo $row2["count"];
                    ?>
                </td>
                <td>
                    <div class="collapse" id="<?php echo $row["id"]; ?>">
                        <div class="card card-body">
                            <?php
                            $stmt3 = $conn->prepare("SELECT event, certificate_id, participant_id, certificate.id as cert_id FROM acquired_cert JOIN certificate ON acquired_cert.certificate_id = certificate.id WHERE participant_id = ?");
                            $stmt3->bind_param("i", $row["id"]);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();
                            foreach ($result3 as $row3) :
                                ?>
                                <div id="cert-row-<?= $row3['cert_id'] ?>-<?= $row3['participant_id'] ?>"
                                    class="d-flex justify-content-between text-capitalize">
                                    <?= $row3["event"] ?>
                                    <button
                                        hx-post="del-part-cert.php?id=<?= $row3['cert_id'] ?>&certid=<?= $row3['participant_id'] ?>"
                                        hx-target="#cert-row-<?= $row3['cert_id'] ?>-<?= $row3['participant_id'] ?>"
                                        hx-swap="outerHTML" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <br>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modal-<?php echo $row["id"]; ?>">Add Cert</button>
                    <div class="modal fade" id="modal-<?php echo $row["id"]; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?= $row['fullname'] ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="add-cert" method="post">
                                        <div class="mb-3">
                                            <input type="hidden" class="form-control" id="participant_id"
                                                name="participant_id" value="<?php echo $row["id"]; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="certificate_id" class="form-label">Certificate
                                                ID</label>
                                            <select class="form-select" id="certificate_id" name="certificate_id">
                                                <?php
                                                $stmt4 = $conn->prepare("SELECT * FROM certificate");
                                                $stmt4->execute();
                                                $result4 = $stmt4->get_result();
                                                while ($row4 = $result4->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row4["id"]; ?>">
                                                        <?php echo $row4["event"]; ?>
                                                    </option>
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
    endforeach;
    ?>
    </tbody>
</table>