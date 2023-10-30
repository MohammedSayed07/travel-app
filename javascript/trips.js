const defaultUrl = "http://localhost:8888/api/trips";
const currentParams = window.location.search;
const tripContainer = document.querySelector('#trips-container');
const placeSelect = document.querySelector('#place-select');

getTripsFromApi(defaultUrl+currentParams);

let filter = {}

placeSelect.addEventListener('change', function () {
    const selectedValue = placeSelect.value;
    filter['trip_location'] = selectedValue.replace(/ /g, '%');
    getTripsFromApi(defaultUrl + '?' + objectToUrlParameters(filter))
    history.pushState(null, '', `/trips?${objectToUrlParameters(filter)}`);

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
        const reservationEnd = new Date(trip.endDate);
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
        <div class="card mb-3" style="max-width: 1000px;">
                <div class="row g-0 m-2">
                    <div class="col-md-4">
                        <div id="carousel${trip.id}" class="carousel slide">
                            <div class="carousel-inner">
                                ${images}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel${trip.id}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel${trip.id}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">${trip.title}</h5>
                            <p class="card-text">${trip.details}</p>
                            ${tripReservation}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <p class="card-text">${trip.price} EGP</p>
                        </div>
                    </div>
                </div>

            </div>
        `
    }
    return data;
}

function objectToUrlParameters(params)
{
    let urlParameters = Object.keys(params).map(function(key){
        return key + '=' + params[key];
    }).join("&");

    return urlParameters;
}

