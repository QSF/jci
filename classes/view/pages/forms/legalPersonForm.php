	<table width="40%">
		<tr width=70% style="text-align:right"><label for="cnpj">CNPJ</label><br/>
			<input type="text" id="idCnpj" name="cnpj" value="<?php echo $user->getCnpj()?>"/>
		</tr><br/>
		
		<tr width=70% style="text-align:right">	<label for="companyName">Razão Social</label><br/>
			<input type="text" id="idCompanyName" name="companyName" value="<?php echo $user->getCompanyName()?>"/>
		</tr><br/>
		
		<tr width=70% style="text-align:right">	<label for="stateRegistration">Registro Estadual</label><br/>
			<input type="text" id="idStateRegistration" name="stateRegistration" value="<?php echo $user->getStateRegistration()?>"/><br/></td>
		</tr><br/>

		<tr width=70% style="text-align:right">	<label for="ownerPhone">Telefone do responsável</label><br/>
			<input type="text" id="idOwnerPhone" name="ownerPhone"  value="<?php echo $user->getOwnerPhone()?>"/><br/></td>
		</tr><br/>
	</table>





