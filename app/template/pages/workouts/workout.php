<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $workouts = $helper->getWorkouts($_SESSION['user']['user_id']);
    $types = $helper->getWorkoutTypes();
    $paths = $helper->getPaths();
?>
<link rel="stylesheet" href="../../style/workout.css">

<div class="workout-container">

    <div class="workouts">
        <div class="title-container">
            <h1>Workouts</h1>
            <h3><?php echo $_SESSION['user']['user_name']?></h3>
        </div>
        <div class="workout-list">

            <?php if(!empty($workouts)){?>
                <?php foreach($workouts as $workout){?>
                        <div class="workout">
                            <a href="workout_detail.php?workout_id=<?php echo $workout['id'];?>" data-cover_img="<?php echo $workout['path'];?>"><?php echo $workout['workout_name'];?></a>
                            <button class="delete_button" data-user_id="<?php echo $_SESSION['user']['user_id'];?>" data-workout_name="<?php echo $workout['workout_name'];?>"><i class="fa-solid fa-x"></i></button>
                        </div>
                <?php }?>
            <?php }?>
        </div>

    </div>
    <div class="img-container workout-cover-img-container">
        <img src="#" alt="">
        <div class="layer"></div>
    </div>
</div>

<div class="add_exercise_container">
    <form action="" id="add_workout_form" method="post">
        <div class="input-container">
            <label for="workout_name"><?php echo $helper->getLanguageString('WORKOUT_TITLE', $_SESSION['user']['language']); ?></label>
            <input name="name" id="workout_name" type="text" placeholder="<?php echo $helper->getLanguageString('WORKOUT_TITLE', $_SESSION['user']['language']); ?>">
        </div>
        <div class="input-container">
            <label for="desc"><?php echo $helper->getLanguageString('WORKOUT_DESCRIPTION', $_SESSION['user']['language']); ?></label>
            <input name="description" type="text" id="desc" placeholder="<?php echo $helper->getLanguageString('WORKOUT_DESCRIPTION', $_SESSION['user']['language']); ?>">
        </div>
        <div class="input-container">
            <label for="workout_type"><?php echo $helper->getLanguageString('WORKOUT_TYPE', $_SESSION['user']['language']); ?></label>
            <select name="workout_type" id="workout_type">
                <?php foreach($types as $workout_type){?>
                    <option value="<?php echo $workout_type['id']?>"><?php echo $workout_type['name']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="input-container">
            <label for="workout_img"><?php echo $helper->getLanguageString('WORKOUT_IMG', $_SESSION['user']['language']); ?></label>
            <select name="workout_img" id="workout_img">
                <?php foreach($paths as $path){?>
                    <option value="<?php echo $path['img_id']?>"><?php echo $path['path']?></option>
                <?php } ?>
            </select>
        </div>
        <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['user']['user_id']; ?>">



        <button type="submit" id="workout_add">
            <?php echo $helper->getLanguageString('SUBMIT', $_SESSION['user']['language']); ?>
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initializeLinks();
    })
    let workout_add = document.querySelector('#add_workout_form');
    workout_add.addEventListener('submit', (e) => {
        e.preventDefault();
        let name = document.querySelector('#workout_name').value;
        let user = document.querySelector('#user_id').value;
        let description = document.querySelector('#desc').value;
        let type_element = document.querySelector('#workout_type');
        let workout_img_element = document.querySelector('#workout_img');
        let workout_img = workout_img_element.options[workout_img_element.selectedIndex].value;
        let type = type_element.options[type_element.selectedIndex].value;
        console.log(name);
        addWorkout(name, user, type, description, workout_img);

    });

    function initializeLinks() {
        let cover_image = document.querySelector('.workout-cover-img-container img');
        let workout_links = document.querySelectorAll('.workout-list a');
        let delete_buttons = document.querySelectorAll('.delete_button');

        for (let i = 0; i < delete_buttons.length; i++) {
            let delete_button = delete_buttons[i];
            delete_button.addEventListener('click', (e) => {
                e.preventDefault();
                let workout_name = delete_button.dataset.workout_name;
                let user_id = delete_button.dataset.user_id;
                deleteWorkout(workout_name, user_id);

            });
        }

        for (let i = 0; i < workout_links.length; i++) {

            let workout_link = workout_links[i];
            let img_source = workout_link.dataset.cover_img;
            console.log(img_source)
            workout_link.addEventListener('mouseover', () => {
                cover_image.opacity=1;
                cover_image.src = img_source;
            });

            workout_link.addEventListener('mouseleave', () => {
                cover_image.opacity= 0;
                cover_image.display= 'none';
                cover_image.src = '';
            })
        }

    }

    async function deleteWorkout(workout_name, user_id) {
        await fetch('../../../services/form_handler.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body:
                JSON.stringify({
                    user_id: user_id,
                    workout_name: workout_name,
                    page: 'workout',
                    action:  'delete_workout'
                })
        }).then(response => response.json()).then(data => {

            let workout_links_container = document.querySelector('.workout-list');
            workout_links_container.innerHTML ="";
            let html = '';
            for (let workout of data) {
                html +="<div class='workout'>" +
                    "<a href='workout_detail.php?workout_id="+workout['workout_id']+"' data-cover_img='"+workout['path']+"'>"+ workout['workout_name'] +"</a>" +
                    "<button class='delete_button' data-user_id='"+workout['user_id']+"' data-workout_id='"+workout['workout_id']+"'><i class='fa-solid fa-x'></i></button>"

                    +"</div>";
            }
            workout_links_container.innerHTML=html;
        });
        initializeLinks();
    }

    async function addWorkout(name, user, type, desc, workout_img) {
            await fetch('../../../services/form_handler.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body:
                    JSON.stringify({
                        name: name,
                        workout_type: type,
                        description: desc,
                        user: user,
                        workout_img: workout_img,
                        page: 'workout',
                        action:  'add_workout'
                    })
            }).then(response => response.json()).then(data => {

                let workout_links_container = document.querySelector('.workout-list');
                workout_links_container.innerHTML ="";
                let html = '';
                for (let workout of data) {
                    html +="<div class='workout'>" +
                        "<a href='workout_detail.php?workout_id="+workout['id']+"' data-cover_img='"+workout['path']+"'>"+ workout['workout_name'] +"</a>" +
                        "<button class='delete_button' data-user_id='"+workout['user_id']+"' data-workout_id='"+workout['id']+"'><i class='fa-solid fa-x'></i></button>"

                    +"</div>";
                }
                workout_links_container.innerHTML=html;
            });
            initializeLinks();
    }
</script>