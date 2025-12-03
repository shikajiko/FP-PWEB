<?php
function isActive($name, $current) {
    return $name === $current ? 'sidebar-active' : ' ';
}
?>


<div class="sidebar pt-3">
    <div class="d-flex flex-column justify-content-between h-100">
        <div class="mt-4">
            <div class="sidebar-logo mb-5 d-flex flex-row justify-content-center align-items-center">
                <img src="img/logo.png" alt="">
            </div>
            <div class=" <?= isActive('dashboard', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row justify-content-start align-items-center">
                <?php echo file_get_contents("img/icon/dashboard-icon.svg"); ?>
                <a href="?page=dashboard"> Dashboard</a>
            </div>
            <div class=" <?= isActive('courses', $currentPage) ?>  ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row justify-content-start align-items-center">
                <?php echo file_get_contents("img/icon/courses-icon.svg"); ?>
                <a href="?page=courses"> Courses</a>
            </div>
            <div class=" <?= isActive('calendar', $currentPage) ?> ps-4 pe-3 sidebar-item gap-3 py-3 d-flex flex-row justify-content-start align-items-center">
                <?php echo file_get_contents("img/icon/calendar-icon.svg"); ?>
                <a href=""> Calendar</a>
            </div>
        </div>
        
        <div class="ps-5 pe-3 sidebar-account py-3 d-flex flex-row justify-content-start align-items-center">
                <img src="img/profile-picture.png" class="rounded-circle" alt="profile-picture">
                <h5 class="ps-3 m-0" class>Naufal</h5>
        </div>
    </div>
</div>
