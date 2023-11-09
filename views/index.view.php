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
    <?php include_once(MAIN_DIR . '/views/partials/nav.php')?>
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