<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/icons/plane.png" alt="Logo" width="30" height="24"
                 class="d-inline-block align-text-top">
            Safrni
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            <?php if (!isset($_SESSION['user'])) : ?>
                <div class="d-flex gap-2">
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                </div>
            <?php else: ?>
                <form method="post" action="/logout">
                    <input type="hidden" name="_method" value="delete"/>
                    <button class="nav-link">Logout</button>
                </form>

            <?php endif;?>
        </div>
    </div>
</nav>