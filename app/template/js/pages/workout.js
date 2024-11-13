let create_workout_exercise_modal_button = document.querySelector('#create_exercise_form_submit');
let add_exercise_modal_button = document.querySelector('#exercise_add');
let tbody = document.querySelector('#workout_overview_table tbody');

    document.addEventListener('DOMContentLoaded', () => {
        initializeDeletButtons();
    })

add_exercise_modal_button.addEventListener('click', (e) => {
    e.preventDefault();
    initializeModal('#exercise_add', '.create_exercise')
});

create_workout_exercise_modal_button.addEventListener('click', (e)=>{
    e.preventDefault();
    var el = document.getElementById("exercise");
    var exercise_id = el.options[el.selectedIndex].value;
    let workout_id = document.querySelector('#workout_id').value;
    let sets = document.querySelector('#sets').value;
    let reps = document.querySelector('#reps').value;
    let weight = document.querySelector('#weight').value;
    let user = document.querySelector('#user_id').value;

    void insertExerciseIntoWorkout(exercise_id, workout_id, sets, reps, weight, user)
}, false)

function initializeDeletButtons() {
    let deleteButtons = document.getElementsByClassName('delete_button');
    console.log(deleteButtons);
    for (let i = 0; i < deleteButtons.length; i++) {
        let deleteButton = deleteButtons[i];
        deleteButton.addEventListener('click', (e) => {
            console.log(e);
            let user_id = deleteButton.dataset.user_id;
            let exercise_id = deleteButton.dataset.exercise_id;
            let workout_id = deleteButton.dataset.workout_id;
            console.log(workout_id);
            void deleteExerciseFromWorkout(user_id, exercise_id, workout_id);
            deleteButton.parentElement.parentElement.remove();
        }, false)
    }
}

async function insertExerciseIntoWorkout(exercise_id, workout_id, sets, reps, weight, user){
    await fetch('../../../services/form_handler.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:
            JSON.stringify({
                exercise_id: exercise_id,
                workout_id: workout_id,
                sets: sets,
                reps: reps,
                user_id: user,
                weight: weight,
                page: 'workout',
                action:  'add_exercise'
            })
    }).then(response => response.json()).then(data => {
        tbody.innerHTML ="";
        for (let exercise of data) {
            tbody.innerHTML +="<tr>"
            +"<td>"+exercise['exercise_name']+"</td>"
            +"<td>"+exercise['sets']+"</td>"
            +"<td>"+exercise['reps']+"</td>"
            +"<td>"+exercise['weight']+"</td>"
            +"<td><button><i class='fa-solid fa-chart-column'></i></button></td>"
            +"<td><button class='delete_button' data-user_id="+exercise['user_id']+" data-exercise_id="+exercise['exercise_id']+" data-workout_id="+exercise['workout_id']+"><i class='fa-solid fa-trash'></i></button></td></tr>";
        }
    });

    initializeDeletButtons();
}


async function deleteExerciseFromWorkout(user_id, exercise_id, workout_id){
    await fetch('../../../services/form_handler.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:
            JSON.stringify({
                exercise_id: exercise_id,
                workout_id: workout_id,
                user_id: user_id,
                page: 'workout',
                action:  'remove'
            })
    }).then(response => response.json()).then(data => {

    });
}




/*Workout Übersicht*/
exercise_history_buttons = document.querySelectorAll('.exercise_history_button');
for (let i = 0; i < exercise_history_buttons.length; i++) {
    let exercise_history_button = exercise_history_buttons[i];
    let content = document.querySelector('.exercise_history .modal-content');

    exercise_history_button.addEventListener('click', (e) => {
        e.preventDefault();
        let chartStatus = Chart.getChart("history");

        let exercise = exercise_history_button.dataset.exercise_id;
        let workout = exercise_history_button.dataset.workout_id;
        let user = exercise_history_button.dataset.user_id;
        fetch('../../../services/form_handler.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body:
                JSON.stringify({
                    exercise_id: exercise,
                    workout_id: workout,
                    user_id: user,
                    page: 'workout',
                    action:  'get_exercise_history'
                })
        }).then(response => response.json()).then(data => {
            console.log(data.length);
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }
            if (data.length >= 2){
                html = "<canvas id='history' width='400' height='200'></canvas>"

                content.innerHTML=html;
                let dates = [];
                let weights = [];
                for (let j = 0; j < data.length; j++) {
                    dates.push(data[j]['updated_at']);
                    weights.push(data[j]['weight'])
                }

                initializeModal('#exercise_add', '.exercise_history');
                const ctx = document.querySelector('#history');

                new Chart(ctx, {
                    type: 'line',

                    data: {
                        labels: dates,
                        datasets: [{
                            label: data[0]['exercise_name'],
                            data: weights,
                            color: '#162114',
                            borderWidth: 2,
                            scaleLabel: {
                                display: true,
                                labelString: 'kg'
                            }
                        }]
                    },
                    options: {
                        backgroundColor: '#EB3D00FF',
                        pointRadius: 5,
                        lineWidth: 3,
                        color: '#162114',
                        drawTicks: true,
                        scales: {
                            y: {
                                beginAtZero: false,

                            }
                        }
                    }
                });
            }else{
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }
                let content = document.querySelector('.exercise_history .modal-content');
                html = "<p>Keine weiteren Datensätze gefunden</p>"
                content.innerHTML=html;
                initializeModal('#exercise_add', '.exercise_history');
            }

        });
    })

}