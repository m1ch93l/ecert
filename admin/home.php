<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <?php require_once __DIR__ . '/includes/nav.php'; ?>
    <main>
        <div class="container-md">

            <div class="row g-3 py-2">
                <div class="col-sm-3">
                    <form action="import.php" enctype="multipart/form-data" method="post">
                        <input type="file" class="form-control form-control-sm" name="importStudents" required></input>
                        <button type="submit" class="btn btn-warning btn-sm mt-2" name="save_import">Import
                            Excel</button>
                    </form>
                </div>
                <div class="col-sm-3">
                    <a href="export.php" class="btn btn-dark btn-sm">Download Excel</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 offset-sm-9">
                    <input class="form-control" type="search" name="search"
                        placeholder="Search..." hx-get="search.php"
                        hx-trigger="input changed delay:500ms, keyup[key=='Enter']" hx-target="#table-container"
                        hx-swap="innerHTML">
                </div>

                <div class="col-sm-12">
                    <div class="table-responsive" id="table-container" hx-get="table.php" hx-trigger="load"
                        hx-target="#table-container" hx-swap="innerHTML">

                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para sa bawat user -->
    <div class="modal fade" id="showEditNameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Full Name</h1>
                </div>
                <!-- mag add ng id kagaya ng "modalBody" para sa handle ng parameter -->
                <div class="modal-body" id="modalBody">
                    ...
                </div>
            </div>
        </div>
    </div>

</body>

</html>