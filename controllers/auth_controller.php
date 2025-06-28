<?php
session_start();

if ($_GET['fitur'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: pages/login.php');
    exit;
}
