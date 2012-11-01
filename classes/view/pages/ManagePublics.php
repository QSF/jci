<!-- moderador seleciona um público da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form id="idformPublicManage" name="formPublicManage" action="" method="post">
  <fieldset>
    <legend>Gerencia das opções de público</legend>
    	<!-- listar todos públicos-->
	<?php require_once VIEW_PATH . "/pages/forms/listPublics.php"; ?>
    <button type="submit" class="btn" id="idUpdate" name="update" value="Editar">Editar</button>
    <button type="submit" class="btn" id="idRemove" name="remove" value="Excluir">Excluir</button>
  </fieldset>
</form>

<a href="./index.php?controller=public&action=redirectCreate"><button href="./index.php?controller=field&action=redirectCreate" class="btn btn-inverse">Cadastrar nova opção de público</button></a>