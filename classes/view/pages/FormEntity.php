<form action="index.php?model=entity&action=register" method="post">
<label for="id_name">Razão Social:</label>
<input type="text" id="id_name" name="name"/><br/>
<label for="id_cnpj">CNPJ:</label>
<input type="text" id="id_cnpj" name="cpf"/><br/>

<label for="id_email">e-mail:</label>
<input type="text" id="id_email" name="email"/><br/>
<label for="id_phone">Telefone:</label>
<input type="text" id="id_phone" name="phone"/><br/>
<label for="id_cep">CEP:</label>
<input type="text" id="id_cep" name="cep"/><br/>
<label for="id_pass">Senha</label>
<input type="password" id="id_pass" name="password"/><br/>

<label for="id_name">Nome da empresa:</label>
<input type="text" id="id_name" name="name"/><br/>
<label for="id_stateReg">Registro Estadual:</label>
<input type="text" id="id_stateReg" name="stateRegistration"/><br/>
<label for="id_estDate">Data de fundação:</label>
<input type="text" id="id_estDate" name="establishmentDate"/><br/>

<label for="id_site">Site:</label>
<input type="text" id="id_site" name="site"/><br/>

<label >Área de atuação: </label><br/>
<input type="checkbox" name="actingArea" value="legal"/> Juridica <br/>
<input type="checkbox" name="actingArea" value="administrative"/>Administrativa<br/>
<input type="checkbox" name="actingArea" value="recreation"/> Recreação <br/>
<input type="checkbox" name="actingArea" value="health"/> Saúde <br/>
<input type="checkbox" name="actingArea" value="education"/> Educação<br/>


<label>Público: </label><br/>
<input type="checkbox" name="public" value="kids"/>Crianças <br/>
<input type="checkbox" name="public" value="adult"/>Adultos <br/>
<input type="checkbox" name="public" value="teens"/>Adolescentes <br/>
<input type="checkbox" name="public" value="elderly"/>Melhor Idades <br/>
<input type="checkbox" name="public" value="deficient"/>Portadores de necessidades <br/>

<label for="id_howYouKnow">Como ficou sabendo sobre a JCI Londrina/Projeto Canal de Voluntários</label><br/>
<input type="text" id="id_howYouKnow" name"how_know" size="200"> <br/>

<label for="id_xp">Se já teve alguma experiência com serviço voluntário, em quais atividades? </label><br/>
<input type="text" id="id_xp" name"xp" size="200"> <br/>


<input type="checkbox" name="receivedNotification" value="notification"/>Receber Notificações da JCI no seu email <br/>
<input type="submit" value="Cadastrar"/>
</form>