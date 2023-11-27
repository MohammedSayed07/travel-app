const defaultUrl = "http://localhost:8888/api/trips";
const currentParams = window.location.search;
const tripContainer = document.querySelector('#trips-container');
let favoriteIcons;

getTripsFromApi(defaultUrl+currentParams);

const fillHeart = '<svg aria-label="Unlike" fill="red" height="24" role="img" viewBox="0 0 48 48" width="24" class="favorite">\n<title>Unlike</title>\n<path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">\n</path>\n</svg>'
const emptyHeart = '<svg aria-label="like" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="favorite">\n<path  d="M20.42 4.82A5.23 5.23 0 0016.5 3 5.37 5.37 0 0012 5.58 5.37 5.37 0 007.5 3a5.23 5.23 0 00-3.92 1.82A6.35 6.35 0 002 9.07v.28c0 5.42 7.25 10.18 9.47 11.51a1 1 0 001 0C14.74 19.53 22 14.77 22 9.35v-.22-.06a6.35 6.35 0 00-1.58-4.25zM21 9.18v.17c0 4.94-7.07 9.5-9 10.65-1.92-1.15-9-5.71-9-10.65v-.17a.41.41 0 000-.11A4.81 4.81 0 017.5 4a4.39 4.39 0 013.66 2.12L12 7.44l.84-1.32A4.39 4.39 0 0116.5 4 4.81 4.81 0 0121 9.07a.41.41 0 000 .11z">\n</path>\n</svg>\n'
const placeSelect = document.querySelector('#place-select');
const showPrice = document.querySelector('#show-price');
const priceMenu = document.querySelector('#price-menu');
const priceSetter = document.querySelector('#price-setter');
const minPriceInput = document.querySelector('#min-price');
const maxPriceInput = document.querySelector('#max-price');
let filter = {}

showPrice.addEventListener('click', function () {
    if (priceMenu.classList.contains('hidden')) {
        priceMenu.classList.remove('hidden');
        priceMenu.classList.remove('opacity-0')
        priceMenu.classList.remove('scale-95')
        priceMenu.classList.add('opacity-100')
        priceMenu.classList.add('scale-100')
    } else {
        priceMenu.classList.add('hidden');
        priceMenu.classList.remove('opacity-100')
        priceMenu.classList.remove('scale-100')
        priceMenu.classList.add('opacity-0')
        priceMenu.classList.add('scale-95')
    }
})

placeSelect.addEventListener('change', function () {
    const selectedValue = placeSelect.value;
    if (selectedValue === 'ALL') {
        if ("trip_location" in filter)
            delete filter.trip_location;
        getTripsFromApi(defaultUrl+ '?' + objectToUrlParameters(filter))
        if (!isEmptyObject(filter)) {
            history.pushState(null, '', `/trips?${objectToUrlParameters(filter)}`);
        } else {
            history.pushState(null, '', `/trips`);
        }

    } else {
        filter['trip_location'] = selectedValue.replace(/ /g, '%');
        getTripsFromApi(defaultUrl + '?' + objectToUrlParameters(filter))
        history.pushState(null, '', `/trips?${objectToUrlParameters(filter)}`);
    }
})

priceSetter.addEventListener('click', function () {
    const minPrice = minPriceInput.value;
    let maxPrice = maxPriceInput.value;
    if (!(minPrice === "") && !isNaN(minPrice) &&  !isNaN(maxPrice)) {
        filter['min_price'] = minPrice;
        if (maxPrice === "")
            maxPrice = "99999";
        filter['max_price'] = maxPrice;
        getTripsFromApi(defaultUrl + '?' + objectToUrlParameters(filter))
        history.pushState(null, '', `/trips?${objectToUrlParameters(filter)}`);
    }
})

function getTripsFromApi(url)
{
    fetch(url)
        .then((res)=> {
            if (res.ok) {
                return res.json()
            }
            throw Error("Network response was not ok")
        }).then((data)=> {
            tripContainer.innerHTML = generateTrips(data)
    }).catch((error)=>{
        console.log('Error: ' + error)
    })
}

function generateTrips(trips) {
    let data = '';
    const currentDate = new Date();
    const currentDay = currentDate.getDate();
    const currentMonth = currentDate.getMonth() + 1;
    const currentYear = currentDate.getFullYear();
    let tripReservation;
    for (let trip of trips) {
        const reservationEnd = new Date(trip.trip_end_date);
        reservationEnd.setDate(reservationEnd.getDate() - 8)

        tripReservation = ``;

        if ((reservationEnd.getDate() >= currentDay) && (reservationEnd.getMonth() + 1 === currentMonth) && (reservationEnd.getFullYear() === currentYear)) {
            tripReservation = `<p class="text-xs text-red-500">Only ${reservationEnd.getDate() - currentDay} days remaining for reservation to be closed!</p>`
        } else {
            tripReservation = `<p class="text-xs text-gray-700">Reservation until: ${reservationEnd.toISOString().slice(0, 10)} </p>`
        }

        let tripHeart = '';
        let clickedClass = '';
        if (trip.isFavorite) {
            tripHeart = fillHeart;
            clickedClass = 'clicked'
        } else {
            tripHeart = emptyHeart;
        }

        data += `<div class="mt-4 sm:flex rounded-2xl bg-white shadow-xl">
                <div>
                    <img class="object-cover rounded-l-2xl rounded-br-none rounded-bl-none rounded-r-2xl sm:rounded-bl-2xl sm:rounded-r-none sm:w-72 sm:h-full w-full h-52" src="${trip.images[0]}" alt="trip-image" />
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

                    <h3 class="text-lg font-semibold truncate max-w-xs" title="${trip.trip_title}">
                        ${trip.trip_title}
                    </h3>

                    <p class="text-sm truncate max-w-xs" title="${trip.trip_details}">
                        ${trip.trip_details}
                    </p>

                    <p class="text-sm font-semibold">
                        9.1 - Excellent <span class="font-normal">(1319 reviews)</span>
                    </p>

                    <p class="text-xs text-red-500">
                        ${tripReservation}
                    </p>
                </div>

                <div class="px-2 py-2 flex-grow">
                    <a href="/trip?trip_id=${trip.trip_id}" class="transition-colors duration-300 block px-2 py-2 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 hover:border-blue-200 view-color">
                        <p class="text-xs font-semibold">
                            Expedia
                        </p>

                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold">
                                ${trip.trip_price} EGP
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
        `
    }
    return data;
}

function objectToUrlParameters(params) {
    return Object.keys(params).map(function (key) {
        return key + '=' + params[key];
    }).join("&");
}

function isEmptyObject(obj) {
    return Object.keys(obj).length === 0
}

function toggleHeart(tripId) {
    console.log('huh?')
    const id = `#heart-${tripId}`
    const heartDiv = document.querySelector(id);
    if (heartDiv.classList.contains("clicked")) {
        // The "clicked" class is active
        fetch(`http://localhost:8888/favorites?trip_id=${tripId}`, {
            method: 'DELETE'
        }).then(response => {
            if (response.ok) {
                return response.json()
            }
            throw new Error("Network response was not ok")
        }).then(data => {
        }).catch(error => {
            console.log('Error:', error);
        });
        heartDiv.innerHTML = emptyHeart;
    } else {
        fetch('http://localhost:8888/favorites', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                trip_id: tripId
            })
        }).then(response => {
            if (response.ok)
            {
                return response.json();
            }
            window.location.href = "http://localhost:8888/login";
            throw new Error("Network response was not ok");
        }).then(data => {
        }).catch(error => {
            console.log('Error:', error);
        });
        heartDiv.innerHTML = fillHeart;
    }
    heartDiv.classList.toggle("clicked");
}
