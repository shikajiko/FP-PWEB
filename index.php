<?php
$currentPage = $_GET['page'] ?? 'dashboard';  

$allowedPages = ['dashboard', 'courses', 'tasks', 'profile'];
if (!in_array($currentPage, $allowedPages)) {
    $currentPage = 'dashboard';
}
$cssPath = "styles/" . $currentPage . ".css";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/globals.css">
        <?php if (file_exists($cssPath)): ?>
        <link rel="stylesheet" href="<?= $cssPath ?>">
    <?php endif; ?>
    <title><?= ucfirst($currentPage) ?></title>
</head>
<body>
    <div class="container-fluid p-0 main-container">
  <div class="row p-0">
    <div class="col-auto p-0">
      <?php include "includes/sidebar.php"; ?>
    </div>
    <div class="col d-flex flex-column px-5">    
      <?php include "includes/header.php"; ?>
      <?php include "pages/" . $currentPage . ".php"; ?>
    </div>
  </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>