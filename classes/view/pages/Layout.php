<!-- xml version="1.0" encoding="UTF-8" --> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head>
		<?php mb_internal_encoding("UTF-8"); ?>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
		<br/>
		<title>
		JCI - Londrina
		</title>
		<!-- JS -->
		<?php  foreach($arrayJS as $js){?>
			<script type="text/javascript" src="js/<?php echo $js?>"></script>
		<?php }?>

		<!-- CSS Geral -->
		<link rel=stylesheet href="css/main.css" type="text/css" media=screen>
		<?php  foreach($arrayCSS as $css){?>
			<link rel=stylesheet href="css/<?php echo $css;?>" type="text/css" media=screen>
		<?php }?>
	</head>
	<body>
		<div id="conteudo_geral"/>

			<div id="logo">
				<?php include_once PAGES_PATH."/Logo.php" ?>  
			</div>

			<div id= "menu">
				<?php if(isset($guestSection)) include $guestSection ?>
				<?php if(isset($userSection)) include $userSection; ?> <br/>
			</div>

			<div id="user_menu">
				<?php if(isset($menu)) include "menu/".$menu ?>
			</div>
			
			<!-- Aqui deverá ser um id para trabalhar melhor no css e as coisas em comum ficam na classe messages-->
			<div id="success_msg" class="messages">
				<ul><?php foreach($successMessage as $msg){?><li> <?php echo $msg;}?>
				</ul>
			</div>

			<div id="error_msg" class="messages">
				<ul> <?php  foreach($errorMessage as $msg){?><li> <?php echo $msg;}?>
				</ul>
			</div>

			<div id="content">
				<?php include PAGES_PATH."/".$content.".php"; ?>
			</div>

			<div id="footer">
				<?php include PAGES_PATH."/Footer.php"; ?>
			</div>
		</div> 
	</body>
</html>