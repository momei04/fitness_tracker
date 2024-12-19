let add_event_form = document.querySelector('#add_event_form');
let doneToggles = document.querySelectorAll('input.done');

let table = new DataTable('#event_content', {
    // config options...
});
add_event_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let workout_element = document.querySelector('#workout');
    let workout_id = workout_element.options[workout_element.selectedIndex].value;

    let pattern_element = document.querySelector('#repeat_pattern');
    let pattern = pattern_element.options[pattern_element.selectedIndex].value;

    let user_id = document.querySelector('#user_id').value;
    let start_date = document.querySelector('#from_date').value;
    let end_date = document.querySelector('#till_date').value;
    let title = document.querySelector('#title').value;
    add_event(user_id, start_date, end_date, workout_id, title, pattern);
})

for (let i = 0; i < doneToggles.length; i++) {
    let doneToggle = doneToggles[i];
    let done = 0;
    let user_id = doneToggle.dataset.user_id;
    let event_id = doneToggle.dataset.event_id;
    doneToggle.addEventListener('click', (e) => {
        e.preventDefault();
        if (doneToggle.checked){
            console.log(doneToggle.checked)
            done = 1;
        }
        updateEvent(event_id, done, user_id);
    })
}

async function add_event(user_id, start_date, end_date, workout_id, title, pattern) {
    await fetch('../../../services/form_handler.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:
            JSON.stringify({
                start_date: start_date,
                end_date: end_date,
                user_id: user_id,
                workout_id: workout_id,
                pattern: pattern,
                title: title,
                page: 'event',
                action:  'add_events'
            })
    }).then(response => response.json()).then(data => {

        let container = document.querySelector('#event_content tbody');
        container.innerHTML = '';
        for (let i = 0; i < data.length; i++) {
            if (data[i]['done'] === 1){
                container.innerHTML += "<tr>"
                    + "<td>"+data[i]['name']+"</td>"
                    + "<td>"+data[i]['date']+"</td>"
                    + "<td>"+data[i]['workout_type_name']+"</td>"
                    + "<td><a href='../workouts/workout_detail.php?workout_id="+data[i]['user_id']+"'>zum Workout</a></td>"
                    + "<td> <input type='checkbox' name='done' class='done' data-user_id="+data[i]['user_id']+" data-event_id='"+data[i]['event_id']+ "' checked></td>"
                    + "</tr>";
            }else{
                container.innerHTML += "<tr>"
                    + "<td>"+data[i]['name']+"</td>"
                    + "<td>"+data[i]['date']+"</td>"
                    + "<td>"+data[i]['workout_type_name']+"</td>"
                    + "<td><a href='../workouts/workout_detail.php?workout_id="+data[i]['workout_id']+"'>zum Workout</a></td>"
                    + "<td><input type='checkbox' name='done' class='done' data-user_id="+data[i]['user_id']+" data-event_id='"+data[i]['event_id']+ "'></td>"
                    + "</tr>";
            }

        }
        initializeButtons();
    });
}



async function updateEvent(event_id, done, user_id) {
    await fetch('../../../services/form_handler.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:
            JSON.stringify({
                event_id: event_id,
                done: done,
                user_id: user_id,
                page: 'exercise',
                action:  'update_events'
            })
    }).then(response => response.json()).then(data => {
        console.log(data);
        let container = document.querySelector('#event_content tbody');
        container.innerHTML = '';
        for (let i = 0; i < data.length; i++) {
            if (data[i]['done'] === 1){
                container.innerHTML += "<tr>"
                    + "<td>"+data[i]['name']+"</td>"
                    + "<td>"+data[i]['date']+"</td>"
                    + "<td>"+data[i]['workout_type_name']+"</td>"
                    + "<td><a href='../workouts/workout_detail.php?workout_id="+data[i]['user_id']+"'>zum Workout</a></td>"
                    + "<td> <input type='checkbox' name='done' class='done' data-user_id="+data[i]['user_id']+" data-event_id='"+data[i]['event_id']+ "' checked></td>"
                    + "</tr>";
            }else{
                container.innerHTML += "<tr>"
                    + "<td>"+data[i]['name']+"</td>"
                    + "<td>"+data[i]['date']+"</td>"
                    + "<td>"+data[i]['workout_type_name']+"</td>"
                    + "<td><a href='../workouts/workout_detail.php?workout_id="+data[i]['workout_id']+"'>zum Workout</a></td>"
                    + "<td><input type='checkbox' name='done' class='done' data-user_id="+data[i]['user_id']+" data-event_id='"+data[i]['event_id']+ "'></td>"
                    + "</tr>";
            }

        }

    });
    initializeButtons();
}



function initializeButtons(){
    let doneToggles = document.querySelectorAll('input.done');

    for (let i = 0; i < doneToggles.length; i++) {
        let doneToggle = doneToggles[i];
        let done = 0;
        let user_id = doneToggle.dataset.user_id;
        let event_id = doneToggle.dataset.event_id;
        doneToggle.addEventListener('click', (e) => {
            e.preventDefault();
            if (doneToggle.checked){
                done = 1;
            }
            updateEvent(event_id, done, user_id);
        })
    }
}