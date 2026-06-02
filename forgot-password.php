<?php
// forgot-password.php
require_once 'includes.php';
require_once 'inc/functions.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $message = '';
    $status = 'error';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Proveri da li email postoji u bazi
        $korisnik = Database::obtain()->query_first("SELECT * FROM korisnici WHERE email='" . $email . "'");
        if ($korisnik) {
            // Generiši token
            $token = bin2hex(random_bytes(32));
            // Sačuvaj token u bazi
            $stmt = Database::obtain()->query("INSERT INTO password_resets (email, token, created_at) VALUES ('" . $email . "', '" . $token . "', NOW())");
            // Pripremi link
            $resetLink = 'https://' . $_SERVER['HTTP_HOST'] . '/reset-password.php?token=' . $token;
            // Pošalji email preko PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPDebug = 0; // Uklonjen debug output
                $mail->Host = 'coach.profesionalnaastrologija.com'; // SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'info@consultation.profesionalnaastrologija.com'; // SMTP username
                $mail->Password = '7zatr9MXox'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('info@consultation.profesionalnaastrologija.com', 'Consultation Portal');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password reset';
                $mail->Body = "Poštovani,<br><br>Primili smo zahtev za resetovanje lozinke za vaš nalog na Consultation Portal.<br><br>Da biste postavili novu lozinku, kliknite na sledeći link:<br><a href='$resetLink'>$resetLink</a><br><br>Ako niste vi tražili reset lozinke, slobodno ignorišite ovaj email.<br><br>Srdačan pozdrav,<br>Consultation Portal tim";
                $mail->AltBody = "Poštovani,\n\nPrimili smo zahtev za resetovanje lozinke za vaš nalog na Consultation Portal.\n\nDa biste postavili novu lozinku, kliknite na sledeći link: $resetLink\n\nAko niste vi tražili reset lozinke, slobodno ignorišite ovaj email.\n\nSrdačan pozdrav,\nConsultation Portal tim";
                $mail->send();
                $message = 'Link za reset lozinke je poslat na email.';
                $status = 'ok';
            } catch (Exception $e) {
                $message = 'Email nije poslat. Greška: ' . $mail->ErrorInfo;
            }
        } else {
            $message = 'Email nije pronađen.';
        }
    } else {
        $message = 'Unesite validan email.';
    }
    // Prikaz poruke
    $smarty->assign('message', $message);
    $smarty->assign('status', $status);
    $smarty->assign("content", $smarty->fetch('forgot-password.tpl'));
    $smarty->display('layout.tpl');
    exit;
}
$smarty->assign("content", $smarty->fetch('forgot-password.tpl'));
$smarty->display('layout.tpl');
