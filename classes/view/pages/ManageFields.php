


<!-- moderador seleciona um campo da lista para remover ou editar -->
<!-- o action do form é colocado pelo java script de acordo com a opção-->
<form id="idformFieldManage" name="formFieldManage" action="" method="post">
  <fieldset>
    <legend>Campos de formulário</legend>
    <!-- listar todos os capos-->
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>
    <button type="submit" class="btn" id="idUpdate" name="update" value="Editar">Editar</button>
    <button type="submit" class="btn" id="idRemove" name="remove" value="Excluir">Excluir</button>
  </fieldset>
</form>
<a href="./index.php?controller=field&action=redirectCreate"><button href="./index.php?controller=field&action=redirectCreate" class="btn btn-inverse">Novo Campo</button></a>