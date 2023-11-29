<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="/styles/trips.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once(MAIN_DIR . '/views/partials/nav.view.php')?>

    <header class="mt-4 bg-white mb-4">
        <div class="sm:mx-auto sm:max-w-5xl sm:px-2 px-8 sm:flex sm:space-x-4 space-y-2 sm:space-y-0">
            <div class="space-y-2">
                <p class="text-sm font-semibold pl-4">
                    Location:
                </p>

                <span class="transition-colors duration-300 bg-transparent border rounded-2xl inline-flex items-center relative hover:border-blue-500">
                    <select id="place-select" class="appearance-none bg-transparent py-3 pr-24 pl-4 text-sm font-semibold focus-within:outline-none cursor-pointer">
                        <option selected value="ALL">ALL PLACES</option>
                        <option value="sharm elsheikh">Sharm Elsheikh</option>
                        <option value="elghardga">Elghardga</option>
                    </select>
                    <svg class="absolute right-4 pointer-events-none" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 15a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L12 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4A1 1 0 0 1 12 15z" style="fill:#1c1b1e"/></svg>
                </span>
            </div>

            <div class="space-y-2 relative">
                <p class="text-sm font-semibold pl-4">
                    Price:
                </p>

                <div id="show-price" class="transition-colors duration-300 bg-transparent border rounded-2xl inline-flex items-center relative hover:border-blue-500 cursor-pointer">
                    <div id="price-select" class="appearance-none bg-transparent py-3 pr-40 pl-4 text-sm font-semibold focus-within:outline-none">
                        <p><?= $_GET['min_price'] ?? 0 ?> - <?= $_GET['max_price'] ?? 10000 ?>+ EGP</p>
                    </div>
                    <svg class="absolute right-4 pointer-events-none" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 15a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L12 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4A1 1 0 0 1 12 15z" style="fill:#1c1b1e"/></svg>
                </div>

                <div id="price-menu" class="transition-all duration-300 hidden opacity-0 scale-95 absolute left-0 z-10 mt-2 w-80 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <div class="px-4 py-2">
                        <h3 class="text-sm font-bold">
                            Set price range
                        </h3>

                        <div class="mt-2 flex space-x-2">
                            <div>
                                <p class="text-gray-500 font-semibold text-xs">
                                    Min price
                                </p>
                                <input type="number" value="<?= $_GET['min_price'] ?? 0 ?>" min="0" max="10000" class="mt-1 border rounded-lg shadow py-1 w-32 text-center" id="min-price">
                            </div>
                            <div>
                                <br>
                                <p>-</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-semibold text-xs">
                                    Max price
                                </p>
                                <input type="number" value="<?= $_GET['max_price'] ?? 10000 ?>" min="0" max="10000" class="mt-1 border rounded-lg shadow py-1 w-32 text-center placeholder-black" id="max-price">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" class="items-center transition-colors duration-300 bg-blue-500 text-white rounded-md mt-4 px-4 py-1 hover:bg-blue-600" id="price-setter">
                                Apply
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="bg-gray-100">
        <div class="sm:mx-auto sm:max-w-5xl px-4 py-2" id="trips-container">

        </div>
    </main>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="../../javascript/nav.js"></script>
    <script src="../../javascript/trips.js"></script>
</body>

</html>