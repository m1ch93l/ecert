<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <header class="bg-dark py-3 text-white text-center">
        e-Certificate
    </header>
    <main>
        <div class="container-md">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center position-absolute my-5">
                        
                    </h1>
                    <div id="printDiv">
                        <img src="../1.png" class="img-fluid" alt="certificate">
                    </div>
                    <button onclick="printLetterSize()" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
