// this is not a project related js file, I just created it to play around things.
const images = trip.images.map((image, index) => {
    return `<div class="swiper-slide">
                        <img class="object-cover rounded-l-2xl rounded-br-none rounded-bl-none rounded-r-2xl sm:rounded-bl-2xl sm:rounded-r-none sm:w-72 sm:h-full w-full h-52" src="${image}" alt="trip-image" />
                    </div>`

}).join('')

const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});