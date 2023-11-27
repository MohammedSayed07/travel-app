const userMenuButton = document.querySelector('#user-menu-button');
const userMenu = document.querySelector('#user-menu');
userMenuButton.addEventListener('click', function () {
    if (userMenu.classList.contains('hidden')) {
        userMenu.classList.remove('hidden');
        userMenu.classList.remove('opacity-0')
        userMenu.classList.remove('scale-95')
        userMenu.classList.add('opacity-100')
        userMenu.classList.add('scale-100')
    } else {
        userMenu.classList.add('hidden');
        userMenu.classList.remove('opacity-100')
        userMenu.classList.remove('scale-100')
        userMenu.classList.add('opacity-0')
        userMenu.classList.add('scale-95')
    }
})