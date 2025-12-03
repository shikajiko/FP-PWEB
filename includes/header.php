<?php include "data/greetings.php"; 
    $message = $greet['morning'];
?>

<div class="w-100 header py-4 mt-4 px-5 d-flex flex-row justify-content-between">
    <h1 class="col-10 <?=$currentPage === 'dashboard'? 'd-block' : 'd-none'?>">Welcome, Naufal Daffa</h1>
    <div class="col-10 <?=$currentPage === 'dashboard'? 'd-none' : 'd-block'?>">
        <h4><?=$message?></h4>
        <h1>Naufal Daffa</h1>
    </div>
    <div class="btn-box d-flex flex-row justify-content-center align-items-center ps-5">
        <div class="btn-bg">
            <img src="img/icon/mail-icon.svg" alt="">
        </div>
        <div class="btn-bg">
            <img src="img/icon/bell-icon.svg" alt="">
        </div>
    </div>
</div>