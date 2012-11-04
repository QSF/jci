<h3> Gerencia das opções de público</h3>

<a href="./index.php?controller=public&action=redirectCreate">Cadastrar nova opção de público</a><br/>

<!-- moderador seleciona um público da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form id="idformPublicManage" name="formPublicManage" action="" method="post">
	<!-- listar todos públicos-->
	<?php require_once VIEW_PATH . "/pages/forms/listPublics.php"; ?>
	
	<input type="submit" id="idUpdate" name="update" value="Editar"/>
	<input type="submit" id="idRemove" name="remove" value="Excluir"/>
</form>