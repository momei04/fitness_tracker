function search(searchterm, table, action, column){
    fetch('../formValidation/formhandler.php', {
        method: "POST",
        body: new URLSearchParams({'name': searchterm, 'table':table, 'action': action, 'column': column} )
    })
    .then(res => res.json())
    .then(res => viewResult(res))
}

//insert a workout
function insertWorkout(){
    let value = document.querySelector('#workoutTitle').value;
    let type = document.querySelector('#workoutType').value;
    let description = document.querySelector('#description').value;
    let action = 'insertWorkout';
    
    fetch('../formValidation/formhandler.php', {
        method: "POST",
        body: new URLSearchParams({'title': value, 'type':type, 'action': action, 'description': description} )
    });
}

function getMuscleGroups(){
    fetch('../formValidation/formhandler.php', {
        method: "POST",
        body: new URLSearchParams({'action': 'getMuscleGroups'} )
    }).then((response) => response.json()).then((data) => {
    console.log("Test");
        let select = document.querySelector('select#muscleGroup');
        select.innerHTML="";
        data.forEach(element => {
            select.innerHTML += "<option value="+element['muscle_id']+">"+element['muscle_name']+""
        });
    })
}

//viewing a search result
function viewResult(data) {
    const dataViewer = document.querySelector('.dataViewer');
    dataViewer.innerHTML='';
    for (let i = 0; i < data.length; i++) {
        const li = document.createElement('li');
        li.innerHTML= data[i]['exercise_name'];
        dataViewer.appendChild(li);
    }
}

/* Adding a exercise */
/* let addExerciseForm = document.querySelector('.addExerciseForm');
if(addExerciseForm != null){
    document.querySelector('.addExerciseForm').addEventListener("submit", function(event){
        event.preventDefault()
        let exercise_name = document.querySelector('#exerciseName').value;
        let select = document.querySelector('#muscleGroup');
        let muscle = select.value;
        let description = document.querySelector('#description').value;
        let bg_img = null;
        let action = 'addExercise';
        fetch('../formValidation/formhandler.php', {
            method: "POST",
            body: new URLSearchParams(
                {
                    'exercise_name': exercise_name, 
                    'muscle_group': muscle, 
                    'action': action, 
                    'description': description,
                    'bg_img': bg_img
                } 
            )
        }).then((response) => response.json()).then((res)=>{
            let exerciseList = document.querySelector('.exercise_wrapper');
            //reset innerHTML
            exerciseList.innerHTML = "";
            res.forEach(element => {
                let exerciseElement = 
                    "<div class='exercise' style=' background-size:cover; background-position:center; background-image: url(" + element['background_image'] + ")'>" + 
                        "<h2>"+element['exercise_name']+"</h2>" +
                        "<div class='layer' style='position:absolute; top:0; left:0'></div>" +
                        "<p class='label' style='background-color: " + element['label_color'] + "'>" + element['muscle_name'] + "</p>" +
                    "</div>";
                exerciseList.innerHTML+=exerciseElement;
            });
        });
    });
    window.onload = getMuscleGroups;
} */

//Edit a Workout
let addFormButton = document.querySelector('.add_exercise_button');
let insertExercise = document.querySelector('.insertExerciseToWorkout');
if (addFormButton != null) {
    addFormButton.addEventListener('click', (e)=> {
        e.preventDefault();
        if (insertExercise.style.display == 'none' || insertExercise.style.display == '') {
            insertExercise.style.display = 'flex';
        } else {
            insertExercise.style.display = 'none';
        }
    })
}



if(insertExercise != null){
    document.querySelector('.insertExerciseToWorkout').addEventListener("submit", function(event){
        event.preventDefault();
        let exercise_id = document.querySelector('#edit_workout_exercise_id').value;
        let workout_id = document.querySelector('#edit_workout_workout_id').value;
    
        let user_id = document.querySelector('#edit_workout_user_id').value;
        let sets = document.querySelector('#edit_workout_sets').value;
        let reps = document.querySelector('#edit_workout_reps').value;
        let weight = document.querySelector('#edit_workout_weight').value;
        let action = 'insertExerciseToWorkout';

        fetch('../formValidation/formhandler.php', {
            method: "POST",
            body: new URLSearchParams(
                {
                    'exercise_id': exercise_id, 
                    'workout_id': workout_id, 
                    'user_id': user_id, 
                    'sets': sets, 
                    'reps': reps, 
                    'action': action, 
                    'weight': weight
                } 
            )
        }).then((response) => response.json()).then((res)=>{
            reloadTable(res);
        });
    })
}

function reloadTable(res){
    let workoutTable = document.querySelector('.workoutTable tbody');
    workoutTable.innerHTML = "";
    res.forEach(data => {
        workoutTable.innerHTML += 
        "<tr>"+
            "<td>"+data['exercise_name']+"</td>"+
            "<td>"+data['sets']+"</td>"+
            "<td>"+data['reps']+"</td>"+
            "<td>"+data['weight']+"</td>"+
            "<td>"+
                "<button class='delete_btn'><i class='fa-solid fa-trash' data-user_id="+data['user_id']+" data-workout_id="+data['workout_id']+" data-exercise_id=" + data['exercise_id'] + "></i></button>"+
            "</td>"+
        "</tr>";
    });
}

//Delete a exercise from a workout
let tableBody = document.querySelector('table tbody');
if(tableBody != null){
    tableBody.addEventListener("click", function(event){
        
        let target = event.target;
        console.log(target.matches(".fa-solid.fa-trash"));
        if(target.matches(".fa-solid.fa-trash")){
            console.log(target);
            fetch('../formValidation/formhandler.php', {
                method: "POST",
                body: new URLSearchParams(
                    {
                        'exercise_id': target.getAttribute('data-exercise_id'), 
                        'workout_id': target.getAttribute('data-workout_id'), 
                        
                        'user_id': target.getAttribute('data-user_id'), 
                        'action': 'delete_workout_item', 
                    } 
                )
            }).then((response) => response.json()).then((res)=>{
                reloadTable(res);
            });
        }
    });
}

/* Add a Workout */

let workoutList = document.querySelector('.workouts');
if(workoutList != null){
    let submitbtn = document.querySelector('.add_workout_btn');
    submitbtn.addEventListener('click', (e) => {
        e.preventDefault();
        let workout_title = document.querySelector('.workout_title').value;
        let workout_type = document.querySelector('.workout_type').value;
        let workout_description = document.querySelector('.workout_description').value;
        let action = 'insertWorkout';

        fetch('../formValidation/formhandler.php', {
            method: "POST",
            body: new URLSearchParams(
                {
                    'title': workout_title,
                    'description': workout_description,
                    'type': workout_type,
                    'action': action
                } 
            )
        }).then((response) => response.json()).then((res)=>{
            let list = document.querySelector('.list')
            list.innerHTML="";
            let index= 1;
            window.location.reload();
        });
    });
}


//Deleting a Workout from the WorkoutOverview page
let workoutButtons = document.querySelectorAll('.deleteButton');
if (workoutButtons != null) {
    for (let i = 0; i < workoutButtons.length; i++) {
        const workout_delete_button = workoutButtons[i];
        workout_delete_button.addEventListener('click', () => {
        let user_id = workout_delete_button.dataset.user_id;
        let title = workout_delete_button.dataset.title;
        let action = 'deleteWorkout';


        fetch('../formValidation/formhandler.php', {
            method: "POST",
            body: new URLSearchParams(
                {
                    'title': title,
                    'user_id': user_id,
                    'action': action
                } 
            )
            }).then((response) => response.json()).then((res)=>{
                window.location.reload();
            });
        })
    }
}
    

