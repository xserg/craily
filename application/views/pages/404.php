<!doctype html>
<html>
<head>
<title>404 Not Found - <?=$site_settings->site_name?></title>
<?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">


<section id="not404">
    <div class="flexDv">
		<div class="contain">
		    <div class="inside flex">
		        <div class="ico"><span class="black">404</span></div>
		        <h1 class="secHeading">Page Not Found</h1>
		        <p class="italic">Let's pretend.....!! You never saw this. <span><a href="<?=site_url()?>">Click here</a> to go back to Home page.</span></p>
		    </div>
		</div>
    </div>
</section>
<!-- not404 -->


</body>
</html>