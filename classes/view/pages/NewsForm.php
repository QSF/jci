<?php  if(!isset($news)) $news = new News; ?>

<?php if(!isset($action)) $action = "./index.php?controller=news&action=sendNews"; ?>
<form action="<?php echo $action?>" method="post">
	<input type="hidden" name="news_id" value="<?php echo $news->getId()?>"/>
	<input type="hidden" name="author_id" value="<?php echo $news->getAuthor()->getId()?>"/>

	<label for="title" >
		Título</label><br/>
	<input type="text" name="title" id="title" 
	value = "<?php echo $news->getTitle() ;?>"/><br/>

	<label for="content">Conteúdo</label><br/>
	<textarea name="content" style="width:500px;height:300px;"><?php echo $news->getContent(); ?></textarea><br/>

	<label for="public">Mensagem Pública?</label><br/>
	<input type="checkbox" id="public" name="public" value="yes" 
	<?php if($news->getPublic()) echo "checked=yes";?> />
	<br/>

	<input type="submit" value="Enviar"/>
</form>