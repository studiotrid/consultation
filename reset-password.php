<?php
// reset-password.php

require_once 'includes.php';
require_once 'inc/functions.php';
require_once 'inc/class/Login.class.php';


$message = '';
$status = 'error';
$token = $_GET['token'] ?? $_POST['token'] ?? '';


if (!$token) {
    $message = 'Token nije validan.';
    $smarty->assign('message', $message);
    $smarty->assign('status', $status);
    $smarty->assign('token', $token);
    $smarty->assign("content", $smarty->fetch('reset-password.tpl'));
    $smarty->display('layout.tpl');
    exit;
}

// Proveri token u bazi

$reset = Database::obtain()->query_first("SELECT * FROM password_resets WHERE token='" . $token . "'");
if (!$reset) {
    $message = 'Token nije validan ili je istekao.';
    $smarty->assign('message', $message);
    $smarty->assign('status', $status);
    $smarty->assign('token', $token);
    $smarty->assign("content", $smarty->fetch('reset-password.tpl'));
    $smarty->display('layout.tpl');
    exit;
}
$email = $reset['email'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = trim($_POST['password'] ?? '');
    if (strlen($password) < 6) {
        $message = 'Šifra mora imati najmanje 6 karaktera.';
    } else {
        // Updejtuj šifru u bazi za korisnika
        $stmt = Database::obtain()->query("UPDATE korisnici SET password='" . md5($password) . "' WHERE email='" . $email . "'");
        // Obriši token iz baze
        Database::obtain()->query("DELETE FROM password_resets WHERE token='" . $token . "'");
        $message = 'Šifra je uspešno promenjena.';
        $status = 'ok';
        header('Location: index.php');
        exit;
    }
    $smarty->assign('message', $message);
    $smarty->assign('status', $status);
} else {
    // Token je validan, prikaži formu
    $status = 'ok';
}

$smarty->assign('token', $token);
$smarty->assign('status', $status);
$smarty->assign("content", $smarty->fetch('reset-password.tpl'));
$smarty->display('layout.tpl');

if (isset($db) && method_exists($db, 'close')) {
    $db->close();
}
