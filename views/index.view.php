<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="styles/general.css" rel="stylesheet">
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
                <a class="nav-link" href="/login">Login</a>
            </div>
        </div>
    </nav>


    <div class="container d-inline-block mt-3">
        <?php foreach($data as $item) : ?>
            <div class="card mb-3" style="max-width: 1200px;">
                <div class="row g-0 m-2">
                    <div class="col-md-4">
                        <div id="carousel<?=$item->getId()?>" class="carousel slide">
                            <div class="carousel-inner">
                                <?php foreach($item->getImages() as $image) : ?>
                                <div class="carousel-item active">
                                    <div class="image-container">
                                        <img src="<?= $image ?>" class="d-block w-100 h-100" alt="...">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$item->getId()?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$item->getId()?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->getTitle() ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="javascript/slideshow.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>