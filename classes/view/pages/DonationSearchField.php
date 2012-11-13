<h4>Escolha um Campo:</h4>

<form action="./index.php?controller=donation&action=redirectFieldDonations" method="post">
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>

	<input type="checkbox" name="listParent" checked="yes"> Listar as doações dos campos pai.
	<input type="submit" class="btn" value="Buscar" >
</form>