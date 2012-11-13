<h4>Escolha um Campo:</h4>

<form action="./index.php?controller=<?php echo $controller; ?>&action=<?php echo $action; ?>" method="post">
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>

	<label>
	<input type="checkbox" name="listParent" checked="yes"> <?php echo $parrentMsg; ?>
	</label>
	<input type="submit" class="btn" value="Buscar" >
</form>