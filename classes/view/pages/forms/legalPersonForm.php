
<label for="cnpj">CNPJ</label>
<input type="text" id="idCnpj" name="cnpj" value="<?php echo $user->getCnpj()?>"/>

<label for="companyName">Razão Social</label>
<input type="text" id="idCompanyName" name="companyName" value="<?php echo $user->getCompanyName()?>"/>

<label for="stateRegistration">Registro Estadual</label>
<input type="text" id="idStateRegistration" name="stateRegistration" value="<?php echo $user->getStateRegistration()?>"/>

<label for="ownerPhone">Telefone do responsável</label>
<input type="text" id="idOwnerPhone" name="ownerPhone"  value="<?php echo $user->getOwnerPhone()?>" />
