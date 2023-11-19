const defaultUrl = "http://localhost:8888/api/trips";
const currentParams = window.location.search;
const tripContainer = document.querySelector('#trips-container');
let favoriteIcons;

getTripsFromApi(defaultUrl+currentParams);

const placeSelect = document.querySelector('#place-select');
const priceSetter = document.querySelector('#price-setter');
const minPriceInput = document.querySelector('#min-price');
const maxPriceInput = document.querySelector('#max-price');
let filter = {}

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
    for (let trip of trips) {
        const reservationEnd = new Date(trip.trip_end_date);
        reservationEnd.setDate(reservationEnd.getDate() - 8)

        tripReservation = ``;

        if ((reservationEnd.getDate() >= currentDay) && (reservationEnd.getMonth() + 1 === currentMonth) && (reservationEnd.getFullYear() === currentYear)) {
            tripReservation = `<p class="card-text"><small class="text-danger">Only ${reservationEnd.getDate() - currentDay} days remaining for reservation to be closed! </small></p>`
        } else {
            tripReservation = `<p class="card-text"><small class="text-body-secondary">Reservation until: ${reservationEnd.toISOString().slice(0, 10)} </small></p>`
        }

        const images = trip.images.map((image, index) => {
            if (index === 0) {
                return `<div class="carousel-item active">
                                    <div class="image-container">
                                        <img src=" ${image} " class="d-block w-100 h-100" alt="...">
                                    </div>
                                </div>`
            } else {
                return `<div class="carousel-item">
                                    <div class="image-container">
                                        <img src=" ${image} " class="d-block w-100 h-100" alt="...">
                                    </div>
                                </div>`
            }
        }).join('')

        data += `
        <div class="card mb-3" style="max-width: 900px;">
                <div class="row g-0 m-2">
                    <div class="col-md-4">
                        <div id="carousel${trip.trip_id}" class="carousel slide">
                            <div class="carousel-inner">
                                ${images}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel${trip.trip_id}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel${trip.trip_id}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title d-inline-block" dir="auto">${trip.trip_title}</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="favorite" onclick="toggleHeart(${trip.trip_id})">
                                    <path id="heart-${trip.trip_id}" d="M20.42 4.82A5.23 5.23 0 0016.5 3 5.37 5.37 0 0012 5.58 5.37 5.37 0 007.5 3a5.23 5.23 0 00-3.92 1.82A6.35 6.35 0 002 9.07v.28c0 5.42 7.25 10.18 9.47 11.51a1 1 0 001 0C14.74 19.53 22 14.77 22 9.35v-.22-.06a6.35 6.35 0 00-1.58-4.25zM21 9.18v.17c0 4.94-7.07 9.5-9 10.65-1.92-1.15-9-5.71-9-10.65v-.17a.41.41 0 000-.11A4.81 4.81 0 017.5 4a4.39 4.39 0 013.66 2.12L12 7.44l.84-1.32A4.39 4.39 0 0116.5 4 4.81 4.81 0 0121 9.07a.41.41 0 000 .11z" fill="black">
                                    </path>
                                </svg>
                            </div>
                            <p class="card-text">${trip.trip_details}</p>
                            ${tripReservation}
                        </div>
                    </div>
                    <div class="col-md-4" style="background-color: #e6f4fa">
                        <div class="card-body">
                            <h5 class="card-text fw-bold ">${trip.trip_price} <small class="fw-normal">EGP</small></h5>
                        </div>
                    </div>
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
    const id = `#heart-${tripId}`
    const heartPath = document.querySelector(id);

    if (heartPath.classList.contains("clicked")) {
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
    }
    heartPath.classList.toggle("clicked")
}
