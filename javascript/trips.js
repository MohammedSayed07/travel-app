getTripsFromApi("http://localhost:8888/api/trips");

const locationCheckBox = document.querySelector('#location-checkbox')

locationCheckBox.addEventListener('click', locationCheck)
function generateTrips(trips) {
    let data = '';
    for (let trip of trips) {
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
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body">
                            <p class="card-text">1200$</p>
                        </div>
                    </div>
                </div>

            </div>
        `
    }
    return data;
}


function getTripsFromApi(url) 
{
    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data)
        let html = generateTrips(data);

        const tripContainer = document.querySelector('#trips-container');

        tripContainer.innerHTML = html
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function locationCheck() {
    if (locationCheckBox.checked) {
        getTripsFromApi("http://localhost:8888/api/trips?location=elghardga")
    } else {
        getTripsFromApi("http://localhost:8888/api/trips")
    }
}