<?php require_once __DIR__ . '/../includes/conn.php';

$limit  = 10; // rows per page
$page   = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count all participants
$countStmt = $conn->prepare("SELECT COUNT(*) as total FROM participant");
$countStmt->execute();
$totalRows  = $countStmt->get_result()->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch participants for this page
$stmt = $conn->prepare("SELECT * FROM participant ORDER BY fullname LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$rows = $stmt->get_result();
?>

<table class="table hover" style="width:100%">
    <thead>
        <tr>
            <th class="text-start">Full Name</th>
            <th class="text-start">USN</th>
            <th class="text-start">Certificates</th>
            <th width="20%">Events</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="search-results"><?php

    foreach ($rows as $row) : ?>
            <tr>
                <td class="text-start text-capitalize"><?php echo $row["fullname"]; ?>
                    <a type="button" hx-get="crud.php?action=editFullname&id=<?= $row['id'] ?>" hx-target="#modalBody"
                        hx-trigger="click" hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#showEditNameModal"
                        class="text-decoration-none">
                        <i class="bi bi-pen"></i>
                    </a>
                </td>
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

<!-- Simple Pagination -->
<div class="mt-3 d-flex justify-content-start gap-2">
    <!-- Previous -->
    <?php if ($page > 1) : ?>
        <button hx-get="table.php?page=<?= $page - 1 ?>" hx-target="#table-container" hx-swap="innerHTML"
            class="btn btn-sm btn-outline-secondary">
            Previous
        </button>
    <?php else : ?>
        <button class="btn btn-sm btn-outline-secondary" disabled>Previous</button>
    <?php endif; ?>

    <!-- Page Info -->
    <span class="align-self-center">Page <?= $page ?> of <?= $totalPages ?></span>

    <!-- Next -->
    <?php if ($page < $totalPages) : ?>
        <button hx-get="table.php?page=<?= $page + 1 ?>" hx-target="#table-container" hx-swap="innerHTML"
            class="btn btn-sm btn-outline-secondary">
            Next
        </button>
    <?php else : ?>
        <button class="btn btn-sm btn-outline-secondary" disabled>Next</button>
    <?php endif; ?>
</div>