<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safrni</title>

    <link href="/styles/trips.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
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
                    <select id="place-select" class="appearance-none bg-transparent py-3 pr-24 pl-4 text-sm font-semibold focus-within:outline-none">
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

                <span class="transition-colors duration-300 bg-transparent border rounded-2xl inline-flex items-center relative hover:border-blue-500">
                    <div id="price-select" class="appearance-none bg-transparent py-3 pr-40 pl-4 text-sm font-semibold focus-within:outline-none">
                        <p><?= $_GET['min_price'] ?? 0 ?> - <?= $_GET['max_price'] ?? 10000 ?>+ EGP</p>


                    </div>
                    <svg class="absolute right-4 pointer-events-none" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 15a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L12 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4A1 1 0 0 1 12 15z" style="fill:#1c1b1e"/></svg>
                </span>

                <div class="transition-all duration-300 hidden transform opacity-0 scale-95 absolute left-0 z-10 mt-2 w-80 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
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
<!--            <div class="mt-4 sm:flex rounded-2xl bg-white shadow-xl">-->
<!--                <div>-->
<!--                    <img class="object-cover rounded-l-2xl rounded-br-none rounded-bl-none rounded-r-2xl sm:rounded-bl-2xl sm:rounded-r-none sm:w-72 sm:h-full w-full h-52" src="/images/1/1dd818a7-5909-446d-80ef-3c6c4f423c49.jpeg" alt="trip-image" />-->
<!--                </div>-->
<!---->
<!--                <div class="px-5 py-4 space-y-3">-->
<!--                    <div class="flex justify-between items-center">-->
<!--                        <p class="text-xs">-->
<!--                            Apartment-->
<!--                        </p>-->
<!---->
<!--                        <div id="heart-${trip.trip_id}" onclick="toggleHeart(${trip.trip_id})" class="${clickedClass}">-->
<!--                            <svg aria-label="Unlike" fill="red" height="24" role="img" viewBox="0 0 48 48" width="24" class="favorite">-->
<!--                                <title>Unlike</title>-->
<!--                                <path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">-->
<!--                                </path>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <h3 class="text-lg font-semibold truncate max-w-xs" title="Hotel Riu Plaza New York Times">-->
<!--                        ${trip.trip_title}-->
<!--                    </h3>-->
<!---->
<!--                    <p class="text-sm truncate max-w-xs" title="Hotel Riu Plaza New York Times">-->
<!--                        ${trip.trip_details}-->
<!--                    </p>-->
<!---->
<!--                    <p class="text-sm font-semibold">-->
<!--                        9.1 - Excellent <span class="font-normal">(1319 reviews)</span>-->
<!--                    </p>-->
<!---->
<!--                    <p class="text-xs text-red-500">-->
<!--                        ${tripReservation}-->
<!--                    </p>-->
<!--                </div>-->
<!---->
<!--                <div class="px-2 py-2 flex-grow">-->
<!--                    <a href="#" class="transition-colors duration-300 block px-2 py-2 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 hover:border-blue-200 view-color">-->
<!--                        <p class="text-xs font-semibold">-->
<!--                            Expedia-->
<!--                        </p>-->
<!---->
<!--                        <div class="flex justify-between items-center">-->
<!--                            <p class="text-lg font-bold">-->
<!--                                ${trip.trip_price} EGP-->
<!--                            </p>-->
<!---->
<!--                            <span class="transition-colors duration-300 rounded-lg inline-flex items-center relative view-button-color" style="">-->
<!--                                <div class="appearance-none bg-transparent py-1.5 pr-12 pl-4  focus-within:outline-none">-->
<!--                                    <p class="text-white text-md font-bold">View Deal</p>-->
<!--                                </div>-->
<!--                                <svg class="absolute right-4 pointer-events-none -rotate-90" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 15a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L12 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4A1 1 0 0 1 12 15z" fill="white"/></svg>-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </a>-->
<!---->
<!--                </div>-->
<!--            </div>-->
        </div>
    </main>


<!--    <div class="wrapper">-->
<!--        <div class="sidebar">-->
<!--            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">-->
<!--                <span class="fs-4">Filters</span>-->
<!--                <hr>-->
<!--                <ul class="nav nav-pills flex-column mb-auto">-->
<!--                    <li class="nav-item">-->
<!--                        <p class="fs-6 fst-italic mx-2">Location</p>-->
<!--                        <select class="form-select" id="place-select" aria-label="Default select example">-->
<!--                            <option selected disabled></option>-->
<!--                            <option value="ALL">ALL PLACES</option>-->
<!--                            <option value="sharm elsheikh">Sharm Elsheikh</option>-->
<!--                            <option value="elghardga">Elghardga</option>-->
<!--                        </select>-->
<!--                    </li>-->
<!--                    <li class="nav-item mt-3">-->
<!--                        <p class="fs-6 fst-italic mx-2">Price</p>-->
<!--                        <div class="input-group input-group-sm mb-3">-->
<!--                            <span class="input-group-text" id="inputGroup-sizing-sm">EGP</span>-->
<!--                            <input type="text" placeholder="Min" class="form-control" id="min-price" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">-->
<!--                            <span class="input-group-text" id="inputGroup-sizing-sm">EGP</span>-->
<!--                            <input type="text" placeholder="Max" class="form-control" id="max-price" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">-->
<!--                            <button type="button" class="btn btn-primary btn-sm mx-1" id="price-setter">Go</button>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="../../javascript/trips.js"></script>
</body>

</html>