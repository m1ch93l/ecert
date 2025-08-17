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
                <div class="col-sm-12">
                    <div class="table-responsive"
                    id="table-container"
                    hx-get="table.php"
                    hx-trigger="load"
                    hx-target="#table-container"
                    hx-swap="innerHTML">
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

<script>
    // Reinitialize DataTables each time htmx updates the table
    document.body.addEventListener("htmx:afterSwap", function(evt) {
      if (evt.target.id === "table-container") {
        $('#studentTable').DataTable();
      }
    });
  </script>

</html>