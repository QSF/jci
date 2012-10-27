<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<br/>
		<title>
		<?php echo $title ?>
		</title>
		<!-- CSS Geral -->
		<link rel=stylesheet href="css/main.css" type="text/css" media=screen>
		<?php  foreach($array_css as $css){?>
			<link rel=stylesheet href="css/<?php echo $css;?>.css" type="text/css" media=screen>
		<?php }?>

	</head>
	<body>
		<div id="conteudo_geral"/>

			<div id="header">
				 <? //include_once "header.php"?> 
			</div>
			<div id="menu_topo">
				 <? //include_once "menu_topo.php"?> 
			</div>
			<div id="content">
				<div class="mensagem_sucesso">
				<?php  foreach($success_message as $msg){
					echo $msg;
					}?>
				</div>

				<?php include $content.".php"?>
			</div>
		</div>
			<div 
	</body>
</html>