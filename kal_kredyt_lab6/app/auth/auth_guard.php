<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if (empty($role)) {
    header('Location: ' . $config->action_url . 'login');
    exit();
}
