<?php
$code = $_GET['code'] ?? null;

include "data/course-data.php"; 
$course = null;
foreach ($courses as $c) {
    if ($c['code'] === $code) {
        $course = $c;
        break;
    }
}

?>

<div class="d-flex flex-column">
    <div class="d-flex flex-column white-box mt-4 gap-0">
        <div class="d-flex flex-column gap-0 pt-3 px-4 mb-0">
            <div class="d-flex flex-row gap-2 mb-0">
                <p class="mb-1"><?=$course['code']?></p>
                <p class="mb-0" style="color: #866fd8;"><?=$course['name']?></p>
            </div>
            <div class="row w-75">
                <div class="d-flex flex-row gap-2 col-2">
                    <img src="img/icon/calendar-icon.svg" alt="">
                    <p class="p-0 m-0"><?= $course['day'] ?></p>
                </div>
                <div class="d-flex flex-row gap-2 col-2">
                    <img src="img/icon/time-icon.svg" alt="">
                    <p class="p-0 m-0"><?= $course['time'] ?></p>
                </div>
                <div class="d-flex flex-row gap-2 ms-4 col-2">
                    <img src="img/icon/building-icon.svg" alt="">
                    <p class="p-0 m-0"><?= $course['room'] ?></p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mt-0 pb-3 px-4">
            <p class="mb-0 mt-3">Dosen: </p>
            <div class="d-flex mt-0 flex-row gap-2">
                <img class="m-0" src="img/icon/person-icon.svg" alt="">
                <p class="p-0 m-0"><?= $course['lecturer'] ?></p>
            </div>
        </div>
    </div>

    <div class="accordion pb-3 mb-3 mt-4" id="myAccordion">
        <?php for ($num = 1; $num <= 16; $num++): 
            include "includes/section.php";
        endfor;
            ?>
    </div>
</div>
