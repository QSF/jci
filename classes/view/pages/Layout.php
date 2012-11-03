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
		<?php  foreach($arrayCSS as $css){?>
			<link rel=stylesheet href="css/<?php echo $css;?>" type="text/css" media=screen>
		<?php }?>

		<?php  foreach($arrayJS as $js){?>
			<link rel=stylesheet href="js/<?php echo $js?>" type="text/javascript">
		<?php }?>

	</head>
	<body>
		<div id="conteudo_geral"/>

			<div id="logo">
				<?php include_once PAGES_PATH."/Logo.php" ?>  
			</div>
			<?php if(isset($guestSection)) include $guestSection ?>
			<?php if(isset($userSection)) include $userSection; ?> <br/>
				<?php //Mensagens que voce poderá enviar se teve sucesso em alguma ação
					//Uma sugestão é colocar o sucesso como verde e o erro como vermelho?>
				<div class="success">
				<?php  foreach($successMessage as $msg){ echo $msg;}?>
				</div>
				
				<br/>
				<div class="error">
				<?php  foreach($errorMessage as $msg){ echo $msg;}?>
				</div>

				<br/>
				<div id="menu_topo">
					<?php if(isset($menu)) include "menu/".$menu ?>
				</div><br/>

				<?php include PAGES_PATH."/".$content.".php"; ?>
			</div>
			<br/>
		</div> 
	</body>
</html>