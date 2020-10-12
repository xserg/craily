<header class="main-header" id="mainHeader">
	<nav class="navbar">
	  <a class="navbar-brand" href="javascript:void(0);">
	  	<img src="<?= base_url('assets/lecture/images/logo.png')?>" alt="logo" class="img-fluid desktop-logo">
	  	<img src="<?= base_url('assets/lecture/images/mobile-logo.png')?>" alt="logo" class="img-fluid mobile-logo">
	  </a>
	  <div class="timer font-reg" id="clockContainer">
	   	<span id="clock">00:00:00</span> / <span><?= $lecture_time?></span>
	  </div>
       <div class="d-flex">
       	<button class="btn btn-primary ripple-effect" onclick="screenShare()">Share Screen</button>
        <button class="navbar-toggler d-block d-lg-none" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
         <span class="line"></span>
         <span class="line"></span>
         <span class="line"></span>
       </div>
</header>