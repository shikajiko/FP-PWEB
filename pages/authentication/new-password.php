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
        <div class="login-box d-flex flex-column gap-2 justify-content-center align-items-center p-5">
            <img class="logo" src="/FP-PWEB/img/icon/logo.svg" alt="">
            <div class="mt-2 d-flex flex-column align-items-center mt-4 gap-2">
                <h2 style="font-weight: 600">
                    Set New Password
                </h2>
                <h6 style="font-size: 1.1rem; text-align: center;" class="w-75 mb-0"> 
                    Your new password must be different from previously used password
                </h6>
            </div>
            <div class="w-75">
                <form>
                    <div class="my-4 form-login d-flex flex-row py-3">
                        <div class="icon-login mx-3 d-flex justify-content-end px-2">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/lock-icon.svg");?>
                        </div>
                        <input type="password" class="form-control m-0 p-0" id="inputEmail1" placeholder="Password">
                    </div>
                    <div class="my-4 form-login d-flex flex-row py-3">
                        <div class="icon-login mx-3 d-flex justify-content-end px-2">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/lock-icon.svg");?>
                        </div>
                        <input type="password-confirm" class="form-control m-0 p-0" id="inputEmail1" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="mt-4 btn-login w-100 py-3">Reset Password</button>
                    <div class="d-flex flex-row gap-2 justify-content-center mt-3">
                        <div class="d-flex justify-content-end align-items-center">
                            <?php echo file_get_contents(__DIR__ . "/../../img/icon/arrow-back.svg");?>
                        </div>
                        <a href="" style="font-size: 1.2rem; text-decoration: none; color: white;">Back to Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>