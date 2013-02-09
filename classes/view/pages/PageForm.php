<?php  if(!isset($page)) $page = new Page; ?>

<form action="./index.php?controller=PageManager&action=update" method="post">
	<input type="hidden" name="page_name" value="<?php echo $page->getName()?>"/>
	
	<label for="content">Conteúdo</label>
	<textarea name="content" style="width:250px;height:300px;"><?php echo $page->getContent(); ?></textarea>

	<br/>
	<button class="btn" type="submit">Enviar</button>
</form>