<?php
require_once __DIR__ . '/../../includes/database.php';

$errors = [];
$infoMessage = '';

$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

if (!$token || !$email) {
    $errors[] = 'Token atau email tidak ditemukan.';
} else {
    $pdo = getDb();
    $stmt = $pdo->prepare('SELECT id, verified_at FROM users WHERE email = :email AND verification_token = :token LIMIT 1');
    $stmt->execute([
        'email' => $email,
        'token' => $token,
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $errors[] = 'Token tidak valid atau sudah digunakan.';
    } elseif ($user['verified_at']) {
        $infoMessage = 'Email sudah terverifikasi. Silakan login.';
    } else {
        $now = date('c');
        $update = $pdo->prepare('UPDATE users SET verified_at = :verified_at, verification_token = NULL, updated_at = :updated_at WHERE id = :id');
        $update->execute([
            'verified_at' => $now,
            'updated_at' => $now,
            'id' => $user['id'],
        ]);
        $infoMessage = 'Email berhasil diverifikasi. Silakan login.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
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

                <div class="d-flex flex-row gap-2 justify-content-center mt-3">
                    <?php $authDir = dirname($_SERVER['PHP_SELF']); ?>
                    <a class="btn btn-primary" href="<?= $authDir ?>/login.php">Ke halaman login</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
