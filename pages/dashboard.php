<?php include "data/course-data.php"?>
<?php include "data/task-data.php"?>

<div class="d-flex flex-row gap-5 w-100"> 
    <div class="d-flex flex-column" style="flex: 2 1 0;">
        <div class="mt-5">
            <?php include "includes/carousel.php"; ?>
        </div>
        <div class="courses-container d-flex flex-column mt-5 px-4 pt-3 pb-4">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h2>My Courses</h2>
                <a href="?page=courses">view all</a>
            </div>
            <div class="d-flex flex-row flex-wrap justify-content-start gap-5 mt-4">
                <?php 
                    $count = 0;
                    foreach ($courses as $course) { 
                        if ($count >= 6) break;
                        include "includes/course-card.php";
                        $count++;
                    }
                    ?>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column home-right-panel py-3 mt-5" style="flex: 1 1 0;">
        <div>
        <!-- to do: add calendar -->
        </div>
        <div class="task-container d-flex flex-column px-4 py-2 gap-3">
            <h5 style="font-weight: 600">Upcoming Tasks</h5>
            <?php 
                foreach ($tasks as $task) {
                    include "includes/task-card.php";
                } 
                ?>

        </div>
    </div>
</div>                 