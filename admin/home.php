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
                        <b>VOTES TALLY</b>
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

<script>
    function printLetterSize() {
        var divContents = document.getElementById("printDiv").innerHTML;
        var a = window.open("");
        a.document.write("<html>");
        a.document.write("<head><title></title>");
        a.document.write("<style type='text/css'> @media print{@page {size: letter;}}</style>");
        a.document.write("</head>");
        a.document.write("<body onload='window.print();'>");
        a.document.write(divContents);
        a.document.write("</body>");
        a.document.write("</html>");
    }
</script>

</html>
