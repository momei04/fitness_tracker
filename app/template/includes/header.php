<?php
if (!isset($_SESSION) || !isset($_SESSION['user']) || !isset($_SESSION['user']['user_id'])) {
    header('location: ../../pages/userAuth/userAuth.php');
    die();
}
    include_once '../../../services/classes/Helper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../style/index.css">
    <link rel="stylesheet" href="../../style/modal.css">
    <link rel="stylesheet" href="../../style/form.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../../js/components/modal.js"></script>
</head>
<body>
    <div class="content">
        <?php include_once 'sidebar.php'?>
        <div class="main">
