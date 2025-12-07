<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Send verification email with PHPMailer.
 *
 * @throws RuntimeException|Exception
 */
function sendVerificationEmail(string $toEmail, string $toName, string $token): void
{
    $smtpHost = env('SMTP_HOST');
    $smtpUser = env('SMTP_USER');
    $smtpPass = env('SMTP_PASSWORD');
    $smtpPort = (int) env('SMTP_PORT', 587);
    $fromEmail = env('SMTP_FROM_EMAIL', $smtpUser ?: 'no-reply@example.com');
    $fromName = env('SMTP_FROM_NAME', 'FP PWEB App');

    if (!$smtpHost || !$smtpUser || !$smtpPass) {
        throw new RuntimeException(
            'SMTP configuration missing. Set SMTP_HOST, SMTP_USER, SMTP_PASSWORD, SMTP_PORT, SMTP_FROM_EMAIL, SMTP_FROM_NAME.'
        );
    }

    $verifyUrl = appBaseUrl() . '/pages/authentication/verify.php?token=' . urlencode($token) . '&email=' . urlencode($toEmail);

    $mailer = new PHPMailer(true);
    $mailer->isSMTP();
    $mailer->Host = $smtpHost;
    $mailer->SMTPAuth = true;
    $mailer->Username = $smtpUser;
    $mailer->Password = $smtpPass;
    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailer->Port = $smtpPort;

    $mailer->setFrom($fromEmail, $fromName);
    $mailer->addAddress($toEmail, $toName ?: $toEmail);

    $mailer->isHTML(true);
    $mailer->Subject = 'Verifikasi Email Akun Anda';
    $mailer->Body = sprintf(
        'Halo %s,<br><br>Silakan verifikasi email Anda dengan klik tautan berikut: <a href="%s">Verifikasi Email</a>.<br><br>Jika tautan di atas tidak bisa diklik, salin dan buka URL ini: %s',
        htmlspecialchars($toName ?: $toEmail, ENT_QUOTES, 'UTF-8'),
        $verifyUrl,
        $verifyUrl
    );
    $mailer->AltBody = "Halo {$toName},\n\nSilakan verifikasi email Anda: {$verifyUrl}";

    $mailer->send();
}
