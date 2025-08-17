<?php

require_once 'includes/session.php';
require_once 'includes/header.php';

?>

<body>
    <?php require_once 'includes/nav.php'; ?>
    <div class="container mt-5">
        <h1>Welcome to the E-Certificate Admin Panel</h1>
        <p>This is the home page where you can manage certificates.</p>
        <div class="row">
            <form hx-post="crud.php?action=create" hx-target="#certificate-list" hx-swap="beforeend">
                <div class="row g-3">
                    <div class="col">
                        <input name="type" type="text" placeholder="Type of Certificate" class="form-control mb-2 text-capitalize"
                            required>
                    </div>
                    <div class="col">
                        <input name="event" type="text" placeholder="Event Name" class="form-control mb-2 text-capitalize" required>
                    </div>
                </div>
                <button class="btn btn-sm btn-success">Add Certificate</button>
            </form>
            <div class="table-responsive border mt-2">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Type of Certificates</th>
                            <th class="text-center">Events</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="certificate-list" hx-get="crud.php?action=read" hx-trigger="load, every 2s">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para sa bawat user -->
    <div class="modal fade" id="showEachCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                </div>
                <!-- mag add ng id kagaya ng "modalBody" para sa handle ng parameter -->
                <div class="modal-body" id="modalBody">
                    ...
                </div>
            </div>
        </div>
    </div>

</body>