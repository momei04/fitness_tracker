let menuButton = document.querySelector('.nav-button');


menuButton.addEventListener('click', (e)=>{
    let menu = document.querySelector('nav');
    console.log(menu)
    console.log('test');
    e.preventDefault();
    menu.classList.toggle('hidden');
    menuButton.classList.toggle('menu-open');
})