<?php
function isActive($name, $current) {
    return $name === $current ? 'sidebar-active' : ' ';
}

function isHidden($name, $current){
    return $name !== $current? 'd-none' : 'd-block';
}
include "data/course-data.php";
?>


<div class="sidebar pt-3 h-100">
    <div class="d-flex flex-column h-100">
        <div class="sidebar-logo mb-5 d-flex flex-row justify-content-center align-items-center">
            <img src="img/logo.png" alt="">
        </div>

        <div class="sidebar-section flex-grow-1 overflow-auto">
            <div class="<?= isActive('course', $currentPage) ?> <?=isHidden('course', $currentPage)?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row align-items-center">
                <?php echo file_get_contents("img/icon/courses-icon.svg"); ?>
                <a href=""><?=$courses[0]['short']?></a>
            </div>
            <?php for ($num = 1; $num <= 16; $num++): ?>
                <div class="<?= isHidden('course', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row align-items-center">
                    <?php echo file_get_contents("img/icon/folder-icon.svg"); ?>
                    <a href="">Section <?= $num ?></a>
                </div>
            <?php endfor; ?>
            <div class="<?= isActive('dashboard', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row align-items-center">
                <?php echo file_get_contents("img/icon/dashboard-icon.svg"); ?>
                <a href="?page=dashboard">Dashboard</a>
            </div>

            <div class="<?= isActive('courses', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row align-items-center">
                <?php echo file_get_contents("img/icon/courses-icon.svg"); ?>
                <a href="?page=courses">Courses</a>
            </div>

            <div class="<?= isActive('calendar', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row align-items-center">
                <?php echo file_get_contents("img/icon/calendar-icon.svg"); ?>
                <a href="">Calendar</a>
            </div>
        </div>

        <div class="ps-5 pe-3 sidebar-account py-3 d-flex flex-row align-items-center">
            <img src="img/profile-picture.png" class="rounded-circle" alt="profile-picture">
            <h5 class="ps-3 m-0">Naufal</h5>
        </div>

    </div>
</div>

