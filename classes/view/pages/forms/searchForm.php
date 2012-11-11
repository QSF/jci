<form action="./index.php?controller=moderator&action=search" method="post">
	
	<select name="searchOption" id="type">
    <?php //<option value="documents">CPF - CNPJ</option>?>
    <option value="name">Nome</option>
    <option value="email">E-mail</option>
  </select><br/>

  <div class="input-append">
    <input class="span3" type="text" name="searchField" id="searchField" placeholder="Escreva aqui…">
    <button class="btn" type="submit" id="searchButton">Procurar</button>
  </div>
</form>
