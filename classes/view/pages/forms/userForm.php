<table width="40%">
		<tr>
			<td><input type="checkbox" name="receivedNotification" 
	<?php if($user->getReceiveNotification()) echo "checked=yes";?>
	value="yes"/>Receber notificações da JCI por email<br/></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right"><label for="name">Nome</label></td>
			<td width=50%><input type="text" id="idName" name="name" value="<?php echo $user->getName()?>"/><br/></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right">	<label for="email">E-mail</label></td>
			<td width=50%><input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/><br/></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right"><?php if($user->getId() == null ){ ?>
	<label for="password">Senha</label></td>
			<td width=50%><input type="password" id="idPassword" name="password"/><br/><?php } ?></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right"><label for="confirmPassword">Confirmação de Senha</label></td>
			<td width=50%><input type="password" id="idConfirmPassword" name="confirmPassword"/><br/></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right"><label for="phone">Telefone</label></td>
			<td width=50%><input type="text" id="idPhone" name="phone" value="<?php  echo $user->getPhone()?>"/><br/></td>
		</tr>
		<tr>
			<td width=70% style="text-align:right"><label for="howYouKnow">Como ficou sabendo sobre a JCI Londrina/ <br/> Projeto Canal de Voluntários?</label></td>
			<td width=50%>	<input type="text" id="idHowYouKnow" name="howYouKnow" value="<?php echo $user->getHowYouKnow()?>"><br/></td>
		</tr>
		<tr>
			<td><label>Público</label><br/>
				<?php $publicArray = explode(',',$user->getPublic());?>
				<input type="checkbox" name="public[]" value="kids"
				<?php if(in_array("kids", $publicArray)) echo "checked=yes"?>/>Crianças<br/>
				<input type="checkbox" name="public[]" value="adult" 
				<?php if(in_array("adult", $publicArray)) echo "checked=yes"?>/>Adultos<br/>
				<input type="checkbox" name="public[]" value="teens"
				<?php if(in_array("teens", $publicArray)) echo "checked=yes"?>/>Adolescentes<br/>
				<input type="checkbox" name="public[]" value="elderly"
				<?php if(in_array("elderly", $publicArray)) echo "checked=yes"?>/>Melhor Idades<br/>
				<input type="checkbox" name="public[]" value="deficient"
				<?php if(in_array("deficient", $publicArray)) echo "checked=yes"?>/>Portadores de necessidades<br/><br/>
			</td>
		
			<td><label >Área de atuação</label><br/>
				<input type="checkbox" name="actingArea[]" value="legal"/>Juridica <br/>
				<input type="checkbox" name="actingArea[]" value="administrative"/>Administrativa<br/>
				<input type="checkbox" name="actingArea[]" value="recreation"/>Recreação <br/>
				<input type="checkbox" name="actingArea[]" value="health"/>Saúde <br/>
				<input type="checkbox" name="actingArea[]" value="education"/>Educação<br/><br/>
			</td>
			
		</tr>
		<tr>
			<td width=70% style="text-align:right"><label for="cep">CEP</label></td>
			<td width=50%><input type="text" id="idCep" name="cep" value="<?php echo $user->getCep()?>"/><br/></td>
		</tr>
	</table>