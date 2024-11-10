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
            +"<td><button><i class='fa-solid fa-pen'></i></button></td>"
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
