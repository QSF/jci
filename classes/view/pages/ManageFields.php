<h3> Campos de formulário</h3>

<a href="./index.php?controller=field&action=redirectCreate">Cadastrar novo campo.</a><br/>

<!-- moderador seleciona um campo da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form id="idformFieldManage" name="formFieldManage" action="" method="post">
	<!-- listar todos os capos-->
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>
	
	<input type="submit" id="idUpdate" name="update" value="Editar"/>
	<input type="submit" id="idRemove" name="remove" value="Excluir"/>
</form>
