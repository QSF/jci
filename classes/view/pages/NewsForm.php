<?php  if(!isset($news)) $news = new News; ?>

<?php if(!isset($action)) $action = "./index.php?controller=news&action=sendNews"; ?>
<form action="<?php echo $action?>" method="post">
	<input type="hidden" name="news_id" value="<?php echo $news->getId()?>"/>
	<input type="hidden" name="author_id" value="<?php if($news->getAuthor() !== null) echo $news->getAuthor()->getId()?>"/>

	<label for="title" >
		Título</label>
	<input type="text" name="title" id="title" 
	value = "<?php echo $news->getTitle() ;?>"/>
	<br/><br/>
	<label for="content">Conteúdo</label>
	<textarea name="content" style="width:250px;height:300px;"><?php echo $news->getContent(); ?></textarea>

	
    <label for="public" class="checkbox">
      <input type="checkbox" id="public" name="public" value="yes" <?php if($news->getPublic()) echo "checked=yes";?>> Mensagem Pública?
    </label>
	<br/>
	<button class="btn" type="submit">Enviar</button>
</form>