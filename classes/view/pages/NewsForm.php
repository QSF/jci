<form action="./index.php?controller=moderator&action=sendNews" method="post">

	<label for="title">Título</label><br/>
	<input type="text" name="title" id="title"/><br/>

	<label for="content">Conteúdo</label><br/>
	<textarea name="content" style="width:500px;height:300px;"></textarea><br/>

	<label for="public">Mensagem Pública?</label><br/>
	<input type="checkbox" id="public" name="public" value="yes"/>
	<br/>

	<input type="submit" value="Enviar"/>
</form>