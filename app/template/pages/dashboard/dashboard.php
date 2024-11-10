<?php
session_start();
    include_once '../../includes/header.php';
?>
    <link rel="stylesheet" href="../../style/dashboard.scss">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Hello <?php echo $_SESSION['user']['first_name']?></h1>
        </div>
        <div class="stats">
            <div class="stat-container"></div>
            <div class="stat-container"></div>
            <div class="stat-container"></div>
        </div>
        <div class="workout"></div>
        <div class="test"></div>
    </div>

<?php
    include_once '../../includes/footer.php';
?>