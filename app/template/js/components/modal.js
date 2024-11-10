
function initializeModal(trigger, modalClass){

    let modal = document.querySelector(modalClass);
    let modalOverview = document.querySelector('.modal-overview');
    let closeBtn = document.querySelector('.closeBtn');
    let infoButtons = document.querySelectorAll(trigger);
    let modalContent = modal.querySelector('.modal-content');


            console.log('testitestitest 3');
            modal.classList.toggle('open');
            modalOverview.classList.toggle('active');

            modalOverview.addEventListener('click', (e)=>{
                modalOverview.classList.remove('active');
                modal.classList.remove('open');
                modal.classList.remove('open');
            });

            closeBtn.addEventListener('click', (e)=>{
                modalOverview.classList.remove('active');
                modal.classList.remove('open');
                modal.classList.remove('open');
            });

}
