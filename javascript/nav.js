const userMenuButton = document.querySelector('#user-menu-button');
const userMenu = document.querySelector('#user-menu');

// Function to show the userMenu
function showUserMenu() {
    userMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
    userMenu.classList.add('opacity-100', 'scale-100');
}

// Function to hide the userMenu
function hideUserMenu() {
    userMenu.classList.add('hidden', 'opacity-0', 'scale-95');
    userMenu.classList.remove('opacity-100', 'scale-100');
}

// Event listener for userMenuButton click
userMenuButton.addEventListener('mouseover', function () {
    if (userMenu.classList.contains('hidden')) {
        showUserMenu();
    } else {
        hideUserMenu();
    }
});

// Event listener for mouseleave on userMenu
userMenu.addEventListener('mouseleave', function () {
    hideUserMenu();
});