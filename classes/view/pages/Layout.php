<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>JCI - Londrina</title>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <?php foreach($arrayJS as $js) { ?>
  <script type="text/javascript" src="./assets/js/<?php echo $js?>"></script>
  <?php } ?>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if (gte IE 6)&(lte IE 8)]>
    <script src="//raw.github.com/keithclark/selectivizr/master/selectivizr.js"></script>
    <noscript><link rel="stylesheet" href="./assets/css/fallback.css"></noscript>
  <![endif]-->
  <link rel="stylesheet" href="./assets/css/normalize.css/normalize.css" media="all">
  <link rel="stylesheet" href="./assets/css/960-Grid-System/code/css/960.css" media="all">
  
  <link rel="stylesheet" href="./assets/css/all.css" media="all">
  <link rel="stylesheet" href="./assets/css/print.css" media="print">

  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css" media="all">
  
  <!--<script src= "./assets/bootstrap/js/jquery-1.8.2.min.js" type="text/javascript"></script>-->
  <script src= "./assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
  <script src= "./assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!--<script src= "./assets/bootstrap/js/bootstrap-dropdown.js" type="text/javascript"></script>-->

  <!--[if IE 8]><link rel="stylesheet" href="./assets/css/ie8.css" media="all"><![endif]-->
  <!--[if IE 7]><link rel="stylesheet" href="./assets/css/ie7.css" media="all"><![endif]-->
  <!--[if IE 6]><link rel="stylesheet" href="./assets/css/ie6.css" media="all"><![endif]-->
  <?php foreach($arrayCSS as $css ){ ?>
  <link rel=stylesheet href="./assets/css/<?php echo $css;?>" type="text/css">
  <?php }?>
</head>
<body>
  <div id="header">
    <div class="container_12">
      <div class="grid_6 left">
        <?php include_once PAGES_PATH."/Logo.php" ?>
      </div>
      <div class="grid_6 right"></div>
    </div>
  </div>
  <div id="navigation">
    <div class="container_12">
      <div class="grid_7">
        <ul>
          <li><a href="./index.php"><i class="icon-home icon-white"></i> Home</a></li>
          <li><a href="./index.php?controller=Application&action=directDisplay&page=Quem-Somos">Quem somos?</a></li>
          <li><a href="./index.php?controller=Application&action=directDisplay&page=O-Que-Fazemos">O que fazemos?</a></li>
          <li><a href="#">Notícias</a></li>
          <li><a href="./index.php?controller=Application&action=directDisplay&page=Contato">Contato</a></li>
          <!-- <li><a class="active" href="#">...</a></li> -->
        </ul>
      </div>
      <div class="grid_5">
        <ul class="social-networks">
          <li><a href="https://www.facebook.com/jcildna" target="_blank"><img alt="Facebook" src="./assets/img/facebook-32x32.png"></a></li>
          <li><a href="http://jcilondrina.blogspot.com.br/" target="_blank"><img alt="Blogger" src="./assets/img/feed-32x32.png"></a></li>
          <li><a href="http://br.linkedin.com/company/jci-londrina" target="_blank"><img alt="LinkedIn" src="./assets/img/linkedin-32x32.png"></a></li>
          <li><a href="http://www.slideshare.net/jcilondrina" target="_blank"><img alt="SlideShare" src="./assets/img/slideshare-32x32.png"></a></li>
          <li><a href="http://twitter.com/jcilondrina" target="_blank"><img alt="Twitter" src="./assets/img/twitter-32x32.png"></a></li>
          <li><a href="http://www.youtube.com/user/jcilondrina" target="_blank"><img alt="YouTube" src="./assets/img/youtube-32x32.png"></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div id="wrapper">
    <div class="container_12" id="user">
      <div class="grid_12">
        <?php if(isset($menu)) include "menu/".$menu ?>
      </div>
    </div>
    <div class="container_12" id="content">
      <div class="grid_8">
        <div class="box">
    	  <div id="success_msg" class="messages">
		    <ul><?php foreach($successMessage as $msg){?><li> <?php echo $msg;}?></ul>
		  </div>
		  <div id="error_msg" class="messages">
			<ul><?php  foreach($errorMessage as $msg){?><li> <?php echo $msg;}?></ul>
		  </div>
		  <?php include PAGES_PATH."/".$content.".php"; ?>
        </div>
      </div>
      <div class="grid_4">
        <div id="sidebar">
          <?php include PAGES_PATH."/Sidebar.php"; ?>
        </div>
      </div>
    </div>
    <div class="container_12" id="footer">
      <?php include PAGES_PATH."/Footer.php"; ?>
    </div>
  </div>

  <!--
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="./assets/js/setup.js"></script> -->
</body>
</html>