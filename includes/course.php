<div class="d-flex flex-column course-list-box px-4 py-3">
    <div class="d-flex flex-row gap-2">
        <p><?= $c['code'] ?></p>
        <p style="color: #866fd8"><?= $c['name'] ?></p>
    </div>
    <div class="row g-0 w-75">
        <div class="d-flex flex-row gap-2 col-2">
            <img src="img/icon/calendar-icon.svg" alt="">
            <p class="p-0 m-0"><?= $c['day'] ?></p>
        </div>
        <div class="d-flex flex-row gap-2 col-2">
            <img src="img/icon/time-icon.svg" alt="">
            <p class="p-0 m-0"><?= $c['time'] ?></p>
        </div>
        <div class="d-flex flex-row gap-2 ms-4 col-2">
            <img src="img/icon/building-icon.svg" alt="">
            <p class="p-0 m-0"><?= $c['room'] ?></p>
        </div>
    </div>
</div>