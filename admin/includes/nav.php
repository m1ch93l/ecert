<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="home" hx-boost="true">E-Certificate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['REQUEST_URI']) == 'certificate') ? 'active' : '' ?>"
                        aria-current="page" href="certificate" hx-boost="true">Certificates</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li> -->
            </ul>
            <a href="logout" class="navbar-text text-uppercase text-decoration-none text-danger">
                Logout
            </a>
        </div>
    </div>
</nav>