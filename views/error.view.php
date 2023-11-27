<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="/styles/general.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once(MAIN_DIR . '/views/partials/nav.view.php')?>

    <h1 class="text-center mt-40 text-5xl font-bold font-mono">
        <?= $error ?>
    </h1>

    <script src="../../javascript/nav.js"></script>
</body>

</html>