<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/globals.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid p-0 main-container">
  <div class="row p-0">
    <div class="col-auto p-0">
      <?php include "includes/sidebar.php"; ?>
    </div>
    <div class="col d-flex flex-column px-5">    
      <?php include "includes/header.php"; ?>
      <div class="d-flex flex-row gap-5 w-100"> 
        <div class="d-flex flex-column" style="flex: 2 1 0;">
          <div class="mt-5">
            <?php include "includes/carousel.php"; ?>
          </div>
          <div class="courses-container d-flex flex-column mt-5 px-4 pt-3 pb-4">
            <h2>My Courses</h2>
            <div class="d-flex flex-row justify-content-between gap-3">
              <?php include "includes/course-card.php"; ?>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column home-right-panel py-3 mt-4" style="flex: 1 1 0;">
          <div></div>
          <div class="task-container d-flex flex-column"></div>
        </div>
      </div>                 
    </div>
  </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>