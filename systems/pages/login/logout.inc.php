<?php

session_start();
session_unset();
session_destroy();

header("Location: userAuth.inc.php");
die();