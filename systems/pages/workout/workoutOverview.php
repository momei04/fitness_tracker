<?php
    include('../includes/header.php');
    require_once('../../classes/Workout.php');
    require_once('../../classes/User.php');
    $workoutClass = new Workout();
    $user = new User();
?>
<link rel="stylesheet" href="../../style/workoutOverview.css">
    <!-- advanced Slider -->
    <!-- Carusel -->
    <div class="content">
        <div class="workouts">
            <div class="title-container">
                <h2><?php $workout->getLanguageString('MY_WORKOUTS', $_SESSION['language_id'])?></h2>
                <h6><?php echo $_SESSION['username'];?></h6>
            </div>
        
            <div class="list">
                <?php
                    $workouts = $workoutClass->getWorkoutsByUserId($_SESSION['user_id']);
                    $index = 1;
                    foreach ($workouts as $workout){?>
                    <div class="item" data-source="<?php echo $workout['path'] ?>">
                        <a href="workout.php?workout_id=<?php echo $workout['workout_id']; ?>">
                            <div class="number">
                                <h3 data-index=<?php echo $index;?>><?php echo 0 . $index; $index++; ?></h3>
                            </div>
                            <div class="title" data-title="<?php echo $workout['workout_name'];?>" >
                                <h3><?php echo $workout['workout_name'];?></h3>
                            </div>
                            
                        </a>
                        <button data-title="<?php echo $workout['workout_name'];?>" data-user_id="<?php echo $_SESSION['user_id'];?>" class="deleteButton">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                        
                    <?php } ?>
            </div>

            <div class="add-workout">
                <div class="addWrapper">
                    <button class="addBtn">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <p>Add a workout</p>
                </div>
                    
                <form action="" method="post" class="addForm">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="text" class="workout_title" name="workout_title" placeholder="<?php $workoutClass->getLanguageString('WORKOUT_TITLE', $_SESSION['language_id']); ?>" id="">
                    <select class="workout_type">
                        <?php 
                        $workoutTypes = $workoutClass->getWorkoutTypes();
                        foreach($workoutTypes as $type){?>
                            <option value="<?php echo $type['workout_type_id']?>"><?php echo $type['workout_type_name']?></option>
                        <?php }?>
                    </select>
                    <textarea type="text" class="workout_description" placeholder="<?php $workoutClass->getLanguageString('DESCRIPTION', $_SESSION['language_id']); ?>"></textarea>

                    <button type="submit" class="add_workout_btn">
                        <?php $workoutClass->getLanguageString('ADD_WORKOUT', $_SESSION['language_id']); ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="img-container">
            <img src="" alt="" srcset="">
        </div>
    </div>
    
    <script>

        // showing the add oa workout form
        let addForm = document.querySelector('.addForm');
        let addButton = document.querySelector('.addWrapper');
        addButton.addEventListener('click', (e) => {
            e.preventDefault();
            addForm.classList.toggle('show');
        });
        //changin image when hovering item
        let itemList = document.querySelectorAll('.item');
        let img = document.querySelector('.img-container img');
        for (let i = 0; i < itemList.length; i++) {
            const item = itemList[i];
            item.addEventListener("mouseover", ()=>{
            
                item.style.opacity=1;
                img_src = item.dataset.source
                img.src=img_src;
                img.style.display='block';
                let workout_delete_button = item.querySelector('.deleteButton');

                workout_delete_button.style.opacity=1;
                workout_delete_button.style.display='block';
                workout_delete_button.style.overflow='visible';
            })

            item.addEventListener("mouseleave", ()=>{
                console.log(item);
                item.style.opacity=.5;
                img.backgroundColor='var(--gray)';
                img.src='';
                img.style.display='none';
                let workout_delete_button = item.querySelector('.deleteButton');

                workout_delete_button.style.opacity=0;
                workout_delete_button.style.display='none';
                workout_delete_button.style.overflow='hidden';

            });
        }
    </script>

<?php
    include('../includes/footer.php');
?>