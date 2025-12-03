<?php include "data/course-data.php"?>

<div class="d-flex flex-column gap-4">
    <div class="d-flex flex-row gap-3 mt-4 justify-content-between">
        <div class="course-box p-4 " style="flex: 1 1 0;">
            <p class="my-0 pb-2" style="color: grey;">Hari ini: Minggu, 30 September 2025</p>
            <h5>Pekan Perkuliahan ke-<?=$current_week?></h5>
        </div>
        <div class="course-box p-4 " style="flex: 1 1 0;">
            <p class="my-0 pb-2" style="color: grey;">Kuliah yang akan datang</p>
            <h5><?=$next_course['code'] . ' - ' . $next_course['name']?></h5>
        </div>
    </div>
    <div class="course-box p-4" style="flex: 1 1 0; text-align: center;">
        <h3> Daftar Kuliah Anda Semester Gasal 2025/2026</h3>
    </div>
    <div class="d-flex flex-column course-box gap-0" style="flex: 1 1 0;">
        <?php foreach ($courses as $c) {
            include "includes/course.php";
        } ?>
    </div>
</div>