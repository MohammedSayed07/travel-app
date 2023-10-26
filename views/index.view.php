<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="/styles/general.css" rel="stylesheet">
    <link href="/styles/trips.css" rel="stylesheet">
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
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

    <div class="content mt-3" id="trips-container">
        <a href="/trips" class="content-link">
            <div class="card">
                <img src="/images/general/b0055080.avif" class="card-img-top" alt="...">
                <div class="card-body" style="display: flex; justify-content: center;align-items: center;">
                    <p class="card-text" style="font-size: x-large;font-weight: bold">Trips</p>
                </div>
            </div>
        </a>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>