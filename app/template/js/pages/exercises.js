let insertEventBtn = document.querySelector('#add_exercise');
insertEventBtn.addEventListener('click', (e) => {
    e.preventDefault();
    initializeModal('#add_exercise', '.create_exercise')
})

let exercise_add = document.querySelector('#exercise_add');

async function addExercise(muscle_id, exercise_name, bg_img) {
    await fetch('../../../services/form_handler.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:
            JSON.stringify({
                muscle_id: muscle_id,
                exercise_name: exercise_name,
                bg_img: bg_img,
                page: 'exercise',
                action:  'add_exercise'
            })
    }).then(response => response.json()).then(data => {
        let container = document.querySelector('.exercise_container');
        container.innerHTML ="";
        for (let exercise of data) {
            container.innerHTML +="<div class='grid_item img-container'>"
                +"<h3>"+exercise['exercise_name']+"</h3>"
                +"<div class='layer'></div>"
                +"<img src='"+exercise['background_img']+"'>"
                +"</div>";
        }
    });

}

exercise_add.addEventListener('submit', (e) => {
    e.preventDefault();
    var el = document.getElementById("muscle_group");
    let muscle_id = el.options[el.selectedIndex].value;
    let exercise_name = document.querySelector('#exercise_name').value;
    let bg_img = document.querySelector('#background_img').value;

    addExercise(muscle_id, exercise_name, bg_img)
})