<h3> Campos de formulário</h3>

<a href="./index.php?controller=field&action=redirectCreate">Cadastrar novo grupo</a><br/>

<!-- moderador seleciona um campo da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form name="formFieldManage" action="./index.php?controller=field&action=redirectUpdate" method="post">
	<!-- listar todos os capos-->
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>
	
	<input type="submit" name="u" value="Editar" onclick="update()"/>
	<input type="submit" name="r" value="Excluir" onclick="remove()"/>
</form>