<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/globals.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <link rel="stylesheet" href="styles/header.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row p-0">
            <div class="col-auto p-0 overflow-hidden">
                <?php include "includes/sidebar.php"; ?>
            </div>
            <div class="col d-flex flex-column ps-3 pe-5">
                <div>
                    <?php include "includes/header.php"; ?>
                </div>
                <div>
                    main content here
                </div>
            </div>
        </div>
    </div>
</body>
</html>