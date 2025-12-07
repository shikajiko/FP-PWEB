<?php
require_once __DIR__ . '/../../includes/database.php';
require_once __DIR__ . '/../../includes/hcaptcha.php';

$errors = [];
$infoMessage = '';
$email = trim($_POST['email'] ?? '');
$hardcodedUser = [
    'username' => 'admin',
    'email' => 'admin@gmail.com',
    'password' => 'password',
];
$siteKey = hcaptchaSiteKey();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $captchaToken = $_POST['h-captcha-response'] ?? '';
    $remoteIp = $_SERVER['REMOTE_ADDR'] ?? null;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }
    if ($password === '') {
        $errors[] = 'Password wajib diisi.';
    }
    if (!verifyHCaptcha($captchaToken, $remoteIp)) {
        $errors[] = 'Verifikasi hCaptcha gagal. Silakan coba lagi.';
    }

    if (!$errors) {
        // Allow hardcoded admin login without DB
        if ($email === $hardcodedUser['email'] && $password === $hardcodedUser['password']) {
            $basePath = dirname($_SERVER['SCRIPT_NAME'] ?? '/', 3);
            $basePath = ($basePath === '/' || $basePath === '\\') ? '' : rtrim($basePath, '/');
            $target = $basePath . '/index.php?page=dashboard';
            header('Location: ' . $target);
            exit;
        }

        $pdo = getDb();
        $stmt = $pdo->prepare('SELECT id, username, password_hash, verified_at FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors[] = 'Email atau password salah.';
        } elseif (!$user['verified_at']) {
            $errors[] = 'Email belum diverifikasi. Silakan cek inbox Anda.';
        } else {
            // Redirect to dashboard on successful login
            $basePath = dirname($_SERVER['SCRIPT_NAME'] ?? '/', 3); // strip /pages/authentication
            $basePath = ($basePath === '/' || $basePath === '\\') ? '' : rtrim($basePath, '/');
            $target = $basePath . '/index.php?page=dashboard';
            header('Location: ' . $target);
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/login.css"> 
</head>
<body>
    <div class="min-vh-100 w-100 d-flex justify-content-center align-items-center">
        <div class="login-box d-flex flex-column gap-4 justify-content-start align-items-center p-5">
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

                <form method="POST" action="login.php" novalidate>
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
                    <div class="d-flex flex-row justify-content-end px-3">
                        <a href="" style="text-decoration: none; font-size: 1.1rem; font-weight: 600; ">Forgot Password?</a>
                    </div>
                    <button type="submit" class="mt-4 btn-login w-100 py-3">Sign in</button>
                    <div class="d-flex flex-row gap-2 justify-content-center mt-3">
                        <?php $authDir = dirname($_SERVER['PHP_SELF']); ?>
                        <p style="font-size: 1.2rem;">Don't have an account?</p>
                        <a href="<?= $authDir ?>/register.php" style="font-size: 1.2rem; text-decoration: none; font-weight: 600;"> Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</html>
