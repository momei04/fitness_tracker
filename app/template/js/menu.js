let dropdown_buttons = document.querySelectorAll('.dropdown-btn');
let sidebar = document.querySelector('#sidebar');

for (let i = 0; i < dropdown_buttons.length; i++) {
    let button = dropdown_buttons[i];
    button.addEventListener('click', (e) => {
        e.preventDefault();
        closeAllSubmenus();
        if (!button.nextElementSibling.classList.contains('show')){
            closeAllSubmenus();
        }
        button.nextElementSibling.classList.toggle('show');
        let chevron = button.querySelector('i');
        chevron.classList.toggle('show')


    })
}

let close_button = document.querySelector('#toggle-btn');
close_button.addEventListener('click', (e) => {
    e.preventDefault();
    closeAllSubmenus();
    sidebar.classList.toggle('close');
})

function closeAllSubmenus() {
    Array.from(sidebar.getElementsByClassName('show')).forEach(ul => {
        ul.classList.remove('show');
        // ul.previousElementSibling.classList.remove('show')
    })
}