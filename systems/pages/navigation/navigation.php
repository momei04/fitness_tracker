<?php
    require_once('../../classes/Workout.php');
    $workout = new Workout();
?>

    <div class="nav-btn">
        <i class="fa-solid fa-bars"></i>
    </div>
    <nav>
        <img src="https://i.pinimg.com/originals/03/98/81/03988170435a09badd13521a964ab99e.png" class="logo" alt="">
        <ul>
            <li>
                <a href="../../pages/workout/workoutOverview.php"><?php $workout->getLanguageString('WORKOUTS', $_SESSION['language_id'])?></a>
            </li>
            <li>
                <a href="../../pages/exercises/exercises.php"><?php $workout->getLanguageString('EXERCISES', $_SESSION['language_id'])?></a>
            </li>
            <li>
                <a href="../../pages/stats/stats.php"><?php $workout->getLanguageString('STATS', $_SESSION['language_id'])?></a>
            </li>
            <li>
                <a href="../../pages/settings/settings.php"><?php $workout->getLanguageString('SETTINGS', $_SESSION['language_id'])?></a>
            </li>
            <li>
                <a href="../../pages/login/userAuth.inc.php"><?php $workout->getLanguageString('LOGOUT', $_SESSION['language_id'])?></a>
            </li>
        </ul>
    </nav>
<script>
    let navBtn = document.querySelector('.nav-btn');
    let closeBtn = document.querySelector('.close-btn')
    let nav = document.querySelector('nav');
    navBtn.addEventListener('click', (e)=>{
        e.preventDefault();
        nav.classList.toggle('open');
        navBtn.classList.toggle('close-btn');
    });
    if(closeBtn != null){
        closeBtn.addEventListener('click', (e)=>{
            e.preventDefault();
            
            if(nav.classList.contains('open')){
                navBtn.classList.remove('close-btn');
                nav.classList.remove('open');
            }
            
        });
    }
    
</script>
