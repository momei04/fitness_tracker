
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
                let chartStatus = Chart.getChart("chart_MULTI");
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
            });

}

/*
function open_modal(class_name) {
    let modal = document.querySelector(class_name);
    let modalOverview = document.querySelector('.modal-overview');
    modalOverview.classList.add('active');
    modal.classList.add('open');
}*/
