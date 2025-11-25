<?php

include_once(ROOT.'login/classes/forgot.class.php');

$forgot = new Forgot;

// This is for the modal forgotten password form on login.php
// This must be called before the header
if(isset($_POST['usernamemail'])) {
	$forgot->modal_process();
	exit();
}

$forgot->process();
