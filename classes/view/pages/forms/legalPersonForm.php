	<table width="40%">
		<tr>
			<td width=70%><label for="cnpj">CNPJ</label></td>
			<td width=50%>	<input type="text" id="idCnpj" name="cnpj" value="<?php echo $user->getCnpj()?>"/><br/>
</td>
		</tr>
		<tr>
			<td width=70%>	<label for="companyName">Razão Social</label>
</td>
			<td width=50%>	<input type="text" id="idCompanyName" name="companyName" value="<?php echo $user->getCompanyName()?>"/><br/>
</td>
		</tr>
		<tr>
			<td width=70%>	<label for="stateRegistration">Registro Estadual</label>
</td>
			<td width=50%>	<input type="text" id="idStateRegistration" name="stateRegistration" value="<?php echo $user->getStateRegistration()?>"/><br/>
</td>
		</tr>
		<tr>
			<td width=70% align=LEFT>	<label for="ownerPhone">Telefone do responsável</label>
</td>
			<td width=50%>	<input type="text" id="idOwnerPhone" name="ownerPhone"  value="<?php echo $user->getOwnerPhone()?>" maxlength=12/><br/></td>
		</tr>
	</table>





