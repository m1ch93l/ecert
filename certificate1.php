<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
    img {
        position: absolute;
    }

    .fullname {
        font-size: 43px;
        font-family: "Georgia", serif;
        text-transform: uppercase;
        position: absolute;
        color: #040348;
        top: 47%;
        left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
        font-weight: bold;
    }

    .bringinfront {
        z-index: 1;
    }
</style>

<body>

    <img src="1.png" class="position-absolute" alt="" width="100%" height="100%">
    <div width="100%" class="bringinfront position-absolute top-0 start-0 translate-middle">
        <div class="fullname">
            {{ fullname }}
        </div>
    </div>

</body>

</html>