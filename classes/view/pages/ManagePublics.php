<h3> Gerencia das opções de público</h3>

<a href="./index.php?controller=field&action=redirectCreate">Cadastrar nova opção de público</a><br/>

<!-- moderador seleciona um campo da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form name="formPublicManage" action="./index.php?controller=public&action=redirectUpdate" method="post">
	<!-- listar todos os capos-->
	<?php require_once VIEW_PATH . "/pages/forms/listPublics.php"; ?>
	
	<input type="submit" name="update" value="Editar" onclick="update()"/>
	<input type="submit" name="remove" value="Excluir" onclick="remove()"/>
</form>