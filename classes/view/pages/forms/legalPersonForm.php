	<label for="cnpj">CNPJ</label>
	<input type="text" id="idCnpj" name="cnpj" value="<?php echo $user->getCnpj()?>"/><br/>

	<label for="companyName">Razão Social</label>
	<input type="text" id="idCompanyName" name="companyName" value="<?php echo $user->getCompanyName()?>"/><br/>

	<label for="stateRegistration">Registro Estadual</label>
	<input type="text" id="idStateRegistration" name="stateRegistration" value="<?php echo $user->getStateRegistration()?>"/><br/>

	<label for="ownerPhone">Telefone do responsável</label>
	<input type="text" id="idOwnerPhone" name="ownerPhone"  value="<?php echo $user->getOwnerPhone()?>" maxlength=12/><br/>