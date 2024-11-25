/*Workout Completion Rate*/
let workout_ratio = document.querySelector('.workout_ratio');
let percentage = workout_ratio.dataset.done_percentage;
new Chart("workouts_done", {
    type: "doughnut",
    data: {
        label: 'Done Workouts',
        datasets: [{
            backgroundColor: ['#eb3d00', '#b8b8b8'],
            data: [percentage, 100 -percentage]
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Done Workouts this month',
                font: {
                    size: 24
                }
            }
        },
        circumference: 180,
        rotation: -90
    }
});

/*Most Exercises in a month*/
most_exercises_elements = document.querySelectorAll('.most_exercise');
let data = [];
let labels = [];
for (let i = 0; i < most_exercises_elements.length; i++) {
    let data_element = most_exercises_elements[i];
    data.push(data_element.value);
    labels.push(data_element.name);
}

new Chart("exercises_months", {
    type: 'bar',
    data: {
        labels: labels,
        display: false,
        datasets: [{
            data: data,
            backgroundColor: ['#eb3d00', '#b8b8b8', '#b8b8b8', '#b8b8b8', '#b8b8b8']
        }]
    },
    options: {
        padding: 24,
        plugins: {
            title: {
                display: true,
                text: 'Most done Exercises',
                font: {
                    size: 24
                }
            }
        }
    }

});

/*Most trained Muscle Groups*/

let most_trained_muscle_elements = document.querySelectorAll('.most_trained_muscle');
let muscle_data = [];
let muscle_labels = [];
for (let i = 0; i < most_trained_muscle_elements.length; i++) {
    let muscle = most_trained_muscle_elements[i];
    muscle_data.push(muscle.value);
    muscle_labels.push(muscle.name);
}

new Chart("must_trained_muscles", {
    type: 'bar',
    data: {
        labels: muscle_labels,
        display: false,
        datasets: [{
            data: muscle_data,
            backgroundColor: ['#eb3d00', '#b8b8b8']
        }]
    },
    options: {
        padding: 24,
        plugins: {
            title: {
                display: true,
                text: 'Most exercised Muscle Groups',
                font: {
                    size: 24
                }
            }
        }
    }

});