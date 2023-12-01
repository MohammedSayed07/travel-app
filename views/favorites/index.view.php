<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link href="/styles/trips.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once(MAIN_DIR . '/views/partials/nav.view.php')?>

    <main class="bg-gray-100">
        <div class="sm:mx-auto sm:max-w-5xl px-4 py-2" id="trips-container">
            <?php if (!empty($trips)) : ?>
                <?php foreach ($trips as $trip) : ?>
                    <div class="mt-4 sm:flex rounded-2xl bg-white shadow-xl">
                        <div>
                            <img class="object-cover rounded-l-2xl rounded-br-none rounded-bl-none rounded-r-2xl sm:rounded-bl-2xl sm:rounded-r-none sm:w-72 sm:h-full w-full h-52" src="<?= $trip->getImages()[0] ?? '/images/1/1dd818a7-5909-446d-80ef-3c6c4f423c49.jpeg' ?>" alt="trip-image" />
                        </div>

                        <div class="px-5 py-4 space-y-3">
                            <div class="flex justify-between items-center">
                                <p class="text-xs">
                                    Apartment
                                </p>

                                <div id="heart-${trip.trip_id}" onclick="toggleHeart(${trip.trip_id})" class="${clickedClass}">
                                    ${tripHeart}
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold truncate max-w-xs" title="<?= $trip->getTitle()?>">
                                <?= $trip->getTitle()?>
                            </h3>

                            <p class="text-sm truncate max-w-xs" title="<?= $trip->getDetails()?>">
                                <?= $trip->getDetails()?>
                            </p>

                            <p class="text-sm font-semibold">
                                9.1 - Excellent <span class="font-normal">(1319 reviews)</span>
                            </p>

                            <?php if ($trip->calculateDayToEndOfReservation() !== 0) : ?>
                                <p class="text-xs text-red-500">
                                    Only <?= $trip->calculateDayToEndOfReservation()?> Days remaining for reservation to be closed!
                                </p>

                            <?php else : ?>
                                <p class="text-xs text-gray-700">
                                    Reservation until: <?= $trip->getEndOfReservationFormatted()?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="px-2 py-2 flex-grow">
                            <a href="/trip?trip_id=${trip.trip_id}" class="transition-colors duration-300 block px-2 py-2 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 hover:border-blue-200 view-color">
                                <p class="text-xs font-semibold">
                                    Expedia
                                </p>

                                <div class="flex justify-between items-center">
                                    <p class="text-lg font-bold">
                                        <?= $trip->getPrice()?> EGP
                                    </p>

                                    <span class="transition-colors duration-300 rounded-lg inline-flex items-center relative view-button-color" style="">
                                    <div class="appearance-none bg-transparent py-1.5 pr-12 pl-4  focus-within:outline-none">
                                        <p class="text-white text-md font-bold">View Deal</p>
                                    </div>
                                    <svg class="absolute right-4 pointer-events-none -rotate-90" width="26" height="26" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 15a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L12 12.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4A1 1 0 0 1 12 15z" fill="white"/></svg>
                                </span>
                                </div>
                            </a>

                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </main>


    <script src="../../javascript/nav.js"></script>
</body>

</html>