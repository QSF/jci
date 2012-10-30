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
		<!-- CSS Geral -->
		<link rel=stylesheet href="css/main.css" type="text/css" media=screen>
		<?php  foreach($arrayCss as $css){?>
			<link rel=stylesheet href="css/<?php echo PUBLIC_PATH."/css/".$css;?>.css" type="text/css" media=screen>
		<?php }?>

	</head>
	<body>
		<div id="conteudo_geral"/>

			<div id="logo">
				<?php include_once PAGES_PATH."/Logo.php" ?>  
			</div>
			<div id="menu_topo">
				 <? //include_once "menu_topo.php"?> 
			</div>
			<div id="content">
				<div class="mensagem_sucesso">
				<?php  foreach($successMessage as $msg){
					echo $msg;
					}?>
				</div>

				<?php include PAGES_PATH."/".$content.".php"?>
			</div>
		</div>
			<div 
	</body>
</html>