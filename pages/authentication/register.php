<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/mailer.php';
require_once __DIR__ . '/../../includes/hcaptcha.php';

$errors = [];
$infoMessage = '';
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$siteKey = hcaptchaSiteKey();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $captchaToken = $_POST['h-captcha-response'] ?? '';
    $remoteIp = $_SERVER['REMOTE_ADDR'] ?? null;

    if ($username === '') {
        $errors[] = 'Username wajib diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Password minimal 6 karakter.';
    }
    if (!verifyHCaptcha($captchaToken, $remoteIp)) {
        $errors[] = 'Verifikasi hCaptcha gagal. Silakan coba lagi.';
    }

    if (!$errors) {
        $pdo = getDb();
        $stmt = $pdo->prepare('SELECT id, verified_at FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing && $existing['verified_at']) {
            $errors[] = 'Email sudah terdaftar dan terverifikasi. Silakan login.';
        } else {
            $token = bin2hex(random_bytes(32));
            $now = date('c');
            $hash = password_hash($password, PASSWORD_DEFAULT);

            if ($existing) {
                $update = $pdo->prepare('UPDATE users SET username = :username, password_hash = :password_hash, verification_token = :token, verified_at = NULL, updated_at = :updated_at WHERE id = :id');
                $update->execute([
                    'username' => $username,
                    'password_hash' => $hash,
                    'token' => $token,
                    'updated_at' => $now,
                    'id' => $existing['id'],
                ]);
            } else {
                $insert = $pdo->prepare('INSERT INTO users (username, email, password_hash, verification_token, verified_at, created_at, updated_at) VALUES (:username, :email, :password_hash, :token, NULL, :created_at, :updated_at)');
                $insert->execute([
                    'username' => $username,
                    'email' => $email,
                    'password_hash' => $hash,
                    'token' => $token,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            try {
                sendVerificationEmail($email, $username, $token);
                $infoMessage = 'Registrasi berhasil. Silakan cek email untuk verifikasi.';
            } catch (Throwable $e) {
                $errors[] = 'Registrasi disimpan, tetapi gagal mengirim email: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/login.css">
</head>
<body>
    <div class="min-vh-100 w-100 d-flex justify-content-center align-items-center">
        <div class="login-box d-flex flex-column gap-4 justify-content-center align-items-center p-5">
            <img class="logo" src="../../img/icon/logo.svg" alt="">
            <div class="mt-5 w-75">
                <?php if ($infoMessage): ?>
                    <div class="alert alert-success" role="alert"><?= htmlspecialchars($infoMessage, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <?php if ($errors): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <div><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="register.php" novalidate>
                    <div class="my-4 form-login d-flex flex-row py-3">
                        <div class="icon-login mx-3 d-flex justify-content-end px-2">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/user-icon.svg");?>
                        </div>
                        <input type="text" class="form-control m-0 p-0" name="username" placeholder="Username" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="my-4 form-login d-flex flex-row py-3">
                        <div class="icon-login mx-3 d-flex justify-content-end px-2">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/mail-simpler.svg");?>
                        </div>
                        <input type="email" class="form-control m-0 p-0" name="email" placeholder="Email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="my-4 form-login d-flex flex-row py-3">
                        <div class="icon-login mx-3 d-flex justify-content-end px-2">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/lock-icon.svg");?>
                        </div>
                        <input type="password" class="form-control m-0 p-0" name="password" placeholder="Password" required>
                    </div>
                    <div class="my-3">
                        <div class="h-captcha" data-sitekey="<?= htmlspecialchars($siteKey, ENT_QUOTES, 'UTF-8') ?>"></div>
                    </div>
                    <button type="submit" class="mt-4 btn-login w-100 py-3">Sign up</button>
                    <div class="d-flex flex-row gap-2 justify-content-center mt-3">
                        <?php $authDir = dirname($_SERVER['PHP_SELF']); ?>
                        <p style="font-size: 1.2rem;">Already have an account?</p>
                        <a href="<?= $authDir ?>/login.php" style="font-size: 1.2rem; text-decoration: none; font-weight: 600;"> Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</html>
