<?php
$email="naufaldaffa@awikwok.com"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/FP-PWEB/styles/login.css"> 
</head>
<body>
    <div class="min-vh-100 w-100 d-flex justify-content-center align-items-center">
        <div class="login-box d-flex flex-column gap-4 justify-content-center align-items-center p-5">
            <img class="logo" src="/FP-PWEB/img/icon/logo.svg" alt="">
            <div class="mt-3 w-75">
                <form>
                    <div class="d-flex flex-column align-items-center gap-0 mb-4">
                        <h2 style="font-weight: 700;">
                            Check your email
                        </h2>
                        <h6 class="p-0 mt-5"style="text-align: center; font-weight: 500">
                            We sent a password reset link to
                        </h6>
                        <h5 style="font-weight: 500">
                            <?=$email?>
                        </h5>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3">
                        <p>Didn't receive the email? </p>
                        <button type="submit" class="btn-resend w-50 py-2">Resend email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>