<form action="./index.php?controller=moderator&action=search" method="post">
	
	<select name="searchOption" id="type">
    <?php //<option value="documents">CPF - CNPJ</option>?>
    <option value="name">Nome</option>
    <option value="email">E-mail</option>
  </select><br/>

  <input type="text" name="searchField" id="searchField"/><br/>
	<input type="submit" value="Procurar" id="searchButton"/>
</form>