<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <form action="generate-pdf" method="post">
        <div class="form-group">
            <label for="fullname">Name</label>
            <input type="text" class="form-control" id="name" name="fullname">
            <br>
            <button type="submit" class="form-control btn btn-primary" name="generate">
                Generate
            </button>
        </div>
    </form>
</body>

</html>