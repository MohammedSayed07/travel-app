<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="styles/trips.css" rel="stylesheet">
    <link href="styles/sidebar.css" rel="stylesheet">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/icons/plane.png" alt="Logo" width="30" height="24"
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <a class="nav-link" href="#">Login</a>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <div class="sidebar-link" id="sidebar-home">
            <img src="icons/home.svg">
            <div>Sidebar</div>
        </div>
    </div>

    <div class="trips-card">
        <?php foreach($data as $item) : ?>
            <div class="card mb-3" style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/beach.webp" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>