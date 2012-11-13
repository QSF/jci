<h4>Escolha um público atendido:</h4>

<form action="./index.php?controller=<?php echo $controller; ?>&action=<?php echo $action; ?>" method="post">
	<?php require_once VIEW_PATH . "/pages/forms/listPublics.php"; ?>
	<input type="submit" class="btn" value="Buscar" >
</form>