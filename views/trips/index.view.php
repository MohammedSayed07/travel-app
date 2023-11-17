<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="/styles/trips.css" rel="stylesheet">
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once(MAIN_DIR . '/views/partials/nav.view.php')?>
    <div class="wrapper">
        <div class="sidebar">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <span class="fs-4">Filters</span>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <p class="fs-6 fst-italic mx-2">Location</p>
                        <select class="form-select" id="place-select" aria-label="Default select example">
                            <option selected disabled></option>
                            <option value="ALL">ALL PLACES</option>
                            <option value="sharm elsheikh">Sharm Elsheikh</option>
                            <option value="elghardga">Elghardga</option>
                        </select>
                    </li>
                    <li class="nav-item mt-3">
                        <p class="fs-6 fst-italic mx-2">Price</p>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">EGP</span>
                            <input type="text" placeholder="Min" class="form-control" id="min-price" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <span class="input-group-text" id="inputGroup-sizing-sm">EGP</span>
                            <input type="text" placeholder="Max" class="form-control" id="max-price" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <button type="button" class="btn btn-primary btn-sm mx-1" id="price-setter">Go</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content container flex flex-column gap-2 mt-3" id="trips-container">

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/trips.js"></script>
</body>

</html>