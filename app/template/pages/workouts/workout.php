<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    //var_dump($_SESSION);
    $workouts = $helper->getWorkouts($_SESSION['user']['user_id']);
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
                <a href="workout_detail.php?workout_id=<?php echo $workout['id'];?>" data-cover_img="<?php echo $workout['path'];?>"><?php echo $workout['workout_name'];?></a>
                <?php }?>
            <?php }?>
        </div>

    </div>
    <div class="img-container workout-cover-img-container">
        <img src="#" alt="">
        <div class="layer"></div>
    </div>
</div>

<script>
    let img_container = document.querySelector('.workout-cover-img-container');
    let cover_image = document.querySelector('.workout-cover-img-container img');
    let workout_links = document.querySelectorAll('.workout-list a');

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
</script>