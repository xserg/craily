<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>(404) The page you were looking for doesn't exist.</title>
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>">
  <!-- Main Css -->
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/mycss.css')?>">
  <!-- Media-Query Css -->
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/responsive.css')?>">
  <!-- Font-Awesome Css -->
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css')?>">
  <!-- Font-Icon Css -->
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/font-icon.css')?>">

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
</section><!-- not404 -->



</body>
</html>